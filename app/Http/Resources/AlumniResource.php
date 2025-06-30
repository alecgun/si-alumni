<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AlumniResource extends ResourceCollection
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
            'nis' => $this->nis ?? '-',
            'nama' => $this->nama ?? '-',
            'kelas' => $this->kelas ?? '-',
            'tahun_masuk' => $this->tahun_masuk ?? '-',
            'tahun_lulus' => $this->tahun_lulus ?? '-',
            'tanggal_lahir' => $this->tanggal_lahir ?? '-',
            'jenis_kelamin' => $this->jenis_kelamin ?? '-',
            'instagram' => $this->instagram ?? '-',
            'sosmed_lain' => $this->sosmed_lain ?? '-',
            'id_user' => $this->id_user ?? '-',
            'created_at' => $this->created_at ? $this->created_at->locale('id_ID')->isoFormat('d F Y, H:i') : '-',
            'updated_at' => $this->updated_at ? $this->updated_at->locale('id_ID')->isoFormat('d F Y, H:i') : '-',
        ];
    }
}
