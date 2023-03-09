<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\resetEmail;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $rules = [
            'name' => 'required',
            'email' => 'required|email:rfc,dns|unique:users',
            'password' => 'required|confirmed|min:8'
        ];
        $validator = validator()->make($request->all(), $rules);

        if ($validator->fails())
            return response()->json($validator->errors());

        $password = Hash::make($request->password);
        $request->merge(['password'=>$password]);
        $user = User::create($request->all());
        $user->api_token = md5(rand());

        if ($user->save()){
            return response()->json([
                'token' => $user->api_token,
                'user_data' => $request->except(['password', 'password_confirmation'])
            ]);
        }else
            return json_encode("Error registering this user");
    }

    public function login(Request $request){
        $validation = validator()->make($request->all(), [
            'email'     => 'required|email:rfc,dns',
            'password'  => 'required'
        ]);
        if ($validation->fails())
            return response()->json($validation->errors());

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password) ) {
            return response()->json([
                'token' => $user->api_token,
                'user_data' => [
                    'name' => $user->name,
                    'email' => $user->email
                ]]);
        }
        return json_encode(["Incorrect Data!"]);
    }

    public function resetPassword(Request $request){
        $validate = validator()->make($request->all(), [ 'email' => 'required|email:rfc,dns']);
        if ($validate->fails())
            return response()->json($validate->errors());

        $userData = User::where('email', $request->email)->first();

        if ($userData->pin_code === null) {
            $generatedPinCode = rand(100000, 1000000);
            $user = User::where('email', $request->email)->update(['pin_code' => $generatedPinCode]);
            $mailData = [
                'title' => 'Your PinCode is Ready',
                'body' => 'It\'s just an email to provide you with your pin_code '. $generatedPinCode
            ];
            $mailResult = \Mail::to($userData->email)->send(new resetEmail($mailData));
            if ($user && $mailResult)
                return response()->json('Your pin code is ready check your email inbox!');
        }
        return response()->json('Error - Check your email');
    }

    public function createNewPassword(Request $request){
        $validator = validator()->make($request->all(), [
            'email' =>    'required',
            'pin_code' => 'required|integer',
            'password' => 'required|confirmed|min:8'
        ]);

        if ($validator->fails())
            return response()->json($validator->errors());
        $password = Hash::make($request->password);

        # Ensure this user is registered and if so update his credentials.
        $userPinCode = User::where('email', $request->email)
            ->where('pin_code', $request->pin_code)
            ->update(['password'=> $password, 'pin_code' => null]);
        if ($userPinCode) {
            return response()->json('Your Password has been updated successfully');
        }else{
            return json_encode(["Incorrect Data!"]);
        }
    }

}
