<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsNotification extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

  

    public function customers()
    {
        return $this->hasMany(Customer::class, 'id',   'user_id',);
    }


    public function notificationTypes() {
        return $this->belongsTo(SmsNotificationsType::class,'topic_type');
    }


 
}
