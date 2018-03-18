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

class UserController extends Controller
{
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
        if(!Auth::user()->applications->isEmpty()){
            //check date interval
            $last_application_data = Auth::user()->applications()->latest()->first()->created_at;

            if($last_application_data->addDay(1) < Carbon::now()){

                $this->createNewApplication($request);
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
        }else{
            $this->createNewApplication($request);
            return redirect('/');
        }

    }

    /*
     * Create new application
     * @param request
     * @return void
     */
    public function createNewApplication($request)
    {
        //validate request
        $this->validate($request, [
            'theme' => 'required',
            'message' => 'required'
        ]);

        $application = new Application();
        $user = Auth::user();

        $application->theme = $request->theme;
        $application->message = $request->message;

        $file = $request->file('attachment');

        if($file && $file->isValid()) {
            $url = Storage::disk('public')->put('', $file);
            $application->attachment =  $url;
        }

        $application->user()->associate($user);

        $application->save();

        Notification::send(User::where('email', env('TEST_EMAIL'))->get(), new SendApplication($application, $user));
    }
}
