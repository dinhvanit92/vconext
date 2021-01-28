<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $response = Http::asForm()->get('https://conext.asia/api/past-event?zone_id=3');
        $result = $response->json('result');
        foreach ($result['listPastEvent'] as $value) {
            Event::create([
                'title' => $value['title'],
                'content' => $value['content'],
                'image' => $value['image'],
                'localtion' => $value['location'],
                'start_time' => $value['start_time'],
                'end_time' => $value['end_time'],
                'status' => $value['status'],
                'zone_id' => $value['zone_id'],
            ]);
        }
        return response()->json([
            'status' => "Thanh Cong"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
