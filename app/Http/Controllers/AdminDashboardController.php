<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\SuratJalan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Ambil semua pengguna
        $users = User::all();

        // Hitung pengguna aktif (dengan asumsi ada kolom 'active' di tabel users)
        $activeUsers = User::where('active', 1)->count();

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

        // Definisikan variabel $months
        $months = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember'
        ];

        // Hitung total Mutasi
        $totalMutasi = Mutasi::count();
        
        // Query untuk mendapatkan data bulanan Mutasi
        $monthlyCountsMutasi = Mutasi::selectRaw('YEAR(tgl_buat) as year, MONTH(tgl_buat) as month, COUNT(*) as count')
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

        // Ambil tahun-tahun dari data Surat Jalan dan Mutasi (jika perlu)
        $yearsSuratJalan = SuratJalan::distinct()->selectRaw('YEAR(tglKirim) as year')->orderBy('year', 'desc')->pluck('year');
        $yearsMutasi = Mutasi::distinct()->selectRaw('YEAR(tgl_buat) as year')->orderBy('year', 'desc')->pluck('year');

        // Gabungkan tahun-tahun dari Surat Jalan dan Mutasi
        $years = $yearsSuratJalan->merge($yearsMutasi)->unique()->sort()->reverse()->values()->all();

        // Kirim data ke view admin dashboard
        return view('admin.dashboard', compact('users', 'activeUsers', 'totalSuratJalan', 'totalMutasi', 'labelsSuratJalan', 'dataSuratJalan', 'labelsMutasi', 'dataMutasi', 'years', 'months'));
    }

    // Tambahkan method filterData jika diperlukan untuk fitur filter
    public function filterData(Request $request)
    {
        $year = $request->get('year', date('Y'));
        $month = $request->get('month', 'all');

        // Filter total Surat Jalan
        $querySuratJalan = SuratJalan::query();
        if ($year) {
            $querySuratJalan->whereYear('tglKirim', $year);
        }
        if ($month && $month !== 'all') {
            $querySuratJalan->whereMonth('tglKirim', $month);
        }
        $totalSuratJalan = $querySuratJalan->count();

        // Filter total Mutasi
        $queryMutasi = Mutasi::query();
        if ($year) {
            $queryMutasi->whereYear('tgl_buat', $year);
        }
        if ($month && $month !== 'all') {
            $queryMutasi->whereMonth('tgl_buat', $month);
        }
        $totalMutasi = $queryMutasi->count();

        // Query for monthly counts of Surat Jalan
        $monthlyCountsSuratJalan = $querySuratJalan->selectRaw('YEAR(tglKirim) as year, MONTH(tglKirim) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Prepare data for chart Surat Jalan
        $labelsSuratJalan = [];
        $dataSuratJalan = [];

        foreach ($monthlyCountsSuratJalan as $count) {
            $labelsSuratJalan[] = $count->month . '/' . $count->year;
            $dataSuratJalan[] = $count->count;
        }

        // Query for monthly counts of Mutasi
        $monthlyCountsMutasi = $queryMutasi->selectRaw('YEAR(tgl_buat) as year, MONTH(tgl_buat) as month, COUNT(*) as count')
            ->groupBy('year', 'month')
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();

        // Prepare data for chart Mutasi
        $labelsMutasi = [];
        $dataMutasi = [];

        foreach ($monthlyCountsMutasi as $count) {
            $labelsMutasi[] = $count->month . '/' . $count->year;
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
    

