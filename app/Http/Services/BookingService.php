<?php

namespace App\Http\Services;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookingService
{

    /**
     * Declare Booking model
     * @var Booking
     */
    public $bookingModel;


    /**
     * Create class a new instance
     */
    public function __construct(){
        $this->bookingModel = new Booking();
    }


    /**
     * Get booking by ID
     *
     * @param $id
     * @return \Illuminate\Database\Query\Builder|mixed
     */
    public function getByID($id){

        return $this->bookingModel->findOrFail($id);
    }


    /**
     * Get bookings
     *
     * @param $params
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll(){

        return $this->bookingModel->with('room')
            ->where('user_id',Auth::user()->id)
            ->paginate(10);
    }


    /**
     * Booking
     *
     * @param $roomID
     * @param $bookStartDate
     * @param $bookEndDate
     * @return bool
     */
    public function booking($roomID, $bookStartDate, $bookEndDate){

        $this->bookingModel->room_id = $roomID;
        $this->bookingModel->user_id = Auth::user()->id;
        $this->bookingModel->book_start = Carbon::parse($bookStartDate);
        $this->bookingModel->book_end = Carbon::parse($bookEndDate . ' 23:59:59');
        $this->bookingModel->save();

        return true;
    }


    /**
     * Update booking dates
     *
     * @param $bookingID
     * @param $bookStartDate
     * @param $bookEndDate
     * @return bool
     */
    public function update($bookingID, $bookStartDate, $bookEndDate){

        $bookingObject = $this->getByID($bookingID);
        $bookingObject->book_start = Carbon::parse($bookStartDate);
        $bookingObject->book_end = Carbon::parse($bookEndDate . ' 23:59:59');
        $bookingObject->save();

        return true;
    }


    /**
     * Check exists bookings for entered period
     *
     * @param $roomID
     * @param $bookStartDate
     * @param $bookEndDate
     * @return bool
     */
    public function checkExistsBookings($roomID, $bookStartDate, $bookEndDate){

        return $this->bookingModel->where('room_id', '=', $roomID)
            ->where(function($query) use ($bookStartDate, $bookEndDate){
                $query->where(function ($bookingsQuery) use($bookStartDate, $bookEndDate){
                    $bookingsQuery->whereBetween('book_start', [$bookStartDate, $bookEndDate])
                        ->orWhereBetween('book_end', [$bookStartDate, $bookEndDate])
                        ->orWhere(function ($bookingsQuery) use($bookStartDate, $bookEndDate){
                            $bookingsQuery->where('book_start', '<=', $bookStartDate)
                                ->where('book_end', '>=', $bookEndDate);
                        });
                });
            })
            ->exists();
    }


}
