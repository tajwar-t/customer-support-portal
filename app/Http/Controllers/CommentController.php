<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Get comments for a post.
     */
    public function index(Post $post)
    {
        $comments = $post->comments()
            ->where('is_approved', true)
            ->with('user')
            ->latest()
            ->get();

        return response()->json($comments);
    }

    /**
     * Add a comment to a post.
     */
    public function store(Request $request, Post $post)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $comment = Comment::create([
            'post_id' => $post->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'is_approved' => true, // Auto-approve for now
        ]);

        return response()->json($comment->load('user'), 201);
    }

    /**
     * Update a comment.
     */
    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|string|max:5000',
        ]);

        $comment->update($validated);

        return response()->json($comment);
    }

    /**
     * Delete a comment.
     */
    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return response()->json(['message' => 'Comment deleted successfully']);
    }

    /**
     * Get all comments (for admin).
     */
    public function getAllComments()
    {
        $this->authorize('viewAny', Comment::class);

        $comments = Comment::with(['user', 'post'])
            ->latest()
            ->paginate(20);

        return response()->json($comments);
    }

    /**
     * Approve a comment (for admin).
     */
    public function approve(Comment $comment)
    {
        $this->authorize('approve', $comment);

        $comment->update(['is_approved' => true]);

        return response()->json($comment);
    }
}
