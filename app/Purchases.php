<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchases extends Model
{
    protected $table = 'purchase';
    protected $fillable = [
        'tutor_id',
        'service_id',
        'date',
        'value',
        'status',
        'created_at',
        'updated_at'
    ];
}
