<?php

namespace App\Http\Controllers;

use App\StoreClass\LogAktivitas;
use App\DataTables\AlumniDataTables;
use App\Http\Requests\AlumniRequest;
use App\Models\Alumni;
use App\Models\Kerja;
use App\Models\Kuliah;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Middleware\PermissionMiddleware;

class PostAcademicDataController extends Controller implements HasMiddleware
{
    public static function middleware(): array
    {
        return [
            'auth', 'verified',
            new Middleware(PermissionMiddleware::using('pad.index'), only: ['index']),
        ];
    }

    public function index($alumnus)
    {
        $alumni = Alumni::select('alumni.*')
            ->where('alumni.id', $alumnus)
            ->first();

        return view ('backend.pad.index', compact('alumni'));
    }

    public function kuliah($alumnus)
    {
        $kuliah = Kuliah::select('kuliah.*')
            ->where('kuliah.alumni_id', $alumnus)
            ->get();

        if(request()->ajax()) {
            return response()->json($kuliah); // Mengembalikan data kuliah dalam format JSON
        }
    }

    public function kerja($alumnus)
    {
        $kerja = Kerja::select('kerja.*')
            ->where('kerja.alumni_id', $alumnus)
            ->get();

        if(request()->ajax()) {
            return response()->json($kerja); // Mengembalikan data kuliah dalam format JSON
        }
    }
}
