<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    //

    public function store(LoginRequest $request){
        try{
            if ($user = $request->apiAuthenticate()) {
                $user["token"] = $user->createApiToken();
                return response()->json([
                    "success" => true,
                    "data" => $user
                ],200);    
           }
           return response()->json([
                "success" => false,
                "message" => config("messages.invalid_credentials")
            ],422); 
        }catch(\Exception $ex){
            return response()->json([
                "success" => false,
                "message" => $ex->getMessage()

            ],400);
        }
    }

}
