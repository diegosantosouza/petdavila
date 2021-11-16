<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discounts extends Model
{
    protected $table = 'discount';
    protected $fillable = [
        'tutor_id',
        'start',
        'end',
        'value',
        'status',
        'created_at',
        'updated_at'
    ];

    public function donoDiscount()
    {
        return $this->belongsTo(Donos::class, 'tutor_id');
    }
}
