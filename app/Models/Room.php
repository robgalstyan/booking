<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'price',
        'guest_id',
        'book_start',
        'book_end',
    ];


    /**
     * Get room booked users(guests)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(){
        return $this->belongsToMany(User::class, 'bookings', 'room_id', 'user_id')
            ->withPivot(['book_start', 'book_end']);
    }



    public function bookings(){
        return $this->hasMany(Booking::class);
    }

}
