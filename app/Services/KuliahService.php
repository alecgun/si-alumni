<?php

namespace App\Services;

use App\Models\Kuliah;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class KuliahService
{
    public function getKuliahByAlumni($alumniId)
    {
        try {

            $query = Kuliah::query();

            return $query
                ->where('alumni_id', $alumniId)
                ->get();
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data kuliah: '.$e->getMessage()];
        }
    }

    public function createKuliah($data, $alumniId)
    {
        DB::beginTransaction();
        try {
            $kuliah = Kuliah::create([
                'alumni_id' => $alumniId,
                'nama_universitas' => $data['nama_universitas'],
                'jenjang' => $data['jenjang'],
                'fakultas' => $data['fakultas'],
                'program_studi' => $data['program_studi'],
                'jalur_masuk' => $data['jalur_masuk'],
                'status_kuliah' => $data['status_kuliah'],
                'tahun_masuk' => $data['tahun_masuk'],
                'tahun_lulus' => $data['tahun_lulus'],
            ]);
            DB::commit();

            return ['status' => true, 'kuliah' => $kuliah];
        } catch (Exception $e) {
            DB::rollback();

            return ['status' => false, 'message' => 'Gagal membuat data kuliah: '.$e->getMessage()];
        }
    }

    public function showKuliah($alumniId, $id)
    {
        try {
            $kuliah = Kuliah::find($id);
            $kuliah->tahun_lulus = $kuliah->tahun_lulus === null ? '-' : $kuliah->tahun_lulus;

            return ['status' => true, 'kuliah' => $kuliah];
        } catch (Exception $e) {
            return response()->json(['status' => false, 'message' => 'Terjadi kesalahan saat mengambil data kuliah: '.$e->getMessage()], 500);
        }
    }

    public function updateKuliah($data, $alumniId, $kuliahId)
    {
        DB::beginTransaction();
        try {
            if (! is_array($data)) {
                throw new Exception('Data yang diberikan tidak valid.');
            }

            $kuliah = Kuliah::where('id', $kuliahId)->first();
            if (! $kuliah) {
                return ['status' => false, 'message' => 'Data kuliah tidak ditemukan'];
            }
            $kuliah->update($data);
            DB::commit();

            return ['status' => true, 'kuliah' => $kuliah];
        } catch (Exception $e) {
            DB::rollback();

            return ['status' => false, 'message' => 'Gagal memperbarui data kuliah: '.$e->getMessage()];
        }
    }

    public function deleteKuliah($alumniId, $kuliahId)
    {
        DB::beginTransaction();
        try {
            $kuliah = Kuliah::find($kuliahId);
            $kuliah->delete();
            DB::commit();

            return ['status' => true];
        } catch (QueryException $e) {
            DB::rollback();

            if ($e->getCode() === '23000') {
                return ['status' => false, 'message' => 'Gagal menghapus data kuliah: Data kuliah ini memiliki data terkait yang tidak dapat dihapus.'];
            }

            return ['status' => false, 'message' => 'Gagal menghapus data kuliah: '.$e->getMessage()];
        } catch (Exception $e) {
            DB::rollback();

            return ['status' => false, 'message' => 'Gagal menghapus data kuliah: '.$e->getMessage()];
        }
    }

    public function editKuliah($alumniId, $kuliahId)
    {
        try {
            $kuliah = Kuliah::find($kuliahId);

            return ['status' => true, 'kuliah' => $kuliah];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data kuliah untuk diedit: '.$e->getMessage()];
        }
    }

    public function searchKuliahs($query, $search)
    {
        try {
            return $query->where(function ($q) use ($search) {
                $q->where('kuliah.jenjang', 'like', "%{$search}%")
                    ->orWhere('kuliah.jalur_masuk', 'like', "%{$search}%")
                    ->orWhere('kuliah.tahun_masuk', 'like', "%{$search}%")
                    ->orWhere('kuliah.tahun_lulus', 'like', "%{$search}%");
            });
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mencari data kuliah: '.$e->getMessage()];
        }
    }
}
