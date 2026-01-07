<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of all discussions (global forum)
     */
    public function index(Request $request)
    {
        $query = Discussion::with(['user', 'lesson.module.course'])
            ->latest();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by course
        if ($request->filled('course_id')) {
            $query->whereHas('lesson.module.course', function ($q) use ($request) {
                $q->where('id', $request->course_id);
            });
        }

        $discussions = $query->paginate(20);

        $courses = \App\Models\Course::select('id', 'title')
            ->published()
            ->orderBy('title')
            ->get();

        return view('forum.index', compact('discussions', 'courses'));
    }

    /**
     * Display the specified discussion with replies
     */
    public function show(Discussion $discussion)
    {
        $discussion->load([
            'user',
            'lesson.module.course',
            'replies.user'
        ]);

        return view('forum.show', compact('discussion'));
    }

    /**
     * Store a new discussion (from learn page or forum page)
     */
    public function store(Request $request)
    {
        $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|max:255',
            'content' => 'required',
        ]);

        Discussion::create([
            'lesson_id' => $request->lesson_id,
            'user_id' => auth()->id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return back()->with('success', 'Diskusi berhasil dibuat!');
    }

    /**
     * Store a reply to a discussion
     */
    public function reply(Request $request, Discussion $discussion)
    {
        $request->validate([
            'content' => 'required',
        ]);

        DiscussionReply::create([
            'discussion_id' => $discussion->id,
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);

        // Increment replies count
        $discussion->increment('replies_count');

        return back()->with('success', 'Balasan berhasil ditambahkan!');
    }
}
