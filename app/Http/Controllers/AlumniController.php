<?php

namespace App\Http\Controllers;

use App\StoreClass\LogAktivitas;
use App\DataTables\AlumniDataTables;
use App\Http\Requests\AlumniRequest;
use App\Models\Alumni;
use App\Services\AlumniService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middleware\PermissionMiddleware;

class AlumniController extends Controller implements HasMiddleware
{
    protected $alumniService;
    protected $alumniDataTable;

    public static function middleware(): array
    {
        return [
            'auth', 'verified',
            new Middleware(PermissionMiddleware::using('alumni.index'), only: ['index']),
            new Middleware(PermissionMiddleware::using('alumni.create'), only: ['store']),
            new Middleware(PermissionMiddleware::using('alumni.edit'), only: ['edit', 'update']),
            new Middleware(PermissionMiddleware::using('alumni.delete'), only: ['destroy']),
        ];
    }

    public function __construct(AlumniService $alumniService, AlumniDataTables $alumniDataTable)
    {
        $this->alumniService = $alumniService;
        $this->alumniDataTable = $alumniDataTable;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return response()->json($this->alumniDataTable->getData($request));
        }

        return view('backend.alumni.index');
    }

    public function create()
    {
        // Tidak digunakan
    }

    public function store(AlumniRequest $request)
    {
        $result = $this->alumniService->createAlumni($request->all());
        if ($result['status']) {
            LogAktivitas::log('Menambah data alumni', $request->path(), null, $result['alumni'], Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data alumni berhasil dibuat']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }


    public function edit(Alumni $alumnus)
    {
        $result = $this->alumniService->editAlumni($alumnus);
        if ($result['status']) {
            return response()->json($result['alumni']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function update(AlumniRequest $request, Alumni $alumnus)
    {

        if ($request->has('tanggal_lahir')) {
            $request->merge(['tanggal_lahir' => date('Y-m-d', strtotime($request->tanggal_lahir))]);
        }
        $result = $this->alumniService->updateAlumni($alumnus, $request->all());
        if ($result['status']) {
            LogAktivitas::log('Mengubah data alumni', $request->path(), $result['alumni'], $request->all(), Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data alumni berhasil diperbarui']);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function destroy(Alumni $alumnus)
    {
        $result = $this->alumniService->deleteAlumni($alumnus);
        if ($result['status']) {
            LogAktivitas::log('Menghapus data alumni', request()->path(), $result, null, Auth::user()->id);
            return response()->json(['success' => true, 'message' => 'Data alumni berhasil dihapus']);
        }
        if (strpos($result['message'], 'Data alumni ini memiliki data terkait yang tidak dapat dihapus.') !== false) {
            return response()->json(['success' => false, 'message' => $result['message']], 400);
        }
        return response()->json(['success' => false, 'message' => $result['message']], 500);
    }

    public function data()
    {
        $alumni = Alumni::all();
        return response()->json($alumni);
    }
}
