<?php

namespace App\Services;

use App\Models\Pengumuman;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class PengumumanService
{
    public function createPengumuman($data)
    {
        DB::beginTransaction();
        try {
            if (isset($data['foto']) && $data['foto'] instanceof \Illuminate\Http\UploadedFile) {
                $file = $data['foto'];
                $ext = $file->getClientOriginalExtension();
                $time = time();
                $date = date('ymd-His', $time);
                $filename = $date . '.' . $ext;

                $path = $file->storeAs('pengumuman', $filename, 'public');
                $data['foto'] = $path;
            }
            $data['id'] = Str::uuid();
            $pengumuman = Pengumuman::create($data);
            DB::commit();
            return ['status' => true, 'pengumuman' => $pengumuman];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal membuat data pengumuman: ' . $e->getMessage()];
        }
    }

    public function createPengumumanImage($data)
    {
        try {
            if ($data->hasFile('upload')) {
                $file = $data->file('upload');
                $ext = $file->getClientOriginalExtension();
                $time = time();
                $date = date('ymd-His', $time);
                $filename = $date . '.' . $ext;

                $path = $file->storeAs('pengumuman', $filename, 'public');
                $url = asset('storage/' . $path);

                return ['status' => true, 'url' => $url];
            }
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengunggah gambar: ' . $e->getMessage()];
        }
    }

    public function showPengumuman(Pengumuman $pengumuman)
    {
        try {
            $pengumuman = Pengumuman::select(
                'pengumuman.id',
                'pengumuman.foto',
                'pengumuman.judul',
                'pengumuman.isi',
                'pengumuman.created_at'
            )
            ->where('pengumuman.id', $pengumuman->id)
            ->first();
            return ['status' => true, 'pengumuman' => $pengumuman];
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Terjadi kesalahan saat mengambil data pengumuman: ' . $e->getMessage()], 500);
        }
    }

    public function editPengumuman(Pengumuman $pengumuman)
    {
        try {
            return ['status' => true, 'pengumuman' => $pengumuman];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data pengumuman untuk diedit: ' . $e->getMessage()];
        }
    }

    public function updatePengumuman(Pengumuman $pengumuman, $data)
    {
        DB::beginTransaction();
        try {
            if (isset($data['foto']) && $data['foto'] instanceof \Illuminate\Http\UploadedFile) {
                if ($pengumuman->foto) {
                    Storage::disk('public')->delete($pengumuman->foto);
                }

                $file = $data['foto'];
                $ext = $file->getClientOriginalExtension();
                $time = time();
                $date = date('ymd-His', $time);
                $filename = $date . '.' . $ext;

                $path = $file->storeAs('pengumuman', $filename, 'public');
                $data['foto'] = $path;
            }
            $pengumuman->update($data);
            DB::commit();
            return ['status' => true, 'pengumuman' => $pengumuman];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal memperbarui data pengumuman: ' . $e->getMessage()];
        }
    }

    public function deletePengumuman(Pengumuman $pengumuman)
    {
        DB::beginTransaction();
        try {
            $pengumuman->delete();
            DB::commit();
            return ['status' => true];
        } catch (QueryException $e) {
            DB::rollback();

            if ($e->getCode() === '23000') {
                return ['status' => false, 'message' => 'Gagal menghapus data pengumuman: Data pengumuman ini memiliki data terkait yang tidak dapat dihapus.'];
            }

            return ['status' => false, 'message' => 'Gagal menghapus data pengumuman: ' . $e->getMessage()];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal menghapus data pengumuman: ' . $e->getMessage()];
        }
    }

    public function getPengumumanQuery()
    {
        try {
            return Pengumuman::select(
                'pengumuman.id',
                'pengumuman.foto',
                'pengumuman.judul',
                'pengumuman.isi',
                'pengumuman.created_at'
            )->orderByDesc('pengumuman.created_at');
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data pengumuman: ' . $e->getMessage()];
        }
    }

    public function searchPengumumans($query, $search)
    {
        try {
            return $query->where(function ($q) use ($search) {
                $q->where('pengumuman.judul', 'like', "%{$search}%")
                    ->orWhere('pengumuman.created_at', 'like', "%{$search}%");
            });
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mencari data pengumuman: ' . $e->getMessage()];
        }
    }
}
