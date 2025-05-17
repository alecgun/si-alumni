<?php

namespace App\Http\Controllers;

use App\StoreClass\LogAktivitas;
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

    public function index($alumnus)
    {
        return view('backend.kuliah.index', compact('alumnus'));
    }

    public function getDataByAlumni($alumnus)
    {
        $kuliah = $this->kuliahService->getKuliahByAlumni($alumnus);

        return response()->json($kuliah);
    }

    public function create()
    {
        // Tidak digunakan
    }

    public function store(KuliahRequest $request, $alumnus)
    {
        $result = $this->kuliahService->createKuliah($request->all(), $alumnus);
        if ($result['status']) {
            LogAktivitas::log('Menambah data kuliah', $request->path(), null, $result['kuliah'], Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil dibuat']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function edit($alumnus, $kuliah)
    {
        $result = $this->kuliahService->editKuliah($alumnus, $kuliah);
        if ($result['status']) {
            return response()->json($result['kuliah']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function update(KuliahRequest $request, $alumnus, $kuliah)
    {
        $result = $this->kuliahService->updateKuliah($request->all(), $alumnus, $kuliah);
        if ($result['status']) {
            LogAktivitas::log('Mengubah data kuliah', $request->path(), $result['kuliah'], $request->all(), Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function destroy($alumnus, $kuliah)
    {
        $result = $this->kuliahService->deleteKuliah($alumnus, $kuliah);
        if ($result['status']) {
            LogAktivitas::log('Menghapus data kuliah', request()->path(), $kuliah, null, Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data kuliah berhasil dihapus']);
        }
        if (strpos($result['message'], 'Data kuliah ini memiliki data terkait yang tidak dapat dihapus.') !== false) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }
}
