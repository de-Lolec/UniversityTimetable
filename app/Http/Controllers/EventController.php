<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $events = Event::get(['title','start']);
        return response()->json(["events" => $events]);
    }
}
