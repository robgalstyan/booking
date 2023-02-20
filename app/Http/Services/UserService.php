<?php

namespace App\Http\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{

    /**
     * Declare User class
     * @var User
     */
    public $userModel;


    /**
     * Get class new instance
     */
    public function __construct(){
        $this->userModel = new User();
    }


    /**
     * Get user by email
     *
     * @param $email
     * @return mixed
     */
    public function getByEmail($email){
        return $this->userModel->where('email', $email)->first();
    }


    /**
     * Create new user
     *
     * @param $userData
     * @return User
     */
    public function create($userData){

        $userModel = new User();
        $userModel->first_name = $userData['first_name'];
        $userModel->last_name = $userData['last_name'];
        $userModel->email = $userData['email'];
        $userModel->password = Hash::make($userData['password']);
        $userModel->role = $userData['role'];
        $userModel->save();

        return $this->userModel;
    }
}
