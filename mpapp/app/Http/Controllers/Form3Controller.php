<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\Uppercase;

class Form3Controller extends Controller
{
    //
    public function showForm()
    {
        return view('form3');
    }

    public function submitForm(Request $request)
    {
        $request->validate([
            // BASIC VALIDATION
            'name' => ['required', 'min:3', new Uppercase],

            // CUSTOM INPUT VALIDATION
            'email' => 'required|email|unique:users,email',

            // CONDITIONAL VALIDATION
            'phone' => 'required_if:contact_method,phone',

            // ARRAY VALIDATION
            'skills' => 'required|array',

            'password' => 'required|min:6'
        ], [
            // CUSTOM MESSAGES
            'name.required' => 'Name is mandatory bro',
            'name.min' => 'you are too short, english are you?',
            'phone.required_if' => 'Phone is required if you choose phone contact',
            'email.required_if' => 'Email is required if you choose email contact',
        ]);

        return back()->with('success', 'Form3 validated successfully!');
    }
}
