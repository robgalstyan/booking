<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Services\AuthService;
use App\Http\Services\UserService;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Declare AuthService class
     * @var AuthService
     */
    public $authService;


    /**
     *Declare UserService class
     * @var UserService
     */
    public $userService;


    /**
     * Create class new instance
     */
    public function __construct(){
        $this->authService = new AuthService();
        $this->userService = new UserService();
    }


    /**
     * Get register page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegistrationView(){
        return view('register');
    }


    /**
     * Get login page
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginView(){
        return view('login');
    }


    /**
     * User Registration
     *
     * @param RegisterRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(RegisterRequest $request){

        $userData = $request->all();
        $userData['role'] = 'guest';

        $this->userService->create($userData);

        return redirect('login')->with('success', 'Registration has been successfully');
    }


    /**
     * Login in the system
     *
     * @param LoginRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login(LoginRequest $request){

        // Attempt to login in the system
        $loggedInUser = $this->authService->attemptToLogin($request->email, $request->password);

        // Login failed
        if(!$loggedInUser){
            return redirect('login')->with('login_error', 'Login failed. These credentials do not match our records.');
        }

        // Successfully logged in
        Auth::login($loggedInUser);

        return redirect('room/all');
    }


    /**
     * Logout from system
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function logout(){

        Auth::logout();
        return redirect('login');
    }
}
