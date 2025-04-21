<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Kuliah;
use App\Models\Kerja;
use App\Models\User;

class Alumni extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'alumni';

    // Define the primary key
    protected $primaryKey = 'id';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'id',
        'nis',
        'nama',
        'kelas',
        'tahun_masuk',
        'tahun_lulus',
        'tanggal_lahir',
        'instagram',
        'sosmed_lain',
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
