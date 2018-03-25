<?php

namespace App\Services;

use App\Application;
use Storage;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use App\Notifications\SendApplication;


class UserService
{
    private $auth;

    public function __construct(AuthService $authService)
    {
        $this->auth = $authService;
    }

    /*
    * Create new application with check time (24 hours)
     *
    * @param string
     * @param string
     * @param file
     *
    * @return boolean
    */
    public function createApplicationWithTimeCheck($theme, $message, $file)
    {
        if(!$this->auth->getAuthUser()->applications->isEmpty()){
            //check date interval
            $last_application_data = $this->auth->getAuthUser()->applications()->latest()->first()->created_at;

            if($last_application_data->addDay(1) < Carbon::now()){
                $this->createNewApplication($theme, $message, $file);
                return true;
            }else{
                return false;
            }

        }else{
            $this->createNewApplication($theme, $message, $file);
            return true;
        }
    }

    /*
    * Create new application
    * @param request
    * @return void
    */
    public function createNewApplication($theme, $message, $file)
    {
        $application = new Application();
        $user = $this->auth->getAuthUser();

        $application->theme = $theme;
        $application->message = $message;

        if($file && $file->isValid()) {
            $url = Storage::disk('public')->put('', $file);
            $application->attachment =  $url;
        }

        $application->user()->associate($user);

        $application->save();

        Notification::send(User::where('email', env('TEST_EMAIL'))->get(), new SendApplication($application, $user));
    }
}