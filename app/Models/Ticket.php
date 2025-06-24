<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'ticket';

    // Define the primary key
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'id',
        'judul',
        'status_ticket',
        'kategori',
        'deskripsi',
        'email',
        'id_user',
    ];
}
