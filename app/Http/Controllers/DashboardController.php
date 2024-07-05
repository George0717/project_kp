<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $histories = History::all();
        return view('dashboard', compact('histories'));
    }
    
}
