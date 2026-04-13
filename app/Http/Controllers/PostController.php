<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Get all posts.
     */
    public function index(Request $request)
    {
        $query = Post::with(['user', 'comments.user']);

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Search by title
        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('content', 'like', '%' . $request->search . '%');
        }

        // Sort by featured and latest
        $posts = $query->where('is_featured', true)
            ->union(
                Post::with(['user', 'comments.user'])
                    ->where('is_featured', false)
                    ->latest()
            )
            ->paginate(15);

        return response()->json($posts);
    }

    /**
     * Create a new post.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:50',
        ]);

        $post = Post::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']) . '-' . time(),
            'content' => $validated['content'],
            'category' => $validated['category'],
        ]);

        return response()->json($post, 201);
    }

    /**
     * Get a specific post.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
        
        // Increment view count
        $post->increment('views_count');

        return response()->json($post->load(['user', 'comments.user']));
    }

    /**
     * Update a post.
     */
    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'category' => 'required|string|max:50',
            'is_featured' => 'boolean',
        ]);

        $post->update($validated);

        return response()->json($post);
    }

    /**
     * Delete a post.
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return response()->json(['message' => 'Post deleted successfully']);
    }

    /**
     * Get posts by category.
     */
    public function getByCategory($category)
    {
        $posts = Post::where('category', $category)
            ->with(['user', 'comments.user'])
            ->latest()
            ->paginate(15);

        return response()->json($posts);
    }

    /**
     * Get featured posts.
     */
    public function getFeatured()
    {
        $posts = Post::where('is_featured', true)
            ->with(['user', 'comments.user'])
            ->latest()
            ->get();

        return response()->json($posts);
    }
}
