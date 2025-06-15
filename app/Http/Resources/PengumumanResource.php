<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PengumumanResource extends ResourceCollection
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
            'judul' => $this->judul ?? '-',
            'foto' => $this->foto ?? '-',
            'isi' => $this->isi ?? '-',
            'created_at' => $this->created_at->format('d F Y H:i'),
        ];
    }
}
