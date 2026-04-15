<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Get the chats the user has initiated.
     */
    public function initiatedChats()
    {
        return $this->hasMany(Chat::class, 'customer_id');
    }

    /**
     * Get the chats the user is supporting.
     */
    public function supportChats()
    {
        return $this->hasMany(Chat::class, 'support_agent_id');
    }

    /**
     * Get the messages by this user.
     */
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    /**
     * Get the posts by this user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get the comments by this user.
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Get the reviews given by this customer.
     */
    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'customer_id');
    }

    /**
     * Get the reviews received by this agent.
     */
    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'agent_id');
    }
}
