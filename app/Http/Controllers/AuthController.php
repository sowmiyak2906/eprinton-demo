<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrintCalculation;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        if ($name === 'admin' && $email === 'admin@gmail.com' && $password === 'admin123') {
            return redirect()->route('dashboard');
        }

        return redirect()->route('login')->with('error', 'Invalid credentials.');
    }

    public function dashboard()
    {
        return view('dashboard');
    }

    public function savePrintCalculation(Request $request)
{
    // Validate the form fields if needed
    $request->validate([
        'paper_width' => 'required|numeric',
        'paper_height' => 'required|numeric',
        'orientation' => 'required',
        'custom_width' => 'required|numeric',
        'custom_height' => 'required|numeric',
        'total_copies' => 'required|integer',
    ]);

    // Save to database
    PrintCalculation::create([
        'paper_width' => $request->paper_width,
        'paper_height' => $request->paper_height,
        'orientation' => $request->orientation,
        'custom_width' => $request->custom_width,
        'custom_height' => $request->custom_height,
        'total_copies' => $request->total_copies,
    ]);

    return redirect()->back()->with('success', 'Print calculation saved successfully!');
}
}
