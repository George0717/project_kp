<?php

namespace App\Http\Controllers;
use App\Models\Mutasi;
use App\Models\MutasiDetail;
use Illuminate\Http\Request;

class AdminMutasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Mutasi::with('details');

        if ($request->filled('tgl_buat')) {
            $query->whereDate('tgl_buat', $request->tgl_buat);
        }
    
        if ($request->filled('tujuan_tempat')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->tujuan_tempat . '%');
            });
        }
    
        $mutasis = $query->get();
    
        return view('admin.mutasi.index', compact('mutasis'));
    }

    public function create()
    {
        return view('admin.mutasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'divisi_pengirim' => 'nullable',
            'penanggung_jawab' => 'required',
            'dibuat_oleh' => 'required',
            'tgl_buat' => 'required|date',
            'lokasi' => 'required',
            'divisi_tujuan' => 'required',
            'nama_barang.*' => 'required',
            'merk.*' => 'required',
            'kategori.*' => 'required',
            'no_inventaris.*' => 'required',
            'keterangan.*' => 'nullable',
            'foto_mutasi' => 'nullable|file|image',
        ]);

        $mutasi = Mutasi::create($request->only(['penanggung_jawab', 'dibuat_oleh', 'lokasi', 'divisi_tujuan', 'foto_mutasi', 'tgl_buat']));
        if ($request->hasFile('foto_mutasi')) {
            // Simpan foto ke dalam direktori public/images
            $fotoPath = $request->file('foto_mutasi')->store('public/images');

            // Ambil nama file dari $fotoPath dan simpan ke dalam field 'foto'
            $mutasi->foto_mutasi = basename($fotoPath);
            $mutasi->save();
        }
        foreach ($request->nama_barang as $index => $nama_barang) {
            MutasiDetail::create([
                'mutasi_id' => $mutasi->id,
                'nama_barang' => $nama_barang,
                'merk' => $request->merk[$index],
                'kategori' => $request->kategori[$index],
                'no_inventaris' => $request->no_inventaris[$index],
                'keterangan' => $request->keterangan[$index],
            ]);
        }

        return redirect()->route('admin.mutasi.index')->with('success', "Data berhasil disimpan");
    }

    public function show(Mutasi $mutasi)
    {
        return view('admin.mutasi.show', compact('mutasi'));
    }

    public function edit(Mutasi $mutasi)
    {
        return view('mutasi.edit', compact('mutasi'));
    }

    public function update(Request $request, Mutasi $mutasi)
    {
        $request->validate([
            'penanggung_jawab' => 'required',
            'dibuat_oleh' => 'required',
            'tgl_buat' => 'required|date',
            'lokasi' => 'required',
            'divisi_tujuan' => 'required',
            'nama_barang.*' => 'required',
            'merk.*' => 'required',
            'kategori.*' => 'required',
            'no_inventaris.*' => 'required',
            'keterangan.*' => 'nullable',
            'foto_mutasi' => 'nullable|file|image',
        ]);

        $mutasi = Mutasi::create($request->only(['penanggung_jawab', 'dibuat_oleh', 'tgl_buat', 'lokasi', 'divisi_tujuan']));
        if ($request->hasFile('foto_mutasi')) {
            // Simpan foto ke dalam direktori public/images
            $fotoPath = $request->file('foto_mutasi')->store('public/images');

            // Ambil nama file dari $fotoPath dan simpan ke dalam field 'foto'
            $mutasi->foto_mutasi = basename($fotoPath);
            $mutasi->save();
        }
        $mutasi->details()->delete();
        foreach ($request->nama_barang as $index => $nama_barang) {
            MutasiDetail::create([
                'mutasi_id' => $mutasi->id,
                'nama_barang' => $nama_barang,
                'merk' => $request->merk[$index],
                'kategori' => $request->kategori[$index],
                'no_inventaris' => $request->no_inventaris[$index],
                'keterangan' => $request->keterangan[$index],
            ]);
        }

        return redirect()->route('admin.mutasi.index')->with('success', "Data berhasil diperbarui");
    }

    public function destroy(Mutasi $mutasi)
    {
        $mutasi->delete();
        return redirect()->route('admin.mutasi.index')->with('success', "Data berhasil dihapus");
    }
}
