<?php


namespace App\Libraries;
use Illuminate\Http\Concerns\InteractsWithInput;
use Illuminate\Support\Facades\Auth;

class Utilities
{
    public static function validateBearer($token){
        $user = Auth::user();
        if($user){
            $api_token = $user->api_token;
            if($token == $api_token){
                return true;
            }else{
                return false;
            }
        }else{
            return $user;
        }
    }
}
