<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $voucher = Voucher::all();
        return response()->json([
            'code' => 200,
            'data' => $voucher,
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
        $data = Voucher::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'expried_at' => $request->expired_at,
            'priority' => $request->priority,

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
        $data = Voucher::find($id);
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
        Voucher::find($id)->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
            'expried_at' => $request->expired_at,
            'priority' => $request->priority,

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
        Voucher::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Delete success'
        ]);
    }
}
