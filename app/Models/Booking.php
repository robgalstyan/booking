<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;


    /**
     * Get user relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function guest(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /**
     * Get room relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function room(){
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
