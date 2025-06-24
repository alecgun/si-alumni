<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuliah extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'kuliah';

    // Define the primary key
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'id',
        'alumni_id',
        'nama_universitas',
        'fakultas',
        'program_studi',
        'jenjang',
        'status_kuliah',
        'jalur_masuk',
        'tahun_masuk',
        'tahun_lulus',
    ];

    // Define the relationship with the Alumni model
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
