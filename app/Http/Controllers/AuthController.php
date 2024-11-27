<?php

namespace App\Http\Controllers;

use App\Http\Repository\Contracts\AuthRespositoryinterface;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public $authmethod;
    public function __construct(AuthRespositoryinterface $authinterface)
    {
        $this->authmethod = $authinterface;
    }

   public function register(RegisterRequest $request){
    return $this->authmethod->register($request);
   }

    public function login(LoginRequest $request){
     return $this->authmethod->login($request);
    }

    public function logout(){
        auth()->user()->tokens()->delete();
        return response()->json(['success'=>'logged out']);
    }
}
