<?php


namespace App\Http\Repository\Contracts;


interface PostRespositoryinterface{

public function create_task($request);
public function delete_task($request);
public function single_task($request);
public function edit_task($request);
}
