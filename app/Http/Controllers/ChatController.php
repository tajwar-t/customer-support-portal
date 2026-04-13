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

        $chat->update($validated);

        return response()->json($chat);
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

        $message = Message::create([
            'chat_id' => $chat->id,
            'user_id' => Auth::id(),
            'content' => $validated['content'],
            'sender_type' => Auth::user()->role === 'customer' ? 'customer' : 'support',
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
}
