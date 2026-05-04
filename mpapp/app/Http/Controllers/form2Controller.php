<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class form2Controller extends Controller
{
    //
    public function showForm()
    {
        return view('form2');
    }
    public function submitForm(Request $request)
    {
        // VALIDATION
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
            'dob' => 'required|date',
            'gender' => 'required',
            'skills' => 'required|array',
            'country' => 'required'
        ], [
            // CUSTOM ERROR MESSAGES
            'name.required' => 'Name is required',
            'email.email' => 'Enter a valid email',
            'password.min' => 'Password must be at least 6 characters',
            'skills.required' => 'Select at least one skill',
            'gender.required' => 'Please select gender',
        ]);

        // SUCCESS RESPONSE
        return back()->with('success', 'Form submitted successfully!');
    }
}
