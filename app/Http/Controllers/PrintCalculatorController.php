<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PrintCalculatorController extends Controller
{
    
        public function index()
        {
            return view('dashboard');
        }
    
        public function store(Request $request)
        {
            $data = $request->validate([
                'paper_width' => 'required',
                'paper_height' => 'required',
                'orientation' => 'required',
                'custom_width' => 'required',
                'custom_height' => 'required',
                'total_copies' => 'required|integer',
            ]);
    
            $calculation = PrintCalculation::create($data);
    
            return response()->json([
                'success' => true,
                'data' => $calculation,
            ]);
        }
    }
    

