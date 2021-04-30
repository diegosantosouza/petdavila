<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Donos extends Model
{
    protected $table = 'donos';
    protected $fillable = [
        'nome',
        'telefone',
        'cpf'
    ];

    public function animaisDono()
    {
        return $this->hasMany(Animais::class, 'donos_id', 'id');
    }

    public function registrosTutor()
    {
        return $this->hasManyThrough(Registros::class, Animais::class, 'donos_id', 'animal_id', 'id','id');
    }

    public function setCpfAttribute($value)
    {
        $this->attributes['cpf'] = $this->clearField($value);
    }

    public function setTelefoneAttribute($value)
    {
        $this->attributes['telefone'] = $this->clearField($value);
    }

    public function getTelefoneAttribute($value)
    {
        return substr($value, 0, 3) . '.' . substr($value, 3, 3) . '.' . substr($value, 6, 3) . '-' . substr($value, 9, 2);
    }

    private function clearField(?string $param)
    {
        if (empty($param)) {
            return '';
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }


}
