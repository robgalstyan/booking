<?php

namespace App\Rules;

use App\Http\Services\BookingService;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class BookingRule implements Rule
{
    public $roomID;
    public $bookStartDate;
    public $bookingService;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($roomID, $bookStartDate)
    {
        $this->roomID = $roomID;
        $this->bookStartDate = $bookStartDate;
        $this->bookingService = new BookingService();
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $bookEndDate)
    {
        // Check exists booking for entered period
        $bookingAlreadyExists = $this->bookingService->checkExistsBookings($this->roomID, $this->bookStartDate, $bookEndDate);

        if(!$bookingAlreadyExists){
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There is already a booking(s) for the period entered.';
    }
}
