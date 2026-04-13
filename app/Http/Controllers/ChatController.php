<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    /**
     * Get all chats for the authenticated user.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'customer') {
            $chats = Chat::where('customer_id', $user->id)
                ->with(['customer', 'supportAgent', 'messages'])
                ->latest()
                ->get();
        } elseif ($user->role === 'admin') {
            $chats = Chat::with(['customer', 'supportAgent', 'messages'])
                ->latest()
                ->get();
        } else {
            $chats = Chat::where('support_agent_id', $user->id)
                ->with(['customer', 'supportAgent', 'messages'])
                ->latest()
                ->get();
        }

        return response()->json($chats);
    }

    /**
     * Create a new chat.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $chat = Chat::create([
            'customer_id' => Auth::id(),
            'subject' => $validated['subject'],
            'description' => $validated['description'],
            'status' => 'open',
        ]);

        return response()->json($chat, 201);
    }

    /**
     * Get a specific chat with messages.
     */
    public function show(Chat $chat)
    {
        $this->authorize('view', $chat);

        return response()->json($chat->load(['customer', 'supportAgent', 'messages.user']));
    }

    /**
     * Update a chat.
     */
    public function update(Request $request, Chat $chat)
    {
        $this->authorize('update', $chat);

        $validated = $request->validate([
            'status' => 'required|in:open,in_progress,closed',
            'support_agent_id' => 'nullable|exists:users,id',
        ]);

        $user = Auth::user();
        
        // If agent changes status, store as pending and requires admin approval
        if ($user->role === 'support_agent' && isset($validated['status'])) {
            $validated['pending_status'] = $validated['status'];
            $validated['requires_admin_approval'] = true;
            $validated['admin_approved_at'] = null;
            // Don't update the actual status yet - keep current status
            unset($validated['status']);
        }
        
        // Admin can approve directly and apply pending status
        if ($user->role === 'admin') {
            $validated['requires_admin_approval'] = false;
            $validated['admin_approved_at'] = now();
            if (isset($validated['status'])) {
                $validated['pending_status'] = null;
            }
        }

        $chat->update($validated);

        return response()->json($chat);
    }

    /**
     * Approve a status change (admin only).
     */
    public function approveStatus(Chat $chat)
    {
        $this->authorize('update', $chat);

        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        if (!$chat->requires_admin_approval || !$chat->pending_status) {
            return response()->json(['message' => 'No pending status to approve'], 400);
        }

        // Apply the pending status
        $chat->update([
            'status' => $chat->pending_status,
            'pending_status' => null,
            'requires_admin_approval' => false,
            'admin_approved_at' => now(),
        ]);

        return response()->json($chat);
    }

    /**
     * Assign an agent to a chat (admin only).
     */
    public function assignAgent(Request $request, Chat $chat)
    {
        $user = Auth::user();
        if ($user->role !== 'admin') {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $validated = $request->validate([
            'support_agent_id' => 'required|exists:users,id',
        ]);

        $chat->update([
            'support_agent_id' => $validated['support_agent_id'],
        ]);

        return response()->json($chat->load(['customer', 'supportAgent']));
    }

    /**
     * Send a message in a chat.
     */
    public function sendMessage(Request $request, Chat $chat)
    {
        $this->authorize('view', $chat);

        $validated = $request->validate([
            'content' => 'required|string',
        ]);

        $user = Auth::user();
        $senderType = match($user->role) {
            'customer' => 'customer',
            'admin' => 'admin',
            default => 'support',
        };

        $message = Message::create([
            'chat_id' => $chat->id,
            'user_id' => $user->id,
            'content' => $validated['content'],
            'sender_type' => $senderType,
        ]);

        return response()->json($message->load('user'), 201);
    }

    /**
     * Get messages for a chat.
     */
    public function getMessages(Chat $chat)
    {
        $this->authorize('view', $chat);

        $messages = $chat->messages()
            ->with('user')
            ->latest()
            ->get();

        return response()->json($messages);
    }

    /**
     * Close a chat.
     */
    public function close(Chat $chat)
    {
        $this->authorize('view', $chat);

        $chat->update(['status' => 'closed']);

        return response()->json($chat);
    }

    /**
     * Delete a chat.
     */
    public function destroy(Chat $chat)
    {
        $user = Auth::user();
        
        // Only admin or the customer who created the chat can delete it
        if ($user->role !== 'admin' && $chat->customer_id !== $user->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        $chat->delete();

        return response()->json(['message' => 'Chat deleted successfully']);
    }
}
