<?php

namespace App\Policies;

use App\Http\Services\BookingService;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BookingPolicy
{
    use HandlesAuthorization;


    /**
     * Declare BookingService class
     * @var BookingService
     */
    public $bookingService;


    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->bookingService = new BookingService();
    }


    /**
     * Determine if user has permission room booking
     *
     * @param User $user
     * @param $room
     * @return bool
     */
    public function booking(User $user){

        if($user->hasRole('guest')){
            return true;
        }

        return false;
    }


    /**
     * Determine if user has permission manage booking
     *
     * @param User $user
     * @param $roomID
     * @return bool
     */
    public function manage(User $user, $bookingID){

        if($user->hasRole('guest')){
            $bookingObject = $this->bookingService->getByID($bookingID);

            if($user->id == $bookingObject->user_id){
                return true;
            }
        }

        return false;
    }
}
