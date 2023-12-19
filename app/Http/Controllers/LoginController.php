<?php

namespace App\Http\Controllers;

use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use HttpResponses;

    public function login(Request $request){
        if(Auth()->attempt($request->only('email', 'password'))){
            return $this->response('Authorized',[
                'token' => $request->user()->createToken('password')->plainTextToken
            ]);
        }
        return $this->error('Unauthorized');
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();

        return $this->response('Logout with success', [
            'token' => 'Token revoked.'
        ]);
    }
}