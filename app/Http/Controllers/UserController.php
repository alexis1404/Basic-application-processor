<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendApplication;
use App\User;
use App\Application;
use Storage;
use Auth;
use Carbon\Carbon;
use App\Services\UserService;

class UserController extends Controller
{
    private $user_manager;

    public function __construct(UserService $userService)
    {
        $this->user_manager = $userService;
    }

    /*
     * Render user page
     * @return view
     */
    public function userPage()
    {
        return view('custom_pages.user_page');
    }

    /*
     * Handling user`s application form
     * @param request
     */
    public function userForm(Request $request)
    {
        //validate request
        $this->validate($request, [
            'theme' => 'required',
            'message' => 'required'
        ]);

        $file = $request->file('attachment');

        if($this->user_manager->createApplicationWithTimeCheck($request->theme, $request->message, $file)){
            return redirect('/');
        }else{
            /**
             * The warning message.
             *
             * @var string
             */
            $message = 'You can create only one application in 24 hours!';

            return redirect('/user_page')->with('message', $message);

        }

    }
}
