<?php

namespace App\Models;

use App\Models\Chatroom;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'room',
        'message',
        'user_id',
        'receiver_id',
    ];

    /**
     * The attributes that should be converted date format
     */
    public function getCreatedAtAttribute($value) {
        return date("Y-m-d H:i:s", strtotime($value));
    }

    /**
     * The attributes that should be converted date format
     */
    public function getUpdatedAtAttribute($value) {
        return date("Y-m-d H:i:s", strtotime($value));
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function receiver () {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    /**
     * @return BelongsTo
     */
    public function room () {
        return $this->belongsTo(Chatroom::class, 'room');
    }
}
