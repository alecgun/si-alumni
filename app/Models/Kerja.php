<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerja extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'kerja';

    // Define the primary key
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'id',
        'alumni_id',
        'posisi_kerja',
        'tempat_kerja',
        'alamat_kerja',
        'tahun_masuk',
    ];

    // Define the relationship with the Alumni model
    public function alumni()
    {
        return $this->belongsTo(Alumni::class);
    }
}
