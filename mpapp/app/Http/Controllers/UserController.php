<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function getUser()
    {
        return "Aryan Chopra";
    }
    public function aboutUser()
    {
        return "hello this is about page";
    }

    public function userhome2()
    {
        $name = "rishab";
        return view('about2',  ['name' => $name]);
    }
}
