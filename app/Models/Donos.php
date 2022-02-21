<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donos extends Model
{
    use HasFactory;

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

    public function financeiroDono()
    {
        return $this->hasMany(Financeiro::class, 'donos_id', 'id');
    }

    public function purchaseDono()
    {
        return $this->hasMany(Purchases::class, 'tutor_id', 'id');
    }

    public function recurrenceDono()
    {
        return $this->hasMany(Recurrences::class, 'tutor_id', 'id');
    }

    public function discountDono()
    {
        return $this->hasMany(Discounts::class, 'tutor_id', 'id');
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