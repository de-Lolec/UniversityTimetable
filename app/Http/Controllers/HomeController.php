<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Timetable;
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
     //   $item = Timetable::all();
        $item = timetable::paginate(5);
        //return view('users.profile');

        return view('Timetable',
            compact('item'));
    }
}
