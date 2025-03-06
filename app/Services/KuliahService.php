<?php

namespace App\Services;

use App\Models\Kuliah;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class KuliahService
{
    public function createKuliah($data)
    {
        DB::beginTransaction();
        try {
            $kuliah = Kuliah::create($data);
            DB::commit();
            return ['status' => true, 'kuliah' => $kuliah];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal membuat data kuliah: ' . $e->getMessage()];
        }
    }

    public function updateKuliah(Kuliah $kuliah, $data)
    {
        DB::beginTransaction();
        try {
            $kuliah->update($data);
            DB::commit();
            return ['status' => true, 'kuliah' => $kuliah];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal memperbarui data kuliah: ' . $e->getMessage()];
        }
    }

    public function deleteKuliah(Kuliah $kuliah)
    {
        DB::beginTransaction();
        try {
            $kuliah->delete();
            DB::commit();
            return ['status' => true];
        } catch (QueryException $e) {
            DB::rollback();

            if ($e->getCode() === '23000') {
                return ['status' => false, 'message' => 'Gagal menghapus data kuliah: Data kuliah ini memiliki data terkait yang tidak dapat dihapus.'];
            }

            return ['status' => false, 'message' => 'Gagal menghapus data kuliah: ' . $e->getMessage()];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal menghapus data kuliah: ' . $e->getMessage()];
        }
    }

    public function editKuliah(Kuliah $kuliah)
    {
        try {
            return ['status' => true, 'kuliah' => $kuliah];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data kuliah: ' . $e->getMessage()];
        }
    }

    public function getKuliahQuery()
    {
        try {
            return DB::table('kuliah')
                ->select(
                    'kuliah.id',
                    'kuliah.alumni_id',
                    'alumni.id',
                    'kuliah.jenjang',
                    'kuliah.jalur_masuk',
                    'kuliah.tahun_masuk',
                    'kuliah.tahun_lulus',
                    'kuliah.created_at',
                    'kuliah.updated_at'
                );
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data kuliah: ' . $e->getMessage()];
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
            return ['status' => false, 'message' => 'Gagal mencari data kuliah: ' . $e->getMessage()];
        }
    }
}
