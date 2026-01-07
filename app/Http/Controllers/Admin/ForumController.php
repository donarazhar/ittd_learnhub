<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Discussion;
use App\Models\DiscussionReply;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of discussions
     */
    public function index(Request $request)
    {
        $query = Discussion::with(['user', 'lesson.module.course']);

        // Filter by pinned
        if ($request->filled('pinned')) {
            $query->where('is_pinned', $request->pinned === 'yes');
        }

        // Filter by course
        if ($request->filled('course_id')) {
            $query->whereHas('lesson.module.course', function ($q) use ($request) {
                $q->where('id', $request->course_id);
            });
        }

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        $discussions = $query->latest()->paginate(20);

        $courses = \App\Models\Course::select('id', 'title')->orderBy('title')->get();

        $breadcrumbs = [
            ['label' => 'Forum & Diskusi', 'url' => route('admin.forum.index')]
        ];

        return view('admin.forum.index', compact('discussions', 'courses', 'breadcrumbs'));
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

        $breadcrumbs = [
            ['label' => 'Forum & Diskusi', 'url' => route('admin.forum.index')],
            ['label' => $discussion->title, 'url' => route('admin.forum.show', $discussion)]
        ];

        return view('admin.forum.show', compact('discussion', 'breadcrumbs'));
    }

    /**
     * Toggle pin status
     */
    public function togglePin(Discussion $discussion)
    {
        $discussion->update([
            'is_pinned' => !$discussion->is_pinned
        ]);

        return redirect()->back()
            ->with('success', $discussion->is_pinned ? 'Diskusi berhasil di-pin!' : 'Diskusi berhasil di-unpin!');
    }

    /**
     * Delete a discussion
     */
    public function destroy(Discussion $discussion)
    {
        $discussion->delete();

        return redirect()->route('admin.forum.index')
            ->with('success', 'Diskusi berhasil dihapus!');
    }

    /**
     * Delete a reply
     */
    public function destroyReply(DiscussionReply $reply)
    {
        $discussion = $reply->discussion;
        $reply->delete();

        // Decrement replies count
        $discussion->decrement('replies_count');

        return redirect()->back()
            ->with('success', 'Balasan berhasil dihapus!');
    }
}
