<?php

namespace App\Services;

use App\User;
use App\Role;
use Auth;
use Hash;

class AuthService
{
    /*
     * Create new user (registration)
     *
     * @param1 string
     * @param2 string
     * @param3 string
     *
     * @return string
     */
    public function userRegistration($name, $email, $password)
    {
        $new_user = new User();

        $new_user->name = $name;
        $new_user->email = $email;
        $new_user->password = Hash::make($password);

        $new_user->role()->associate(Role::find(1));

        $new_user->save();

        /**
         * The warning message.
         *
         * @var string
         */
        $message = 'Your account has been successfully registered';

        return $message;
    }

    /*
     * Login user
     *
     * @param1 string
     * @param2 string
     *
     * @return object User or false
     */
    public function userLogin($email, $password)
    {
        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            return $user = Auth::user();
        }else{
            return false;
        }
    }

    /*
     * Logout user
     *
     * @return void
     */
    public function userLogout()
    {
        Auth::logout();
    }

    public function getAuthUser()
    {
        $auth_user = Auth::user();

        if($auth_user){
            return $auth_user;
        }else{
            return false;
        }
    }

}