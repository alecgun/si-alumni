<?php

namespace App\Http\Controllers;

use App\DataTables\KuliahDataTables;
use App\Http\Requests\KuliahRequest;
use App\Models\Kuliah;
use App\Services\KuliahService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middleware\PermissionMiddleware;

class KuliahController extends Controller implements HasMiddleware
{
    protected $kuliahService;
    protected $kuliahDataTable;

    public static function middleware(): array
    {
        return [
            'auth', 'verified',
            new Middleware(PermissionMiddleware::using('kuliah.index'), only: ['index']),
            new Middleware(PermissionMiddleware::using('kuliah.create'), only: ['store']),
            new Middleware(PermissionMiddleware::using('kuliah.edit'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('kuliah.delete'), only: ['destroy']),
        ];
    }

    public function __construct(KuliahService $kuliahService, KuliahDataTables $kuliahDataTable)
    {
        $this->kuliahService = $kuliahService;
        $this->kuliahDataTable = $kuliahDataTable;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->kuliahDataTable->getData($request));
        }

        return view('backend.kuliah.index');
    }

    public function create()
    {
        // Tidak digunakan
    }

    public function store(KuliahRequest $request)
    {
        $result = $this->kuliahService->createKuliah($request->all());
        if ($result['status']) {
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil dibuat']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function edit(Kuliah $kuliah)
    {
        $result = $this->kuliahService->editKuliah($kuliah);
        if ($result['status']) {
            return response()->json($result['kuliah']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function update(KuliahRequest $request, Kuliah $kuliah)
    {
        $result = $this->kuliahService->updateKuliah($kuliah, $request->all());
        if ($result['status']) {
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function destroy(Kuliah $kuliah)
    {
        $result = $this->kuliahService->deleteKuliah($kuliah);
        if ($result['status']) {
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil dihapus']);
        }
        if (strpos($result['message'], 'Data kuliah ini memiliki data terkait yang tidak dapat dihapus.') !== false) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }
}
