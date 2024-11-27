<?php

namespace App\Http\Controllers;

use App\Http\Repository\Contracts\PostRespositoryinterface;
use App\Http\Requests\CreatetaskRequest;
use App\Http\Requests\EditIdtaskRequest;
use App\Http\Requests\IdtaskRequest;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public $postmethod;
    public function __construct(PostRespositoryinterface $postinterface)
    {
        $this->postmethod = $postinterface;
    }


    public function create_task(CreatetaskRequest $request){
        return  $this->postmethod->create_task($request);
      }

      public function delete_task(IdtaskRequest $request){
        // $validated = request()->validate([
        //     'id' => 'required|integer',
        // ]);
      return $this->postmethod->delete_task($request);
      }

      public function single_task(Request $request){
        $request->validate([
            "id"=>"required|integer"
        ]);
        return $this->postmethod->single_task($request);
      }

      public function edit_task(EditIdtaskRequest $request){
    return $this->postmethod->edit_task($request);
      }
}
