<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recurrences extends Model
{
    protected $table = 'recurrence';
    protected $fillable = [
        'tutor_id',
        'service_id',
        'start',
        'end',
        'status',
        'method',
        'created_at',
        'updated_at'
    ];
}
