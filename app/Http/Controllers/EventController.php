<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getUpcomingEvent()
    {
        $event = Event::where('status', 'Upcoming Event')->get()->all();
        return response()->json([
            'code' => 200,
            'data' => $event
        ], 200);
    }
    public function getPastEvent()
    {
        $event = Event::where('status', 'Past Event')->get()->all();
        return response()->json([
            'code' => 200,
            'data' => $event
        ], 200);
    }
}
