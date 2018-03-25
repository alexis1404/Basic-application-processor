<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;

class AuthController extends Controller
{
    private $auth;

    public function __construct(AuthService $authService)
    {
        $this->auth = $authService;
    }

    /*
     * Render register page
     * @return view
     */
    public function registerPage()
    {
        return view('custom_pages.register_page');
    }

    /*
     * Render login page
     * @return view
     */
    public function loginPage()
    {
        return view('custom_pages.login_page');
    }

    /*
     * Create new user (registration)
     * @param Request
     * @return redirect
     */
    public function regForm(Request $request)
    {
        $message = $this->auth->userRegistration($request->name, $request->email, $request->password);

        return redirect('/')->with('message', $message);
    }

    /*
     * Login for all users(authentication)
     * @param Request
     * @return redirect
     */
    public function loginForm(Request $request)
    {
        /**
         * The warning message.
         *
         * @var string
         */
        $message = 'Authentication not complete. Invalid data';
        $actual_user = $this->auth->userLogin($request->email, $request->password);

        if ($actual_user){

            if($actual_user->role->id == 2){
                return redirect('/manager_page');

            }elseif ($actual_user->role->id == 1){
                return redirect('/user_page');
            }

        }else{
            return redirect()->back()->with('message', $message);
        }
    }

    /*
     * Logout user (end session)
     * @return redirect
     */
    public function logout()
    {
        $this->auth->userLogout();

        return redirect('/');
    }
}
