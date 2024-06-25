<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\SuratJalanDetail;
use Illuminate\Http\Request;

class SuratJalanController extends Controller
{
    public function index()
    {
        $suratJalans = SuratJalan::with('details')->get();
        return view('suratJalan.index', compact('suratJalans'));
    }

    public function create()
    {
        return view('suratJalan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomorSurat' => 'required|unique:surat_jalans|max:6',
            'tglKirim' => 'required|date',
            'tujuanTempat' => 'required',
            'namaBarang.*' => 'required',
            'jumlahBarang.*' => 'required|integer',
        ]);

        $suratJalan = SuratJalan::create($request->only(['nomorSurat', 'tglKirim', 'tujuanTempat']));

        foreach ($request->namaBarang as $index => $namaBarang) {
            SuratJalanDetail::create([
                'surat_jalan_id' => $suratJalan->id,
                'namaBarang' => $namaBarang,
                'jumlahBarang' => $request->jumlahBarang[$index],
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
        ]);

        $suratJalan->update($request->only(['nomorSurat', 'tglKirim', 'tujuanTempat']));

        $suratJalan->details()->delete();
        foreach ($request->namaBarang as $index => $namaBarang) {
            SuratJalanDetail::create([
                'surat_jalan_id' => $suratJalan->id,
                'namaBarang' => $namaBarang,
                'jumlahBarang' => $request->jumlahBarang[$index],
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
