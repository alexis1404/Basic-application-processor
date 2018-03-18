<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Application;

class ManagerController extends Controller
{
    /*
     * Render manager page with applications list
     * @return view
     */
    public function managerPage()
    {
        $all_applications = Application::with('user')->paginate(20);

        return view('custom_pages.manager_page', compact('all_applications'));
    }
}
