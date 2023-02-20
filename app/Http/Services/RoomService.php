<?php

namespace App\Http\Services;

use App\Models\Room;
use Carbon\Carbon;

class RoomService
{
    /**
     * Declare Room model
     * @var Room
     */
    public $roomModel;


    /**
     * Create class new instance
     */
    public function __construct(){
        $this->roomModel = new Room();
    }


    /**
     * Get room by ID
     *
     * @param $id
     * @return mixed
     */
    public function getByID($id){
        return $this->roomModel->findOrFail($id);
    }


    /**
     * Get rooms list
     *
     * @return mixed
     */
    public function getAll($queryParams = []){

        $bookStartDate = isset($queryParams['book_start'])
            ? Carbon::parse($queryParams['book_start'])
            : Carbon::parse(date('Y-m-d'));

        $bookEndDate = isset($queryParams['book_end'])
            ? Carbon::parse($queryParams['book_end'] . ' 23:59:59')
            : Carbon::parse(date('Y-m-d') . ' 23:59:59');

        $query = $this->roomModel->with(
            [
                'bookings.guest',
                'bookings' => function($bookings) use($bookStartDate, $bookEndDate){
                    $bookings->where(function ($bookingsQuery) use($bookStartDate, $bookEndDate){
                        $bookingsQuery->where('book_start', '>=', $bookStartDate)
                            ->where('book_start', '<=', $bookEndDate);
                        })
                        ->orWhere(function ($bookingsQuery) use($bookStartDate, $bookEndDate){
                            $bookingsQuery->where('book_end', '>=', $bookStartDate)
                                ->where('book_end', '<=', $bookEndDate);
                        })
                        ->orWhere(function ($bookingsQuery) use($bookStartDate, $bookEndDate){
                            $bookingsQuery->where('book_start', '<=', $bookStartDate)
                                ->where('book_end', '>=', $bookEndDate);
                        });
                }
            ]
        );

        return $query->orderByDesc('id')->paginate(10);
    }


    /**
     * Create new room
     *
     * @param $roomData
     * @return Room
     */
    public function create($roomData){
        $roomModel = new Room();
        $roomModel->number = $roomData['number'];
        $roomModel->price = $roomData['price'];
        $roomModel->save();

        return $roomModel;
    }


    /**
     * Update room
     *
     * @param $room
     * @param $price
     * @return mixed
     */
    public function update($room, $price){
        $room->price = $price;
        $room->save();

        return $room;
    }
}
