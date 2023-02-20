<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookingRequest;
use App\Http\Requests\DeleteBookingRequest;
use App\Http\Requests\GetBookingsRequest;
use App\Http\Requests\UpdateBookingRequest;
use App\Http\Services\BookingService;
use App\Http\Services\RoomService;

class BookingController extends Controller
{
    /**
     * Declare BookingService class
     * @var BookingService
     */
    public $bookingService;


    /**
     * Declare RoomService class
     * @var RoomService
     */
    public $roomService;


    /**
     * Create class new instance
     *
     * @param BookingService $bookingService
     */
    public function __construct(
        BookingService $bookingService,
        RoomService $roomService
    ){
        $this->bookingService = $bookingService;
        $this->roomService = $roomService;
    }


    /**
     * Get user bookings
     *
     * @param GetBookingsRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function all(GetBookingsRequest $request){

        // Get user bookings
        $bookings = $this->bookingService->getAll();

        return view('bookings.all', compact('bookings'));
    }


    /**
     * Get create-new-booking page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showBookingView($id){

        $room = $this->roomService->getByID($id);

        return view('bookings.create', compact('room'));
    }


    /**
     * Booking
     *
     * @param BookingRequest $request
     * @param $roomID
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function booking(BookingRequest $request, $roomID){

        // Booking
        $this->bookingService->booking($roomID, $request->book_start, $request->book_end);

        return redirect('booking/all');
    }


    /**
     * Get edit page
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id){

        // Get booking by ID
        $booking = $this->bookingService->getByID($id);

        return view('bookings.edit', compact('booking'));
    }


    /**
     * Update
     *
     * @param $bookingID
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function update(UpdateBookingRequest $request, $bookingID){

        // Update booking
        $this->bookingService->update($bookingID, $request->book_start, $request->book_end);

        return redirect('booking/all');
    }


    /**
     * Delete
     *
     * @param $roomID
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function delete(DeleteBookingRequest $request, $bookingID){

        // Get room by ID
        $bookingObject = $this->bookingService->getByID($bookingID);

        // Delete booking
        $bookingObject->delete();

        return redirect('booking/all');
    }
}
