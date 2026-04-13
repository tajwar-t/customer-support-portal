<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Get all support agents.
     */
    public function getAgents()
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $agents = User::where('role', 'support_agent')
            ->withCount(['supportChats as active_chats_count' => function($query) {
                $query->whereIn('status', ['open', 'in_progress']);
            }])
            ->get()
            ->map(function($agent) {
                $avgRating = $agent->reviewsReceived()->avg('rating');
                $totalReviews = $agent->reviewsReceived()->count();
                
                return [
                    'id' => $agent->id,
                    'name' => $agent->name,
                    'email' => $agent->email,
                    'role' => $agent->role,
                    'active_chats_count' => $agent->active_chats_count,
                    'avg_rating' => $avgRating ? round($avgRating, 1) : null,
                    'total_reviews' => $totalReviews,
                ];
            });

        return response()->json($agents);
    }

    /**
     * Get all chats needing approval.
     */
    public function getPendingApprovals()
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $chats = Chat::where('requires_admin_approval', true)
            ->with(['customer', 'supportAgent', 'messages'])
            ->latest()
            ->get();

        return response()->json($chats);
    }

    /**
     * Get dashboard stats for admin.
     */
    public function getDashboardStats()
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $stats = [
            'total_chats' => Chat::count(),
            'open_chats' => Chat::where('status', 'open')->count(),
            'in_progress_chats' => Chat::where('status', 'in_progress')->count(),
            'closed_chats' => Chat::where('status', 'closed')->count(),
            'pending_approvals' => Chat::where('requires_admin_approval', true)->count(),
            'total_agents' => User::where('role', 'support_agent')->count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'average_rating' => round(Review::avg('rating') ?? 0, 1),
        ];

        return response()->json($stats);
    }
}
