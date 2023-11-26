<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\v1\ResponseData;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            return response(['errors' => $validator->errors()->all()], 422);
        }

        $user = User::where('email', $request->input('email'))->first();

        if (! $user) {
            return response(['errors' => ['User not found']], 404);
        }

        $credentials = $request->only('username', 'password');

        if (! Auth::attempt($credentials)) {
            return response(['errors' => ['Invalid Credentials']], 422);
        }

        $user = Auth::user();

        $user->access_token = $user->createToken('authToken')->accessToken;

        return new ResponseData($user);
    }
}
