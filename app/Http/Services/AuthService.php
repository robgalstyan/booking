<?php

namespace App\Http\Services;

use Illuminate\Support\Facades\Hash;

class AuthService
{
    /**
     * Declare UserService class
     * @var UserService
     */
    public $userService;


    /**
     * Get class new instance
     */
    public function __construct(){
        $this->userService = new UserService();
    }


    /**
     * Attempt to login user
     *
     * @param $email
     * @param $password
     * @return false|mixed
     */
    public function attemptToLogin($email, $password){

        // Get user by email
        $user = $this->userService->getByEmail($email);

        // Check if the user exists and if the password is correct
        if($user && Hash::check($password, $user->password)){
            return $user;
        }

        return false;
    }

}
