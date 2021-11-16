<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prices extends Model
{
    protected $table = 'price';
    protected $fillable = [
        'service_id',
        'value',
        'start',
        'end',
        'created_at',
        'updated_at'
    ];
}
