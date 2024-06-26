<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use App\Models\MutasiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MutasiController extends Controller
{
    public function index()
    {
        $mutasis = Mutasi::with('details')->get();
        return view('mutasi.index', compact('mutasis'));
    }

    public function create()
    {
        return view('mutasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'divisi_pengirim' => 'required',
            'penanggung_jawab' => 'required',
            'dibuat_oleh' => 'required',
            'lokasi' => 'required',
            'divisi_tujuan' => 'required',
            'nama_barang.*' => 'required',
            'merk.*' => 'required',
            'model.*' => 'required',
            'kategori.*' => 'required',
            'no_inventaris.*' => 'required',
            'keterangan.*' => 'required',
        ]);

        $mutasi = Mutasi::create($request->only(['divisi_pengirim', 'penanggung_jawab', 'dibuat_oleh', 'lokasi', 'divisi_tujuan']));

        foreach ($request->nama_barang as $index => $nama_barang) {
            MutasiDetail::create([
                'mutasi_id' => $mutasi->id,
                'nama_barang' => $nama_barang,
                'merk' => $request->merk[$index],
                'model' => $request->model[$index],
                'kategori' => $request->kategori[$index],
                'no_inventaris' => $request->no_inventaris[$index],
                'keterangan' => $request->keterangan[$index],
            ]);
        }

        return redirect()->route('mutasi.index')->with('success', "Data berhasil disimpan");
    }

    public function show(Mutasi $mutasi)
    {
        return view('mutasi.show', compact('mutasi'));
    }

    public function edit(Mutasi $mutasi)
    {
        return view('mutasi.edit', compact('mutasi'));
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        $request->validate([
            'divisi_pengirim' => 'required',
            'penanggung_jawab' => 'required',
            'dibuat_oleh' => 'required',
            'lokasi' => 'required',
            'divisi_tujuan' => 'required',
            'nama_barang.*' => 'required',
            'merk.*' => 'required',
            'model.*' => 'required',
            'kategori.*' => 'required',
            'no_inventaris.*' => 'required',
            'keterangan.*' => 'required',
        ]);

        $mutasi->update($request->only(['divisi_pengirim', 'penanggung_jawab', 'dibuat_oleh', 'lokasi', 'divisi_tujuan']));

        $mutasi->details()->delete();
        foreach ($request->nama_barang as $index => $nama_barang) {
            MutasiDetail::create([
                'mutasi_id' => $mutasi->id,
                'nama_barang' => $nama_barang,
                'merk' => $request->merk[$index],
                'model' => $request->model[$index],
                'kategori' => $request->kategori[$index],
                'no_inventaris' => $request->no_inventaris[$index],
                'keterangan' => $request->keterangan[$index],
            ]);
        }

        return redirect()->route('mutasi.index')->with('success', "Data berhasil diperbarui");
    }

    public function destroy(Mutasi $mutasi)
    {
        $mutasi->delete();
        return redirect()->route('mutasi.index')->with('success', "Data berhasil dihapus");
    }
}
