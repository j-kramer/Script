<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $withCount = ['unreadMessages'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'enable_notifications'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
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
            'has_premium' => 'boolean',
            'enable_notifications' => 'boolean',
        ];
    }

    public function articles(): HasMany {
        return $this->hasMany(Article::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

    public function sentMessages(): HasMany {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function receivedMessages(): hasMany {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function unreadMessages(): hasMany {
        return $this->hasMany(Message::class, 'receiver_id')->unread();
    }
}
