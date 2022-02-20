<?php

namespace App;

use App\Helpers\Transform;
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

    public function setValueAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['value'] = null;
        } else {
            $this->attributes['value'] = floatval(Transform::convertStringToDouble($value));
        }
    }
}
