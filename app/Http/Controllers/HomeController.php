<?php

namespace App\Http\Controllers;

use App\Laboratorium;
use App\Tool;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::count();        
        $laboratoria = Laboratorium::count();
        $tools = Tool::count();

        $widget = [
            'users' => $users,
            'laboratoria' => $laboratoria,
            'tools' => $tools
        ];

        return view('home', compact('widget'));
    }
}
