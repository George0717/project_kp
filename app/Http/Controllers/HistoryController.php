<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $histories = History::with('user')->paginate(10); // Menggunakan paginate() untuk pagination
        return view('admin.history', compact('histories'));
    }

    // Metode lain tidak perlu diubah untuk riwayat
}
