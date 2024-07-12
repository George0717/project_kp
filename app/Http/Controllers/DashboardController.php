<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\SuratJalan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Hitung total Surat Jalan
        $totalSuratJalan = SuratJalan::count();
        // Query untuk mendapatkan data bulanan Surat Jalan
        $monthlyCountsSuratJalan = SuratJalan::selectRaw('YEAR(tglKirim) as year, MONTH(tglKirim) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Siapkan data untuk chart Surat Jalan
        $labelsSuratJalan = [];
        $dataSuratJalan = [];

        foreach ($monthlyCountsSuratJalan as $count) {
            $labelsSuratJalan[] = $count->month . '/' . $count->year;
            $dataSuratJalan[] = $count->count;
        }

        // Hitung total Mutasi
        $totalMutasi = Mutasi::count();
        // Query untuk mendapatkan data bulanan Mutasi
        $monthlyCountsMutasi = Mutasi::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Siapkan data untuk chart Mutasi
        $labelsMutasi = [];
        $dataMutasi = [];

        foreach ($monthlyCountsMutasi as $count) {
            $labelsMutasi[] = $count->month . '/' . $count->year;
            $dataMutasi[] = $count->count;
        }

        // Assuming both charts have the same labels, otherwise we might need to handle it differently
        return view('dashboard.index', compact('totalSuratJalan', 'labelsSuratJalan', 'dataSuratJalan', 'totalMutasi', 'dataMutasi'));
    }
}
