<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\User;
use App\Role;

class AuthController extends Controller
{
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
        $new_user = new User();

        $new_user->name = $request->name;
        $new_user->email = $request->email;
        $new_user->password = Hash::make($request->password);

        $new_user->role()->associate(Role::find(1));

        $new_user->save();

        /**
         * The warning message.
         *
         * @var string
         */
        $message = 'Your account has been successfully registered';

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

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {

            $user = Auth::user();
            if($user->role->id == 2){
                return redirect('/manager_page');

            }elseif ($user->role->id == 1){
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
        Auth::logout();

        return redirect('/');
    }
}
