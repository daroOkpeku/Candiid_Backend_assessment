<?php


namespace App\Http\Repository\Contracts;


interface AuthRespositoryinterface{

    public function register($request);
    public function login($request);
}