<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Import fasilitas logging Laravel
use Illuminate\Support\Facades\Auth;

class LogCrudActions
{
    public function handle(Request $request, Closure $next)
    {
        // Lakukan logging bahwa middleware dieksekusi
        Log::info('LogCrudActions middleware executed.');

        // Lanjutkan ke middleware selanjutnya dan tangkap responsenya
        $response = $next($request);

        // Cek apakah request adalah POST, PUT, atau DELETE
        if (in_array($request->method(), ['POST', 'PUT', 'DELETE'])) {
            // Logging bahwa aksi CRUD terdeteksi
            Log::info('CRUD action detected: ' . $request->method());

            // Ambil aksi CRUD yang dilakukan
            $action = $this->getAction($request->method());

            // Ambil model yang terlibat dalam aksi CRUD
            $model = $this->getModelFromRoute($request);

            // Jika model ditemukan
            if ($model) {
                // Logging informasi tentang model yang ditemukan
                Log::info('Model found: ' . get_class($model));

                // Ambil ID model terkait berdasarkan jenis aksi CRUD
                $model_id = $this->getModelId($request, $response, $model);

                // Jika ID model berhasil ditemukan
                if ($model_id) {
                    // Lakukan logging aksi CRUD dengan informasi yang sesuai
                    Log::info('Logging CRUD action for model_id: ' . $model_id, [
                        'user_id' => Auth::id(),
                        'action' => $action,
                        'model' => (new \ReflectionClass($model))->getShortName(),
                        'model_id' => $model_id,
                        'changes' => json_encode($model->getChanges(), JSON_PRETTY_PRINT),
                    ]);
                }
            }
        }

        // Kembalikan responsenya
        return $response;
    }

    // Method untuk mendapatkan aksi CRUD yang dilakukan
    protected function getAction($method)
    {
        switch ($method) {
            case 'POST':
                return 'create';
            case 'PUT':
                return 'update';
            case 'DELETE':
                return 'delete';
            default:
                return 'unknown';
        }
    }

    // Method untuk mendapatkan model yang terlibat dalam aksi CRUD dari route parameters
    protected function getModelFromRoute(Request $request)
    {
        foreach ($request->route()->parameters() as $parameter) {
            if (is_object($parameter)) {
                return $parameter;
            }
        }
        return null;
    }

    // Method untuk mendapatkan ID model berdasarkan jenis aksi CRUD
    protected function getModelId(Request $request, $response, $model)
    {
        if ($request->method() == 'POST') {
            // Jika aksi adalah POST (create), ambil ID model dari konten respons
            return json_decode($response->getContent())->id ?? null;
        } else {
            // Jika aksi adalah PUT (update) atau DELETE, gunakan ID model langsung
            return $model->id ?? null;
        }
    }
}
