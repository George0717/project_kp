<?php

namespace App\Http\Controllers;

use App\Models\Mutasi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MutasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table_mutasi = Mutasi::all();
        return view('mutasi.index')->with('mutasis', $table_mutasi);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $mutasi = Mutasi::all();
        return view('mutasi.create')->with('mutasis', $mutasi);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
           'divisi_pengirim' => 'required',
           'penanggung_jawab' => 'required',
           'dibuat_oleh' => 'required',
           'lokasi' => 'required',
           'divisi_tujuan' => 'required',
           'nama_barang' => 'required',
           'merk' => 'required',
           'model' => 'required',
           'kategori' => 'required',
           'no_inventaris' => 'required',
           'keterangan' => 'required'
        ]);

        $mutasi = new Mutasi();
        $mutasi->id=Str::uuid();
        $mutasi->divisi_pengirim = $validateData['divisi_pengirim'];
        $mutasi->penanggung_jawab = $validateData['penanggung_jawab'];
        $mutasi->dibuat_oleh = $validateData['dibuat_oleh'];
        $mutasi->lokasi = $validateData['lokasi'];
        $mutasi->divisi_tujuan = $validateData['divisi_tujuan'];
        $mutasi->nama_barang = $validateData['nama_barang'];
        $mutasi->merk = $validateData['merk'];
        $mutasi->model = $validateData['model'];
        $mutasi->kategori = $validateData['kategori'];
        $mutasi->no_inventaris = $validateData['no_inventaris'];
        $mutasi->keterangan = $validateData['keterangan'];
        $mutasi->save();

        return redirect()->route('mutasi.index')->with('success', "Data", $validateData['kategori'], "Berhasil disimpan");

       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mutasi $mutasi)
    {
        return view('mutasi.update')->with('mutasi', $mutasi);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mutasi $mutasi)
    {
        $validateData = $request->validate([
            'tanggal_kirim' => 'required',
            'divisi_pengirim' => 'required',
            'penanggung_jawab' => 'required',
            'dibuat_oleh' => 'required',
            'lokasi' => 'required',
            'divisi_tujuan' => 'required',
            'nama_barang' => 'required',
            'merk' => 'required',
            'model' => 'required',
            'kategori' => 'required',
            'no_inventaris' => 'required',
            'keterangan' => 'required'
         ]);
 
         $mutasi = new Mutasi();
         $mutasi->id=Str::uuid();
         $mutasi->tanggal_kirim = $validateData['tanggal_kirim'];
         $mutasi->divisi_pengirim = $validateData['divisi_pengirim'];
         $mutasi->penanggung_jawab = $validateData['penanggung_jawab'];
         $mutasi->dibuat_oleh = $validateData['dibuat_oleh'];
         $mutasi->lokasi = $validateData['lokasi'];
         $mutasi->divisi_tujuan = $validateData['divisi_tujuan'];
         $mutasi->nama_barang = $validateData['nama_barang'];
         $mutasi->merk = $validateData['merk'];
         $mutasi->model = $validateData['model'];
         $mutasi->kategori = $validateData['kategori'];
         $mutasi->no_inventaris = $validateData['no_inventaris'];
         $mutasi->keterangan = $validateData['keterangan'];
         $mutasi->save();
 
         return redirect()->route('mutasi.index')->with('success', "Data", $validateData['no_inventaris'], "Berhasil di update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mutasi $mutasi)
    {
        $mutasi->delete();
        return redirect()->route('mutasi.index')->with('success', "Data berhasil dihapus");
    }
}
