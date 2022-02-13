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
        'updated_at',
        'discount',
        'notes'
    ];

    public function servicePurchase()
    {
        return $this->hasOne(Services::class, 'id', 'service_id');
    }

    public function pricePurchase()
    {
        return $this->hasManyThrough(Prices::class, Services::class);
    }
}
