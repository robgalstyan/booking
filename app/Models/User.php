<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    
    /**
     * Password validation regex
     *
     * @var string
     */
    const PASSWORD_REGEX = '/^((?=.*\p{L})(?=.*\d)(?=.*[^\p{L}\d\s])).{8,}$/';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];


    // --------------------------  Helper Functions ------------------------- //

    /**
     * Get user full name
     *
     * @return string
     */
    public function getFullName(){
        return $this->first_name . ' ' . $this->last_name;
    }


    /**
     * Check user role
     *
     * @param $role
     * @return bool
     */
    public function hasRole($role){
        return $this->role == $role;
    }


    // ----------------------------  Relations ---------------------------- //


    /**
     * Get user(guest) bookings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookings(){
        return $this->hasMany(Booking::class);
    }
}
