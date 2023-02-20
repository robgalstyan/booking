<?php

namespace Database\Seeders;

use App\Http\Services\RoomService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsSeeder extends Seeder
{

    /**
     * Declare RoomService classe
     *
     * @var RoomService
     */
    public $roomService;


    /**
     * Get class new instance
     */
    public function __construct(){
        $this->roomService = new RoomService();
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++){
            $roomData = [
                'number' => $i,
                'price' => rand(10,100)
            ];

            $this->roomService->create($roomData);
        }
    }
}
