<?php

namespace App\Http\Controllers;

use App\Models\suratJalan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SuratJalanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table_suratJalan = suratJalan::all();
        return view('suratJalan.index')->with('surat_jalans', $table_suratJalan);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suratJalan = suratJalan::all();
        return view('suratJalan.create')->with('surat_jalans', $suratJalan);
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
       
        $validateData = $request->validate([
            'nomorSurat' => 'required|unique:surat_jalans|min:6|max:6',
            'tglKirim' => 'required|date',
            'tujuanTempat' => 'required'
        ]);

        $suratJalan = new suratJalan();
        $suratJalan->nomorSurat = $validateData['nomorSurat'];
        $suratJalan->tglKirim = $validateData['tglKirim'];
        $suratJalan->tujuanTempat = $validateData['tujuanTempat'];
        $suratJalan->save();
      

        return redirect()->route('suratJalan.index')->with('success', "Data berhasil disimpan");
    }
    public function storeDetail(Request $request)
    {
        $validateData = $request->validate([
            'namaBarang' => 'required',
            'jumlahBarang' => 'required',
        ]);
        $suratJalan = new suratJalan();
        $suratJalan->namaBarang = $validateData['namaBarang'];
        $suratJalan->jumlahBarang = $validateData['jumlahBarang'];
        $suratJalan->save();
        return redirect()->back()->with('success', "Data berhasil disimpan");
    }

    



    /**
     * Display the specified resource.
     */
    public function show(suratJalan $suratJalan)
    {
        return view('suratJalan.modal')->with('suratJalan', $suratJalan);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(suratJalan $suratJalan)
    {
        return view('suratJalan.update')->with('suratJalan', $suratJalan);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, suratJalan $suratJalan)
    {
        $validateData = $request->validate([
            'nomorSurat' => 'required',
            'tglKirim' => 'required',
            'namaBarang' => 'required',
            'jumlahBarang' => 'required',
            'tujuanTempat' => 'required'
        ]);

        $suratJalan->id = Str::uuid();
        $suratJalan->nomorSurat = $validateData['nomorSurat'];
        $suratJalan->tglKirim = $validateData['tglKirim'];
        $suratJalan->namaBarang = $validateData['namaBarang'];
        $suratJalan->jumlahBarang = $validateData['jumlahBarang'];
        $suratJalan->tujuanTempat = $validateData['tujuanTempat'];
        $suratJalan->save();

        return redirect()->route('suratJalan.index')->with('success', "Data " . $validateData['nomorSurat'] . " berhasil disimpan");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $item = suratJalan::findOrFail($id);
            $item->delete();
            
            return response()->json(['message' => 'Item deleted successfully!']);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred: ' . $e->getMessage()], 500);
        }
    }
    
}
