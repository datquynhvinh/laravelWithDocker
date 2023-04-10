<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
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
}
