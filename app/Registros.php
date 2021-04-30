<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    protected $table = 'registros';
    protected $fillable = [
        'animal_id',
        'entrada',
        'saida'
    ];

    public function registrosAnimal()
    {
        return $this->hasOne(Animais::class, 'id', 'animal_id');
    }

    public function tutorAnimal()
    {
        return $this->hasOneThrough(Donos::class, Animais::class, 'id', 'id', 'animal_id','donos_id');
    }

    public function getEntradaDataAttribute()
    {
        return date('d/m/Y H:i', strtotime($this->entrada));
    }

    public function getSaidaDataAttribute()
    {
        if (empty($this->saida)){
            return null;
        }

        return date('d/m/Y H:i', strtotime($this->saida));
    }
}
