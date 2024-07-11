<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\SuratJalanDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class SuratJalanController extends Controller
{
    public function index(Request $request)
    {
        $query = SuratJalan::query();

        if ($request->filled('tglKirim')) {
            $query->whereDate('tglKirim', $request->tglKirim);
        }

        if ($request->filled('tujuanTempat')) {
            $query->where('tujuanTempat', 'like', '%' . $request->tujuanTempat . '%');
        }

        $suratJalans = $query->with('details')->get();

        return view('suratJalan.index', compact('suratJalans'));
    }

    public function create()
    {
        return view('suratJalan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomorSurat' => 'required|unique:surat_jalans|max:6|min:6',
            'tglKirim' => 'required|date',
            'tujuanTempat' => 'required',
            'namaBarang.*' => 'required',
            'jumlahBarang.*' => 'required|integer',
            'kode_barang.*' => 'nullable|string',
            'keterangan_barang.*' => 'nullable|string',
            'foto' => 'required|file|image',
        ]);

        $suratJalan = SuratJalan::create($request->only(['nomorSurat', 'tglKirim', 'tujuanTempat', 'foto']));

        if ($request->hasFile('foto')) {
            // Simpan foto ke dalam direktori public/images
            $fotoPath = $request->file('foto')->store('public/images');

            // Ambil nama file dari $fotoPath dan simpan ke dalam field 'foto'
            $suratJalan->foto = basename($fotoPath);
            $suratJalan->save();
        }

        foreach ($request->namaBarang as $index => $namaBarang) {
            SuratJalanDetail::create([
                'surat_jalan_id' => $suratJalan->id,
                'namaBarang' => $namaBarang,
                'jumlahBarang' => $request->jumlahBarang[$index],
                'kode_barang' => $request->kode_barang[$index] ?? null,
                'keterangan_barang' => $request->keterangan_barang[$index] ?? null,
            ]);
        }

        return redirect()->route('suratJalan.index')->with('success', "Data berhasil disimpan");
    }

    public function show(SuratJalan $suratJalan)
    {
        return view('suratJalan.show', compact('suratJalan'));
    }

    public function edit(SuratJalan $suratJalan)
    {
        return view('suratJalan.edit', compact('suratJalan'));
    }

    public function update(Request $request, SuratJalan $suratJalan)
    {
        $request->validate([
            'nomorSurat' => 'required|max:6',
            'tglKirim' => 'required|date',
            'tujuanTempat' => 'required',
            'namaBarang.*' => 'required',
            'jumlahBarang.*' => 'required|integer',
            'kode_barang.*' => 'nullable|string',
            'keterangan_barang.*' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update surat jalan
        $suratJalan->update($request->only(['nomorSurat', 'tglKirim', 'tujuanTempat']));

        if ($request->hasFile('foto')) {
            // Simpan foto ke dalam direktori public/images
            $fotoPath = $request->file('foto')->store('public/images');

            // Ambil nama file dari $fotoPath dan simpan ke dalam field 'foto'
            $suratJalan->foto = basename($fotoPath);
            $suratJalan->save();
        }

        // Hapus detail lama dan tambahkan detail baru
        $suratJalan->details()->delete();
        foreach ($request->namaBarang as $index => $namaBarang) {
            SuratJalanDetail::create([
                'surat_jalan_id' => $suratJalan->id,
                'namaBarang' => $namaBarang,
                'jumlahBarang' => $request->jumlahBarang[$index],
                'kode_barang' => $request->kode_barang[$index] ?? null,
                'keterangan_barang' => $request->keterangan_barang[$index] ?? null,
            ]);
        }

        return redirect()->route('suratJalan.index')->with('success', "Data berhasil diperbarui");
    }

    public function destroy(SuratJalan $suratJalan)
    {
        $suratJalan->delete();
        return redirect()->route('suratJalan.index')->with('success', "Data berhasil dihapus");
    }
}

