<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'support_agent_id',
        'status',
        'subject',
        'description',
        'requires_admin_approval',
        'admin_approved_at',
    ];

    protected $casts = [
        'requires_admin_approval' => 'boolean',
        'admin_approved_at' => 'datetime',
    ];

    /**
     * Get the customer who initiated this chat.
     */
    public function customer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'customer_id');
    }

    /**
     * Get the support agent assigned to this chat.
     */
    public function supportAgent(): BelongsTo
    {
        return $this->belongsTo(User::class, 'support_agent_id');
    }

    /**
     * Get the messages in this chat.
     */
    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the review for this chat.
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
