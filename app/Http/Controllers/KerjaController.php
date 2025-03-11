<?php

namespace App\Http\Controllers;

use App\Http\Requests\KerjaRequest;
use App\Models\Kerja;
use App\Services\KerjaService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middleware\PermissionMiddleware;

class KerjaController extends Controller implements HasMiddleware
{
    protected $kerjaService;

    public static function middleware(): array
    {
        return [
            'auth', 'verified',
            new Middleware(PermissionMiddleware::using('kerja.index'), only: ['index']),
            new Middleware(PermissionMiddleware::using('kerja.create'), only: ['store']),
            new Middleware(PermissionMiddleware::using('kerja.edit'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('kerja.delete'), only: ['destroy']),
        ];
    }

    public function __construct(KerjaService $kerjaService)
    {
        $this->kerjaService = $kerjaService;
    }

    public function index($alumnus)
    {
        return view('backend.kerja.index', compact('alumnus'));
    }

    public function getDataByAlumni($alumnus)
    {
        $kerja = $this->kerjaService->getKerjaByAlumni($alumnus);

        return response()->json($kerja);
    }

    public function create()
    {
        // Tidak digunakan
    }

    public function store(KerjaRequest $request, $alumnus)
    {
        $result = $this->kerjaService->createKerja($request->all(), $alumnus);
        if ($result['status']) {
            return response()->json(['success' => true, 'message' => 'Data kerja berhasil dibuat']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function edit($alumnus, $kerja)
    {
        $result = $this->kerjaService->editKerja($alumnus, $kerja);
        if ($result['status']) {
            return response()->json($result['kerja']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function update(KerjaRequest $request, $alumnus, $kerja)
    {
        $result = $this->kerjaService->updateKerja($request->all(), $alumnus, $kerja);
        if ($result['status']) {
            return response()->json(['success' => true, 'message' => 'Data kerja berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function destroy($alumnus, $kerja)
    {
        $result = $this->kerjaService->deleteKerja($alumnus, $kerja);
        if ($result['status']) {
            return response()->json(['success' => true, 'message' => 'Data kerja berhasil dihapus']);
        }
        if (strpos($result['message'], 'Data kerja ini memiliki data terkait yang tidak dapat dihapus.') !== false) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }
}
