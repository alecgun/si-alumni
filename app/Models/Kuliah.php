<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuliah extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'kuliah';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'alumni_id',
        'jenjang',
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
