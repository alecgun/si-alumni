<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'alumni';

    // Define the primary key
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'id',
        'nis',
        'nama',
        'kelas',
        'tahun_masuk',
        'tahun_lulus',
        'tanggal_lahir',
        'jenis_kelamin',
        'instagram',
        'sosmed_lain',
        'id_user',
        'created_at',
        'updated_at',
    ];

    // Define the relationship with the Kuliah model
    public function kuliah()
    {
        return $this->hasMany(Kuliah::class);
    }

    // Define the relationship with the Kerja model
    public function kerja()
    {
        return $this->hasMany(Kerja::class);
    }
}
