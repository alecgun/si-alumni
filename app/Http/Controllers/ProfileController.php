<?php

namespace App\Http\Controllers;

use App\StoreClass\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('backend.profile.index', compact('user'));
    }

    public function updateImg(Request $request)
    {
        $request->validate([
            'img_user' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ], [
            'img_user.required' => 'Image is required.',
            'img_user.image' => 'Image must be an image.',
            'img_user.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg.',
            'img_user.max' => 'Image may not be greater than 2048 kilobytes.',
        ]);

        $user = Auth::user();
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

            LogAktivitas::log('Profile picture updated', request()->path(), null, null, Auth::user()->id);

            return response()->json(['success' => true, 'message' => 'Foto profil berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Gagal memperbarui foto profil. Silakan coba lagi.'], 500);
        }
    }

    public function update(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'new_password.required' => 'Kata sandi baru wajib diisi.',
            'new_password.min' => 'Kata sandi baru harus terdiri dari minimal 8 karakter.',
            'new_password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        $user = Auth::user();

        if (! Hash::check($request->current_password, $user->password)) {
            return response()->json(['success' => false, 'message' => 'Kata sandi saat ini tidak cocok.'], 400);
        }

        DB::beginTransaction();
        try {
            $user->password = Hash::make($request->new_password);
            $user->save();
            DB::commit();
            LogAktivitas::log('Password updated', request()->path(), null, null, Auth::user()->id);

            return response()->json(['success' => true, 'message' => 'Kata sandi berhasil diperbarui.']);
        } catch (\Exception $e) {
            DB::rollback();

            return response()->json(['success' => false, 'message' => 'Gagal memperbarui kata sandi. Silakan coba lagi.'], 500);
        }
    }
}
