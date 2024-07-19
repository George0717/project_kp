<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    public function index(Request $request)
{
    $query = Log::query();

    // Filter berdasarkan tanggal jika tersedia
    if ($request->filled('start_date') && $request->filled('end_date')) {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        // Tambahkan kondisi whereBetween untuk filter tanggal
        $query->whereBetween('created_at', [$start_date . ' 00:00:00', $end_date . ' 23:59:59']);
    }

    $logs = $query->with('user')->latest()->paginate(10);
    return view('admin.logs.index', compact('logs'));
}

    public function show($id)
    {
        $log = Log::findOrFail($id);
        return view('admin.logs.show', compact('log'));
    }

    public function restore($id)
    {
        $log = Log::findOrFail($id);

        if ($log->action === 'Deleted') {
            $modelClass = "App\\Models\\" . $log->model;
            $model = $modelClass::withTrashed()->find($log->model_id);

            if ($model) {
                $model->restore();

                // Log the restore action
                Log::create([
                    'user_id' => Auth::id(),
                    'action' => 'Restored',
                    'model' => $log->model,
                    'model_id' => $log->model_id,
                    'changes' => null,
                ]);

                return redirect()->route('admin.logs.index')->with('success', 'Data has been restored.');
            }

            // Handle case where model instance is not found
            return redirect()->route('admin.logs.index')->with('error', 'Data could not be found.');
        }

        return redirect()->route('admin.logs.index')->with('error', 'Unable to restore data.');
    }
}
