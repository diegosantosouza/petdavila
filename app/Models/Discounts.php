<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    protected $table = 'discount';
    protected $fillable = [
        'tutor_id',
        'service_id',
        'start',
        'end',
        'value',
        'status',
        'created_at',
        'updated_at'
    ];

    public function tutor()
    {
        return $this->hasOne(Donos::class, 'id', 'tutor_id');
    }

    public function service()
    {
        return $this->hasOne(Services::class, 'id', 'service_id');
    }
}
