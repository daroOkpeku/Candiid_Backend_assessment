<?php

namespace App\Http\Repository;

use App\Events\RegisterEvent;
use App\Models\User;
use App\Http\Repository\Contracts\AuthRespositoryinterface;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRespositoryinterface
{


    public function register($request)
    {
        $generatecode = sha1(time());
       $user = User::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'code'=>$generatecode,
            'password'=>Hash::make($request->password),
        ]);
        event( new RegisterEvent($request->firstname,  $user->code, $request->email));
        return response()->json(['success'=>'You have successfully registered, please check your email']);

    }


    public function login($request){
        $emailcheck =optional(User::where('email', $request->email))->first();
  
      $credentials = $request->only('email', 'password');
  
      if (Hash::check($request->password, $emailcheck->password)) {
  
          if ($emailcheck->email_confirmation != 1) {
              return response()->json(['error' => "Your email is not confirmed."], 403);
          }
              
          $token = bin2hex(random_bytes(40));

          // Save the token
          $emailcheck->update(['api_token' => $token]);
      
  
          $data = [
              'token' => $token,
              'email' => $emailcheck->email,
              'firstname'=>$emailcheck->firstname,
              'lastname'=>$emailcheck->lastname,
              'id' => $emailcheck->id
          ];
          // Sentotpevent::dispatch($otp, $emailcheck->email);
          return response()->json([
              'success' => $data,
              'message' => 'Your have logged in successfully'
          ], 200);
  
      }else{
          return response()->json(['error' => "Your email is not confirmed."], 403);
  
      }
      }
  
    
}