<?php

namespace App\Models;

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

    public function service()
    {
        return $this->hasOne(Services::class, 'id', 'service_id');
    }

    public function tutor()
    {
        return $this->hasOne(Donos::class, 'id', 'tutor_id');
    }
}
