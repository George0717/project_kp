<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Mutasi;
use App\Models\MutasiDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMutasiController extends Controller
{
    public function index(Request $request)
    {
        $query = Mutasi::query();

        if ($request->filled('tgl_buat')) {
            $query->whereDate('tgl_buat', $request->tgl_buat);
        }

        if ($request->filled('tujuan_tempat')) {
            $query->whereHas('details', function ($q) use ($request) {
                $q->where('nama_barang', 'like', '%' . $request->tujuan_tempat . '%');
            });
        }

        $mutasis = $query->with('details')->get();

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
            $fotoPath = $request->file('foto_mutasi')->store('public/images');
            $mutasi->foto_mutasi = basename($fotoPath);
            $mutasi->save();
        }

        if ($request->has('nama_barang')) {
            foreach ($request->nama_barang as $index => $nama_barang) {
                MutasiDetail::create([
                    'mutasi_id' => $mutasi->id,
                    'nama_barang' => $nama_barang,
                    'merk' => $request->merk[$index] ?? '',
                    'kategori' => $request->kategori[$index] ?? '',
                    'no_inventaris' => $request->no_inventaris[$index] ?? '',
                    'keterangan' => $request->keterangan[$index] ?? '',
                ]);
            }
        }

        $this->logHistory('Created', 'Mutasi', $mutasi->id, null, $request->all());
        return redirect()->route('admin.mutasi.index')->with('success', "Data berhasil disimpan");
    }


    public function show(Mutasi $mutasi)
    {
        $mutasi->load('details');
        return view('admin.mutasi.show', compact('mutasi'));
    }

    public function edit(Mutasi $mutasi)
    {
        return view('admin.mutasi.edit', compact('mutasi'));
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

        $mutasi->update($request->only(['penanggung_jawab', 'dibuat_oleh', 'tgl_buat', 'lokasi', 'divisi_tujuan']));
        if ($request->hasFile('foto_mutasi')) {
            $fotoPath = $request->file('foto_mutasi')->store('public/images');
            $mutasi->foto_mutasi = basename($fotoPath);
            $mutasi->save();
        }
        $oldData = $mutasi->toArray();
        $mutasi->details()->delete();

        if ($request->has('nama_barang')) {
            foreach ($request->nama_barang as $index => $nama_barang) {
                MutasiDetail::create([
                    'mutasi_id' => $mutasi->id,
                    'nama_barang' => $nama_barang,
                    'merk' => $request->merk[$index] ?? '',
                    'kategori' => $request->kategori[$index] ?? '',
                    'no_inventaris' => $request->no_inventaris[$index] ?? '',
                    'keterangan' => $request->keterangan[$index] ?? '',
                ]);
            }
        }

        $this->logHistory('Updated', 'Mutasi', $mutasi->id, $oldData, $request->all());
        return redirect()->route('admin.mutasi.index')->with('success', "Data berhasil diperbarui");
    }

    public function destroy(Mutasi $mutasi)
    {
        $mutasi->delete();
        $oldData = $mutasi->toArray();
        $this->logHistory('Deleted', 'Mutasi', $mutasi->id, $oldData);
        return redirect()->route('admin.mutasi.index')->with('success', "Data berhasil dihapus");
    }

    protected function logHistory($action, $model, $model_id, $oldData = null, $newData = null)
    {
        if ($model === 'Mutasi') {
            // Temukan objek Mutasi berdasarkan model_id
            $mutasi = Mutasi::find($model_id);

            // Pastikan Mutasi ditemukan sebelum mencoba mengakses details
            if ($mutasi) {
                $details = $mutasi->details->map(function ($detail) {
                    return [
                        'nama_barang' => $detail->nama_barang,
                        'merk' => $detail->merk,
                        'kategori' => $detail->kategori,
                        'no_inventaris' => $detail->no_inventaris,
                        'keterangan' => $detail->keterangan,
                    ];
                })->toArray(); // Convert to array

                $formattedOldData = $this->formatMutasiData($oldData);
                $formattedNewData = $this->formatMutasiData($newData);
            } else {
                // Jika Mutasi tidak ditemukan, atur $details menjadi array kosong
                $details = [];
                $formattedOldData = $this->formatMutasiData($oldData);
                $formattedNewData = $this->formatMutasiData($newData);
            }
        } else {
            $details = [];
            $formattedOldData = $oldData;
            $formattedNewData = $newData;
        }

        Log::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model' => $model,
            'model_id' => $model_id,
            'changes' => json_encode([
                'old' => $formattedOldData,
                'new' => $formattedNewData,
                'details' => $details,
            ]),
        ]);
    }


    protected function formatMutasiData($data)
    {
        if (!$data) {
            return null;
        }

        return [
            'penanggung_jawab' => $data['penanggung_jawab'] ?? null,
            'dibuat_oleh' => $data['dibuat_oleh'] ?? null,
            'tgl_buat' => $data['tgl_buat'] ?? null,
            'lokasi' => $data['lokasi'] ?? null,
            'divisi_tujuan' => $data['divisi_tujuan'] ?? null,
            'details' => $data['details'] ?? [],
        ];
    }

    
}
