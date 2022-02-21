<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Database\Eloquent\Model;

class Registros extends Model
{
    protected $table = 'registros';
    protected $fillable = [
        'animal_id',
        'entrada',
        'saida',
        'observacoes',
        'daycare',
        'nightcare',
        'hotel',
        'fds'
    ];


    public function diaria($time, $now)
    {
        $dtime = new Carbon($time);
        $dnow = new Carbon($now);
        $daycare = 0;
        $nightcare = 0;
        $fds = 0;

        /**
         * Se data de entrada igual a data de saída.
         */
        if ($dnow->format('Y-m-d') == $dtime->format('Y-m-d')) {
            if ($dnow->format('l') != 'Sunday') {
                if (($dtime->format('H:i') <= '06:45') && ($dnow->format('H:i') <= '07:15') || ($dtime->format('H:i') >= '20:15') && ($dnow->format('H:i') <= '23:59')) {
                    $nightcare += 1;
                } elseif (($dtime->format('H:i') <= '06:45') && ($dnow->format('H:i') <= '20:45') || ($dtime->format('H:i') >= '06:45') && ($dnow->format('H:i') >= '20:45')) {
                    $nightcare += 1;
                    $daycare += 1;
                } elseif (($dtime->format('H:i') <= '06:45') && ($dnow->format('H:i') >= '20:45')) {
                    $nightcare += 2;
                    $daycare += 1;
                } elseif (($dtime->format('H:i') >= '06:45') && ($dnow->format('H:i') <= '20:45')) {
                    $daycare += 1;
                }
            }
            if ($dtime->format('l') == 'Sunday') {
                if (($dtime->format('H:i') <= '06:45') && ($dnow->format('H:i') <= '07:15')) {
                    $nightcare += 1;
                } elseif (($dtime->format('H:i') <= '06:45') && ($dnow->format('H:i') <= '19:15')) {
                    $daycare += 1;
                    $nightcare += 1;
                } elseif (($dtime->format('H:i') <= '06:45') && ($dnow->format('H:i') >= '19:15')) {
                    $daycare += 1;
                    $nightcare += 1;
                    $fds += 1;
                } elseif (($dtime->format('H:i') >= '06:45') && ($dnow->format('H:i') <= '19:15')) {
                    $daycare += 1;
                } elseif (($dtime->format('H:i') >= '11:45') && ($dnow->format('H:i') <= '23:59')) {
                    $fds += 1;
                } elseif (($dtime->format('H:i') >= '06:45') && ($dnow->format('H:i') >= '19:15')) {
                    $daycare += 1;
                    $fds += 1;
                }
            }
        }
        /**
         * Se data de entrada diferente a data de saída.
         */
        if ($dnow->format('Y-m-d') != $dtime->format('Y-m-d')) {
            for ($dtime; $dnow->format('Y-m-d') >= $dtime->format('Y-m-d'); $dtime->add(1, 'day')) {
                if ($dtime->format('Y-m-d') != $dnow->format('Y-m-d')) {
                    if ($dtime->format('l') == 'Sunday') {
                        if ($dtime->format('H:i') <= '06:45') {
                            $nightcare += 1;
                        } elseif ($dtime->format('H:i') >= '06:45') {
                            $daycare += 1;
                            $fds += 1;
                        } elseif ($dtime->format('H:i') >= '11:45') {
                            $fds += 1;
                        }
                    } elseif ($dtime->format('H:i') <= '06:45') {
                        $nightcare += 1;
                        $daycare += 1;
                    } elseif (($dtime->format('H:i') >= '06:45') && ($dtime->format('H:i') <= '20:45')) {
                        $daycare += 1;
                        $nightcare += 1;
                    } elseif ($dtime->format('H:i') >= '20:45') {
                        $nightcare += 1;
                    }
                }
                if ($dtime->format('Y-m-d') == $dnow->format('Y-m-d')) {
                    if ($dtime->format('l') == 'Monday') {
                        if (($dnow->format('H:i') >= '12:15') && ($dnow->format('H:i') <= '20:45')) {
                            $daycare += 1;
                        } elseif ($dnow->format('H:i') >= '20:45') {
                            $daycare += 1;
                            $nightcare += 1;
                        }
                    } elseif ($dtime->format('l') == 'Sunday') {
                        if (($dnow->format('H:i') >= '06:45') && ($dnow->format('H:i') <= '19:15')) {
                            $daycare += 1;
                            $fds += 1;
                        } elseif ($dnow->format('H:i') >= '11:45') {
                            $fds += 1;
                        }
                    } else {
                        if (($dnow->format('H:i') >= '06:45') && ($dnow->format('H:i') <= '20:45')) {
                            $daycare += 1;
                        } elseif ($dnow->format('H:i') >= '20:45') {
                            $nightcare += 1;
                            $daycare += 1;
                        }
                    }
                }
            }
        }
        $resultado = (object)['daycare' => $daycare, 'nightcare' => $nightcare, 'fds' => $fds];
        return $resultado;
    }

    public function registrosAnimal()
    {
        return $this->hasOne(Animais::class, 'id', 'animal_id');
    }

    public function animalCategoria()
    {
        return $this->hasOneThrough(Categorias::class, Animais::class, 'id', 'id', 'animal_id', 'categoria_id')->withDefault([
            'categoria_id' => '',
        ]);
    }

    public function tutorAnimal()
    {
        return $this->hasOneThrough(Donos::class, Animais::class, 'id', 'id', 'animal_id', 'donos_id');
    }

    public function getEntradaDataAttribute()
    {
        return date('d/m/Y H:i', strtotime($this->entrada));
    }


    public function getSaidaDataAttribute()
    {
        if (empty($this->saida)) {
            return null;
        }

        return date('d/m/Y H:i', strtotime($this->saida));
    }

    private function convertStringToDate(?string $param)
    {
        if(empty($param)){
            return null;
        }

        list($day, $month, $year) = explode('/', $param);
        return (new \DateTime($year . '-' . $month . '-' . $day))->format('Y-m-d H:i:s');
    }

    private function clearField(?string $param)
    {
        if(empty($param)){
            return '';
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }
}
