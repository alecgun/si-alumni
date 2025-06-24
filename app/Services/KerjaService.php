<?php

namespace App\Services;

use App\Models\Kerja;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

class KerjaService
{
    public function getKerjaByAlumni($alumniId)
    {
        try {
            return Kerja::where('alumni_id', $alumniId)->get();
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data kerja: ' . $e->getMessage()];
        }
    }

    public function createKerja($data, $alumniId)
    {
        DB::beginTransaction();
        try {
            $kerja = Kerja::create([
                'id' => Str::uuid(),
                'alumni_id' => $alumniId,
                'posisi_kerja' => $data['posisi_kerja'],
                'tempat_kerja' => $data['tempat_kerja'],
                'alamat_kerja' => $data['alamat_kerja'],
                'tahun_masuk' => $data['tahun_masuk'],
            ]);
            DB::commit();
            return ['status' => true, 'kerja' => $kerja];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal membuat data kerja: ' . $e->getMessage()];
        }
    }

    public function updateKerja($data, $alumniId, $kerjaId)
    {
        DB::beginTransaction();
        try {
            if (!is_array($data)) {
                throw new Exception('Data yang diberikan tidak valid.');
            }

            $kerja = Kerja::where('id', $kerjaId)->first();
            if (!$kerja) {
                return ['status' => false, 'message' => 'Data kerja tidak ditemukan'];
            }
            $kerja->update($data);
            DB::commit();
            return ['status' => true, 'kerja' => $kerja];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal memperbarui data kerja: ' . $e->getMessage()];
        }
    }

    public function deleteKerja($alumniId, $kerjaId)
    {
        DB::beginTransaction();
        try {
            $kerja = Kerja::find($kerjaId);
            $kerja->delete();
            DB::commit();
            return ['status' => true];
        } catch (QueryException $e) {
            DB::rollback();

            if ($e->getCode() === '23000') {
                return ['status' => false, 'message' => 'Gagal menghapus data kerja: Data kerja ini memiliki data terkait yang tidak dapat dihapus.'];
            }

            return ['status' => false, 'message' => 'Gagal menghapus data kerja: ' . $e->getMessage()];
        } catch (Exception $e) {
            DB::rollback();
            return ['status' => false, 'message' => 'Gagal menghapus data kerja: ' . $e->getMessage()];
        }
    }

    public function editKerja($alumniId, $kerjaId)
    {
        try {
            $kerja = Kerja::find($kerjaId);
            return ['status' => true, 'kerja' => $kerja];
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mengambil data kerja untuk diedit: ' . $e->getMessage()];
        }
    }

    public function searchKerjas($query, $search)
    {
        try {
            return $query->where(function ($q) use ($search) {
                $q->where('kerja.tempat_kerja', 'like', "%{$search}%")
                    ->orWhere('kerja.posisi_kerja', 'like', "%{$search}%")
                    ->orWhere('kerja.alamat_kerja', 'like', "%{$search}%")
                    ->orWhere('kerja.tahun_masuk', 'like', "%{$search}%");
            });
        } catch (Exception $e) {
            return ['status' => false, 'message' => 'Gagal mencari data kerja: ' . $e->getMessage()];
        }
    }
}
