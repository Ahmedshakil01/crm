<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Customer extends Authenticatable
{
    use Notifiable, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'photo', 'dob','source', 'password', 'gender', 'status', 'remember_token', 'provider', 'provider_id', 'deleted_at', 'newsletter', 'email_verify',
        'social_email', 'balance'
    ];



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
        'dob' => 'date'
    ];


    public function addresses() {
        return $this->hasMany(Address::class)->orderBy('id', 'DESC');
    }

    public function orders() {
        return $this->hasMany(Order::class)->orderBy('id', 'DESC');
    }



}
