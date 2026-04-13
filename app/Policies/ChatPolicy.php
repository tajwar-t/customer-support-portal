<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\User;

class ChatPolicy
{
    /**
     * Determine whether the user can view the chat.
     */
    public function view(User $user, Chat $chat): bool
    {
        return $user->id === $chat->customer_id || $user->id === $chat->support_agent_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can update the chat.
     */
    public function update(User $user, Chat $chat): bool
    {
        return $user->id === $chat->support_agent_id || $user->role === 'admin';
    }

    /**
     * Determine whether the user can delete the chat.
     */
    public function delete(User $user, Chat $chat): bool
    {
        return $user->role === 'admin';
    }
}
