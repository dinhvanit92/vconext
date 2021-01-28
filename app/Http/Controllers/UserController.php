<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{

    public function index()
    {
        $user = auth()->user();
        return response()->json([
            'code' => 200,
            'data' => $user
        ], 200);
    }

    public function update(Request $request)
    {
        try {
            DB::beginTransaction();
            $user = $request->all();
            $user['password'] = bcrypt($request->password);
            $image_upload = $this->storageUpload($request, 'image', 'user', $request->prod_name);
            if (!empty($image_upload)) {
                $user['image'] = $image_upload['file_path'];
            }
            User::find(auth()->user()->id)->update($user);
            $user = User::find(auth()->user()->id);
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
}
