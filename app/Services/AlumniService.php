<?php

namespace App\Services;

use App\Models\Alumni;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AlumniService
{
    public function createAlumni($data)
    {
        DB::beginTransaction();
        try {
            $alumni = Alumni::create($data);
            DB::commit();

            return ['status' => true, 'alumni' => $alumni];
        } catch (Exception $e) {
            DB::rollback();

            return ['status' => false, 'message' => 'Gagal membuat data alumni: '.$e->getMessage()];
        }
    }

    public function updateAlumni(Alumni $alumni, $data)
    {
        DB::beginTransaction();
        try {
            $alumni->update($data);
            DB::commit();

            return ['status' => true, 'alumni' => $alumni];
        } catch (Exception $e) {
            DB::rollback();

            return ['status' => false, 'message' => 'Gagal memperbarui data alumni: '.$e->getMessage()];
        }
    }

    public function deleteAlumni(Alumni $alumni)
    {
        DB::beginTransaction();
        try {
            $alumni->delete();
            DB::commit();

            return ['status' => true];
        } catch (QueryException $e) {
            DB::rollback();
            if ($e->getCode() === '23000') {
                return ['status' => false, 'message' => 'Gagal menghapus data alumni: Data alumni ini memiliki data terkait yang tidak dapat dihapus.'];
            }

            return ['status' => false, 'message' => 'Gagal menghapus data alumni: '.$e->getMessage()];
        } catch (Exception $e) {
            DB::rollback();

            return ['status' => false, 'message' => 'Gagal menghapus data alumni: '.$e->getMessage()];
        }
    }

    public function editAlumni(Alumni $alumni)
    {
        try {
            return ['status' => true, 'alumni' => $alumni];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data alumni: '.$e->getMessage()];
        }
    }

    public function getAlumniQuery()
    {
        try {
            return Alumni::select('alumni.*');
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data alumni: '.$e->getMessage()];
        }
    }

    public function searchAlumnis($query, $search)
    {
        try {
            return $query->when($search, fn ($q) => $q->whereAny(
                ['nama', 'nis', 'kelas', 'tahun_masuk', 'tahun_lulus'], 'like', "%{$search}%"));
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mencari data alumni: '.$e->getMessage()];
        }
    }
}
