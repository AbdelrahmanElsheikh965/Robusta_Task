<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = validator()->make($request->all(), [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());

        $password = Hash::make($request->password);
        $request->merge(['password'=>$password]);
        $user = User::create($request->all());
        $user->api_token = md5(rand());

        $userData = User::where('name', $request->input('name'))->first();

        if ($user->save()){
            return response()->json([
                'token' => $user->api_token,
                'user_data' => $request->except(['password', 'password_confirmation'])
            ]);
        }else
            return json_encode("Error registering this user");
    }
}
