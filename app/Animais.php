<?php

namespace App;

use App\Support\Cropper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Animais extends Model
{
    protected $table = 'animais';
    protected $fillable = [
        'donos_id',
        'nome',
        'raca',
        'foto',
    ];

    public function getUrlFotoAttribute()
    {
        if (!empty($this->foto)) {
            return Storage::url(Cropper::thumb($this->foto, 380, 220));
        }
        return url(asset('backend/assets/images/dog.png'));
    }

    public function donosAnimal()
    {
        return $this->hasOne(Donos::class, 'id', 'donos_id');
    }

    public function animalRegistros()
    {
        return $this->hasMany(Registros::class, 'animal_id','id');
    }

}
