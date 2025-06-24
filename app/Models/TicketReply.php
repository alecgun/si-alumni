<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'ticket_reply';

    // Define the primary key
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'id',
        'reply_text',
        'id_ticket',
        'id_user',
    ];
}
