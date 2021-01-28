<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\OauthToken;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;

class OauthTokenController extends Controller
{
    private $request;
    private $oauthToken;
    public function __construct(Request $request, OauthToken $oauthToken)
    {
        $this->request = $request;
        $this->oauthToken = $oauthToken;
    }
    public function getTokens()
    {
        $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
            'grant_type' => 'password',
            'client_id' => '2',
            'client_secret' => '3dPTgxUJ187RLdciccw6yOCRvOSJ4OodQv0VHsi4',
            'username' => $this->request->email,
            'password' => $this->request->password,
            'scope' => '*',
        ]);
        $result = $response->json();
        if (auth()->user()) {
            $this->request->user()->token()->delete();
            $data = $this->request->user()->token()->create([
                'access_token' => $result['access_token'],
                'expires_in' => $result['expires_in'],
                'refresh_token' => $result['refresh_token'],
            ]);
        }

        return response()->json($result, 200);
    }
    public function refreshToken(Request $request)
    {
        // dd($request->refresh_token);
        if ($Oauth = $this->oauthToken->where('refresh_token', $request->refresh_token)->first()) {

            $response = Http::asForm()->post(env('APP_URL') . '/oauth/token', [
                'grant_type' => 'refresh_token',
                'client_id' => '2',
                'client_secret' => '6ziut8RXDJ834BttSBMKX2GPVc8zbp4Dcjz6dWr0',
                'refresh_token' => $request->refresh_token,
                'scope' => '*',
            ]);
            $result = $response->json();

            $Oauth->update([
                'access_token' => $result['access_token'],
                'expires_in' => $result['expires_in'],
                'refresh_token' => $result['refresh_token'],
            ]);
            return response()->json($result, 200);
        } else {
            return response()->json([
                'code' => 403,
                'message' => 'refresh_token khong dung'
            ]);
        }
    }
}
