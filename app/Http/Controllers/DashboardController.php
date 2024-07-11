<?php

namespace App\Http\Controllers;

use App\Models\History;
use App\Models\SuratJalan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
       // Hitung total Surat Jalan
       $totalSuratJalan = SuratJalan::count();
       // Query untuk mendapatkan data bulanan
       $monthlyCounts = SuratJalan::selectRaw('YEAR(tglKirim) as year, MONTH(tglKirim) as month, COUNT(*) as count')
       ->groupBy('year', 'month')
       ->orderBy('year', 'asc')
       ->orderBy('month', 'asc')
       ->get();
       
       // Siapkan data untuk chart
       $labels = [];
       $data = [];
       
       foreach ($monthlyCounts as $count) {
           $labels[] = $count->month . '/' . $count->year;
           $data[] = $count->count;
       }
       
       return view('dashboard.index', compact('totalSuratJalan', 'labels', 'data'));
    }
    
}
