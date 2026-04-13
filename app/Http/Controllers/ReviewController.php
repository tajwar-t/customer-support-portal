<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Get reviews for an agent.
     */
    public function getAgentReviews($agentId)
    {
        $reviews = Review::where('agent_id', $agentId)
            ->with(['customer', 'chat'])
            ->latest()
            ->get();

        $averageRating = $reviews->avg('rating') ?? 0;

        return response()->json([
            'reviews' => $reviews,
            'average_rating' => round($averageRating, 1),
            'total_reviews' => $reviews->count(),
        ]);
    }

    /**
     * Submit a review for a chat/agent.
     */
    public function store(Request $request, Chat $chat)
    {
        $user = Auth::user();
        
        // Only customers can leave reviews
        if ($user->role !== 'customer') {
            return response()->json(['message' => 'Only customers can leave reviews'], 403);
        }

        // Check if user is the customer in this chat
        if ($chat->customer_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Check if chat is closed
        if ($chat->status !== 'closed') {
            return response()->json(['message' => 'Can only review closed chats'], 400);
        }

        // Check if already reviewed
        $existingReview = Review::where('chat_id', $chat->id)
            ->where('customer_id', $user->id)
            ->first();

        if ($existingReview) {
            return response()->json(['message' => 'You have already reviewed this chat'], 409);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        $review = Review::create([
            'chat_id' => $chat->id,
            'agent_id' => $chat->support_agent_id ?? 0,
            'customer_id' => $user->id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'] ?? null,
        ]);

        return response()->json($review->load(['customer', 'agent']), 201);
    }

    /**
     * Get all reviews (admin only).
     */
    public function getAllReviews()
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $reviews = Review::with(['customer', 'agent', 'chat'])
            ->latest()
            ->paginate(20);

        return response()->json($reviews);
    }
}
