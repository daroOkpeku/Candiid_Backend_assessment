<?php

namespace App\Http\Controllers;

use App\Http\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class GetController extends Controller
{


    public function alltask (){
        $task = Task::orderBy('created_at', 'desc')->paginate(8);
        return TaskResource::collection($task)->additional(['success' => true]);
        }



        public function verify_email(Request $request)
        {
            $user = User::where(['email' => $request->get('email'), 'code' => $request->get('code')])->first();
            if ($user) {
                $user->update([
                    'confirm_status' => 1
                ]);
                return response()->json(['success' => 'Your email has been confirmed', 'status' => true], 200);
            } else {
                return response()->json(['error' => 'Email not Found', 'status' => false], 404);
            }
        }
}
