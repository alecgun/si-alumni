<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class KuliahResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'alumni' => $this->alumni_id,
            'nama_universitas' => $this->nama_universitas ?? '-',
            'jenjang' => $this->jenjang ?? '-',
            'fakultas' => $this->fakultas ?? '-',
            'program_studi' => $this->program_studi ?? '-',
            'status_kuliah' => $this->status_kuliah ?? '-',
            'jalur_masuk' => $this->jalur_masuk ?? '-',
            'tahun_masuk' => $this->tahun_masuk ?? '-',
            'tahun_lulus' => $this->tahun_lulus ?? '-',
        ];
    }
}
