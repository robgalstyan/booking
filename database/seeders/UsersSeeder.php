<?php

namespace Database\Seeders;

use App\Http\Services\UserService;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{

    public $userServcie;


    public function __construct(UserService $userService){
        $this->userServcie = $userService;
    }


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            'first_name' => 'Chuck',
            'last_name' => 'Norris',
            'email' => 'admin@gmail.com',
            'password' => 'admin123',
            'role' => 'admin'
        ];

        $this->userServcie->create($userData);
    }
}
