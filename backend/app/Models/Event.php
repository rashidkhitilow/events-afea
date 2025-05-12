<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'total_seats', 'available_seats', 'status'];

    public function user_event(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(UserEvent::class);
    }
}
