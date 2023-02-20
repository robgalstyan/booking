<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRoomRequest;
use App\Http\Requests\GetRoomsRequest;
use App\Http\Requests\UpdateRoomRequest;
use App\Http\Services\RoomService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class RoomController extends Controller
{

    /**
     * Declare RoomService class
     * @var RoomService
     */
    public $roomService;


    /**
     * Create class new instance
     * @param RoomService $roomService
     */
    public function __construct(RoomService $roomService){
        $this->roomService = $roomService;
    }


    /**
     * Get all rooms
     *
     * @param GetRoomsRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function all(GetRoomsRequest $request){

        $request->book_start = date('Y-m-d', strtotime(now()));
        $request->book_end = date('Y-m-d', strtotime(now()));

        $rooms = $this->roomService->getAll($request->all());

        return view('rooms.all', compact('rooms'));
    }


    /**
     * Get create page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function new(){

        return view('rooms.create');
    }


    /**
     * Get update page
     *
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id){

        // Get room by ID
        $room = $this->roomService->getByID($id);

        return view('rooms.edit', compact('room'));
    }


    /**
     * Create new room
     *
     * @param CreateRoomRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function save(CreateRoomRequest $request){

        // Determine new room data
        $roomData = [
            'price' => $request->price,
            'number' => $request->number,
        ];

        // Create new room
        $this->roomService->create($roomData);

        return redirect('room/all');
    }


    /**
     * Update room
     *
     * @param UpdateRoomRequest $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(UpdateRoomRequest $request, $id){

        // Get room by ID
        $room = $this->roomService->getByID($id);

        // Update room price
        $room->price = $request->price;
        $room->number = $request->number;
        $room->save();

        return redirect('room/all');
    }


    /**
     * Delete room
     *
     * @param $id
     * @return \Illuminate\Http\RedirectResponse|void
     */
    public function delete($id){

        // Get room by ID
        $room = $this->roomService->getByID($id);

        if(!Auth::user()->hasRole('admin')){
            return Redirect::back()->withErrors(['authorization_error' => 'You are not authorized to perform this action․']);
        }

        $room->delete();

        return redirect('room/all');
    }
}
