<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Workplace;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WorkplaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $workplaces = Workplace::all();
        return response()->json([
            'code' => 200,
            'data' => $workplaces,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Workplace::create([
            'name' => $request->name,
            'price' => $request->price,
            'zone_id' => $request->zone_id,
            'location' => $request->location,
            'image_thumb' => $request->image_thumb,
            'quantity_meetup' => $request->quantity_meetup,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,

        ]);
        return response()->json([
            'code' => 200,
            'data' => $data
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
        $data = Workplace::find($id);
        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
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
        Workplace::find($id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'zone_id' => $request->zone_id,
            'location' => $request->location,
            'image_thumb' => $request->image_thumb,
            'quantity_meetup' => $request->quantity_meetup,
            'longitude' => $request->longitude,
            'latitude' => $request->latitude,

        ]);
        return response()->json([
            'code' => 200,
            'message' => 'Update Success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Workplace::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Delete success'
        ]);
    }
}
