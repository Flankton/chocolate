<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listUser(){
        
        echo "<h1>lista de usuários</h1>";
    }

    public function index(){
        echo 'Hello Word';
    }
}
