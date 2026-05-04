<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    // 
    public function showForm()
    {
        return view('form');
    }

    public function addUser(Request $request)
    {
        echo  $request->input('name');
    }
    // public function addUser()
    // {
    //     return "add user function called";
    // }

    public function showAll(Request $request)
    {
        return $request->all();
    }
}
