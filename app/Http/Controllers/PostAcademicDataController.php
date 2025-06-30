<?php

namespace App\Http\Controllers;

use App\StoreClass\LogAktivitas;
use App\DataTables\AlumniDataTables;
use App\Http\Requests\AlumniRequest;
use App\Models\Alumni;
use App\Models\Kerja;
use App\Models\Kuliah;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Exception;
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
        $alumni = Alumni::select('alumni.*', 'users.img_user')
            ->join('users', 'users.id', '=', 'alumni.id_user')
            ->where('alumni.id', $alumnus)
            ->first();

        return view ('backend.pad.index', compact('alumni'));
    }

    public function updateProfilePhoto(Request $request, $alumnus)
    {
        $request->validate([
            'img_user' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'img_user.required' => 'Image is required.',
            'img_user.image' => 'Image must be an image.',
            'img_user.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg.',
            'img_user.max' => 'Image may not be greater than 2048 kilobytes.',
        ]);

        $alumni = Alumni::findOrFail($alumnus);
        $userId = $alumni->id_user;
        $user = User::findOrFail($userId);
        $image = $request->file('img_user');
        $image_name = time().'.'.$image->extension();

        DB::beginTransaction();
        try {
            $image->storeAs('public/profile', $image_name);

            if ($user->img_user && Storage::exists('public/profile/'.$user->img_user)) {
                Storage::delete('public/profile/'.$user->img_user);
            }

            $user->img_user = 'profile/'.$image_name;
            $user->save();

            DB::commit();

            LogAktivitas::log('Foto profil alumni berhasil diperbarui.', request()->path(), null, null, $userId);

            return response()->json(['success' => true, 'message' => 'Foto profil berhasil diperbarui.']);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Gagal memperbarui foto profil. Silakan coba lagi.'], 500);
        }
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
