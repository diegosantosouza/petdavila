<?php

namespace App\Models;

use App\Helpers\Transform;
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

    public function tutor()
    {
        return $this->belongsTo(Donos::class, 'tutor_id');
    }

    public function pricePurchase()
    {
        return $this->hasManyThrough(Prices::class, Services::class, 'id', 'service_id', 'service_id', 'id');
    }

    public function getValueAttribute($value)
    {
        if (empty($value)) {
            return null;
        }

        return number_format($value, 2, ',', '.');
    }

    public function getCreatedAtAttribute($value)
    {
        return Transform::convertToDate($value);
    }

    public function setDiscountAttribute($value)
    {
        $this->attributes['discount'] = (!empty($value) ? floatval(Transform::convertStringToDouble($value)) : null);
    }
}
