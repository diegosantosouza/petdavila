<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Transform;

class Financeiro extends Model
{
    protected $table = 'financeiro_donos';

    protected $fillable = [
        'donos_id',
        'operador',
        'valor',
        'servico'
    ];

    public function setValorAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['valor'] = null;
        } else {
            $this->attributes['valor'] = floatval(Transform::convertStringToDouble($value));
        }
    }

    public function getcreatedAtAttribute($value)
    {
        return date('d-m-Y H:i', strtotime($value));
    }
}
