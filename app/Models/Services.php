<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $table = 'service';
    protected $fillable = [
        'id',
        'name',
        'description',
        'renew',
        'credit_days',
        'status',
        'created_at',
        'updated_at'
    ];

    public function priceService()
    {
        return $this->hasMany(Prices::class, 'service_id', 'id');
    }

}
