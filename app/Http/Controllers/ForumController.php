<?php

namespace App\Http\Controllers;

use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $discussions = Discussion::with(['user', 'lesson.module.course'])
            ->latest()
            ->paginate(20);

        return view('forum.index', compact('discussions'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'lesson_id' => 'required|exists:lessons,id',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $discussion = Discussion::create([
            'lesson_id' => $validated['lesson_id'],
            'user_id' => auth()->id(),
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->back()
            ->with('success', 'Diskusi berhasil dibuat!');
    }

    public function reply(Request $request, Discussion $discussion)
    {
        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        DiscussionReply::create([
            'discussion_id' => $discussion->id,
            'user_id' => auth()->id(),
            'content' => $validated['content'],
        ]);

        $discussion->increment('replies_count');

        return redirect()->back()
            ->with('success', 'Balasan berhasil ditambahkan!');
    }
}