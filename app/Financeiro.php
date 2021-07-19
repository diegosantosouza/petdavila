<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
            $this->attributes['valor'] = floatval($this->convertStringToDouble($value));
        }
    }

    public function convertStringToDouble($param)
    {
        if (empty($param)) {
            return null;
        }
        return str_replace(',', '.', str_replace('.', '', $param));
    }

    public function getcreatedAtAttribute($value)
    {
        return date('d-m-Y H:i', strtotime($value));
    }

    private function convertStringToDate(?string $param)
    {
        if(empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d H:i:s');
    }
}
