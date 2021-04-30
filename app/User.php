<?php

namespace App;

use App\Support\Cropper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'crmv',  'email', 'password', 'foto', 'remember_token', 'created_at', 'updated_at'
    ];

    public function getUrlFotoAttribute()
    {
        if (!empty($this->foto)){
            return Storage::url(Cropper::thumb($this->foto, 500, 500));
        }
       return url(asset('backend/assets/images/avatar.jpg'));
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
