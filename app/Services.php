<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'service';
    protected $fillable = [
        'name',
        'description',
        'renew',
        'credit_days',
        'status',
        'created_at',
        'updated_at'
    ];
}
