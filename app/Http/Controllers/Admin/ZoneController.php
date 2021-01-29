<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ZoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::all();
        return response()->json([
            'code' => 200,
            'data' => $zones,
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
        $data = Zone::create([
            'name_zone' => $request->name_zone,
            'name_country' => $request->name_country,
            'name_default' => $request->default
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
        $data = Zone::find($id);
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
        Zone::find($id)->update([
            'name_zone' => $request->name_zone,
            'name_country' => $request->name_country,
            'name_default' => $request->default
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
        Zone::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Delete success'
        ]);
    }
}
