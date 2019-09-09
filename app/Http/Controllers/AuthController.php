<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use \Illuminate\Foundation\Auth\AuthenticatesUsers;
    //register new user
    public function register(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        if($validator->fails()){
            return response()->json(['error'=>$validator->errors()], 401);
        }
        //create record
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $user->createToken('clane')->accessToken;
        return response()->json(['token' => $token], 200);
    }

    //login
    public function login(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            //  passed...
            $token = auth()->user()->createToken('clane')->accessToken;
            return response()->json(['token' => $token], 200);
        }else{
            return response()->json(['error' => 'Email or password is wrong'], 401);
        }
    }


}
