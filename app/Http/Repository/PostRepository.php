<?php

namespace App\Http\Repository;

use App\Http\Repository\Contracts\PostRespositoryinterface;
use App\Http\Resources\TaskResource;
use App\Models\Task;

class PostRepository implements PostRespositoryinterface
{

   public function create_task($request){
    Task::create([
        'title'=>$request->title,
        'description'=>$request->description,
        'status'=>$request->status,
       'due_date'=>$request->due_date
    ]);

    return response()->json(['success'=>'you have created a task'],200);
   }

   public function delete_task($request){
    $deletetask = Task::find($request->id);
    if($deletetask){
        $deletetask->delete();
        $task = Task::orderBy('created_at', 'desc')->paginate(8);
        return TaskResource::collection($task)->additional(['success' => true]);
    }else{
        return response()->json(['error'=>'something went wrong'],200);
    }
   }

   public function single_task($request){
    $task = Task::find($request->get('id'));
    if($task){
        return response()->json(["success"=>$task],200);   
    }else{
        return response()->json(['error'=>'something went wrong'],200);
    }
   }


   public function edit_task($request){
    try {
        $task = Task::findOrFail(intval($request->id)); 
        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'due_date' => $request->due_date
        ]);

        return response()->json(["success" => "You have edited a task"], 200);
    } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        return response()->json(['error' => 'Task not found'], 404);
    }
   }
}
