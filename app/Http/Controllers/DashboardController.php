<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\SuratJalan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Generate year options
        $years = range(date('Y') - 10, date('Y'));

        // Generate month options
        $months = [
            '01' => 'Januari',
            '02' => 'Februari',
            '03' => 'Maret',
            '04' => 'April',
            '05' => 'Mei',
            '06' => 'Juni',
            '07' => 'Juli',
            '08' => 'Agustus',
            '09' => 'September',
            '10' => 'Oktober',
            '11' => 'November',
            '12' => 'Desember'
        ];

        // Hitung total Surat Jalan
        $totalSuratJalan = SuratJalan::count();

        // Query untuk mendapatkan data bulanan Surat Jalan
        $monthlyCountsSuratJalan = SuratJalan::selectRaw('DATE_FORMAT(tglKirim, "%m/%Y") as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Siapkan data untuk chart Surat Jalan
        $labelsSuratJalan = [];
        $dataSuratJalan = [];

        foreach ($monthlyCountsSuratJalan as $count) {
            $labelsSuratJalan[] = $count->date;
            $dataSuratJalan[] = $count->count;
        }

        // Hitung total Mutasi
        $totalMutasi = Mutasi::count();

        // Query untuk mendapatkan data bulanan Mutasi
        $monthlyCountsMutasi = Mutasi::selectRaw('DATE_FORMAT(tgl_buat, "%m/%Y") as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Siapkan data untuk chart Mutasi
        $labelsMutasi = [];
        $dataMutasi = [];

        foreach ($monthlyCountsMutasi as $count) {
            $labelsMutasi[] = $count->date;
            $dataMutasi[] = $count->count;
        }

        // Combine labels
        $labels = array_unique(array_merge($labelsSuratJalan, $labelsMutasi));

        return view('dashboard.index', compact('years', 'months', 'totalSuratJalan', 'labelsSuratJalan', 'dataSuratJalan', 'totalMutasi', 'labelsMutasi', 'dataMutasi'));
    }

    public function filterData(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

        // Filter total Surat Jalan
        $querySuratJalan = SuratJalan::query();
        if ($startDate && $endDate) {
            $querySuratJalan->whereBetween('tglKirim', [$startDate, $endDate]);
        }
        $totalSuratJalan = $querySuratJalan->count();

        // Filter total Mutasi
        $queryMutasi = Mutasi::query();
        if ($startDate && $endDate) {
            $queryMutasi->whereBetween('tgl_buat', [$startDate, $endDate]);
        }
        $totalMutasi = $queryMutasi->count();

        // Query for monthly counts of Surat Jalan
        $monthlyCountsSuratJalan = $querySuratJalan->selectRaw('DATE_FORMAT(tglKirim, "%m/%Y") as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Prepare data for chart Surat Jalan
        $labelsSuratJalan = [];
        $dataSuratJalan = [];

        foreach ($monthlyCountsSuratJalan as $count) {
            $labelsSuratJalan[] = $count->date;
            $dataSuratJalan[] = $count->count;
        }

        // Query for monthly counts of Mutasi
        $monthlyCountsMutasi = $queryMutasi->selectRaw('DATE_FORMAT(tgl_buat, "%m/%Y") as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Prepare data for chart Mutasi
        $labelsMutasi = [];
        $dataMutasi = [];

        foreach ($monthlyCountsMutasi as $count) {
            $labelsMutasi[] = $count->date;
            $dataMutasi[] = $count->count;
        }

        // Combine labels
        $labels = array_unique(array_merge($labelsSuratJalan, $labelsMutasi));

        return response()->json([
            'totalSuratJalan' => $totalSuratJalan,
            'totalMutasi' => $totalMutasi,
            'labels' => $labels,
            'dataSuratJalan' => $dataSuratJalan,
            'dataMutasi' => $dataMutasi
        ]);
    }
}
