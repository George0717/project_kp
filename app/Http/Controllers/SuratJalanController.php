<?php

namespace App\Http\Controllers;

use App\Models\SuratJalan;
use App\Models\SuratJalanDetail;
use App\Models\History;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'divisi_pengirim' => 'required',
            'namaBarang.*' => 'required',
            'jumlahBarang.*' => 'required|integer',
            'kode_barang.*' => 'nullable|string',
            'keterangan_barang.*' => 'nullable|string',
            'foto' => 'required|file|image',
        ]);

        $suratJalan = SuratJalan::create($request->only(['nomorSurat', 'tglKirim', 'tujuanTempat', 'foto', 'divisi_pengirim']));

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/images');
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

        // Catat tindakan pengguna ke dalam history
        $this->logHistory('Created', 'SuratJalan', $suratJalan->id);

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
            'divisi_pengirim' => 'required',
            'namaBarang.*' => 'required',
            'jumlahBarang.*' => 'required|integer',
            'kode_barang.*' => 'nullable|string',
            'keterangan_barang.*' => 'nullable|string',
            'foto' => 'nullable|file|image',
        ]);

        $suratJalan->update($request->only(['nomorSurat', 'tglKirim', 'tujuanTempat', 'divisi_pengirim', 'foto']));

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('public/images');
            $suratJalan->foto = basename($fotoPath);
            $suratJalan->save();
        }

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

        // Catat tindakan pengguna ke dalam history
        $this->logHistory('Updated', 'SuratJalan', $suratJalan->id);

        return redirect()->route('suratJalan.index')->with('success', "Data berhasil diperbarui");
    }

    public function destroy(SuratJalan $suratJalan)
    {
        $suratJalan->delete();

        // Catat tindakan pengguna ke dalam history
        $this->logHistory('Deleted', 'SuratJalan', $suratJalan->id);

        return redirect()->route('suratJalan.index')->with('success', "Data berhasil dihapus");
    }

    // Fungsi untuk mencatat tindakan pengguna ke dalam history
    protected function logHistory($action, $model, $model_id)
    {
        Log::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model' => $model,
            'model_id' => $model_id,
        ]);
    }
}
