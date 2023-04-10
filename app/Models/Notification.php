<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    /**
     * @return string The primary key ID
     */
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'read_at',
    ];

    /**
     * Mark the notification as readered
     *
     * @return void
     */
    public function markAsRead($notification): void
    {
        $notification->update(['read_at' => date('Y-m-d H:i:s')]);
    }
}
