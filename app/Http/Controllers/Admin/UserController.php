<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Traits\StorageImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    use StorageImageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json([
            'code' => 200,
            'data' => $users,
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
        try {
            DB::beginTransaction();
            $user = $request->all();
            $user['password'] = bcrypt($request->password);
            $image_upload = $this->storageUpload($request, 'image', 'user', $request->prod_name);
            if (!empty($image_upload)) {
                $user['image'] = $image_upload['file_path'];
            }
            $addUser = User::create($user);
            DB::commit();
            return response()->json([
                'code' => 201,
                'data' => $addUser
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'line' . $exception->getLine());
            return response()->json([
                'code' => 400,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return response()->json([
            'code' => 200,
            'data' => $user
        ], 200);
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
        try {
            DB::beginTransaction();
            $user = $request->all();
            $user['password'] = bcrypt($request->password);
            $image_upload = $this->storageUpload($request, 'image', 'user', $request->prod_name);
            if (!empty($image_upload)) {
                $user['image'] = $image_upload['file_path'];
            }
            User::find($id)->update($user);
            $user = User::find($id);
            DB::commit();
            return response()->json([
                'code' => 200,
                'message' => 'Update success',
                'data' => $user
            ]);
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('Message' . $exception->getMessage() . 'line' . $exception->getLine());
            return response()->json([
                'code' => 400,
                'message' => $exception->getMessage()
            ], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return response()->json([
            'code' => 200,
            'message' => 'Delete success'
        ]);
    }
}
