<?php

namespace App\Http\Controllers;

use App\StoreClass\LogAktivitas;
use App\DataTables\PengumumanDataTables;
use App\Http\Requests\PengumumanRequest;
use App\Models\Pengumuman;
use App\Services\PengumumanService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middleware\PermissionMiddleware;

class PengumumanController extends Controller implements HasMiddleware
{
    protected $pengumumanService;
    protected $pengumumanDataTable;

    public static function middleware(): array
    {
        return [
            'auth', 'verified',
            new Middleware(PermissionMiddleware::using('pengumuman'), only: ['index']),
            new Middleware(PermissionMiddleware::using('pengumuman.create'), only: ['store']),
            new Middleware(PermissionMiddleware::using('pengumuman.edit'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('pengumuman.delete'), only: ['destroy']),
        ];
    }

    public function __construct(PengumumanService $pengumumanService, PengumumanDataTables $pengumumanDataTable)
    {
        $this->pengumumanService = $pengumumanService;
        $this->pengumumanDataTable = $pengumumanDataTable;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->pengumumanDataTable->getData($request));
        }

        return view('backend.pengumuman.index');
    }

    public function create()
    {
        // Tidak digunakan
    }

    public function store(PengumumanRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto');
        }

        $result = $this->pengumumanService->createPengumuman($data);
        if ($result['status']) {
            LogAktivitas::log('Menambah data pengumuman', $request->path(), null, $result['pengumuman'], Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data pengumuman berhasil dibuat']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function storeImage(Request $request)
    {
        $result = $this->pengumumanService->createPengumumanImage($request);
        if ($result['status']) {
            return response()->json(['success' => true, 'url' => $result['url']]);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function show(Pengumuman $pengumuman)
    {
        $result = $this->pengumumanService->showPengumuman($pengumuman);
        if ($result['status']) {
            return response()->json($result['pengumuman']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function edit(Pengumuman $pengumuman)
    {
        $result = $this->pengumumanService->editPengumuman($pengumuman);
        if ($result['status']) {
            return response()->json($result['pengumuman']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function update(PengumumanRequest $request, Pengumuman $pengumuman)
    {
        $result = $this->pengumumanService->updatePengumuman($pengumuman, $request->all());
        if ($result['status']) {
            LogAktivitas::log('Mengubah data pengumuman', $request->path(), $result['pengumuman'], $request->all(), Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data pengumuman berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $result = $this->pengumumanService->deletePengumuman($pengumuman);
        if ($result['status']) {
            LogAktivitas::log('Menghapus data pengumuman', request()->path(), $result, null, Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data pengumuman berhasil dihapus']);
        }
        if (strpos($result['message'], 'Data pengumuman ini memiliki data terkait yang tidak dapat dihapus.') !== false) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function data()
    {
        $pengumuman = Pengumuman::all();
        return response()->json($pengumuman);
    }
}
