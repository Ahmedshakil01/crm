<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsNotificationsType extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $guarded = [];

    public function notificationTypeName()
    {
        return $this->hasMany(SmsNotification::class, 'topic_type','id');
    }

    public function notificationTemplates()
    {
        return $this->hasMany(SmsNotificationTemplate::class, 'notifications_type_id', 'id');
    }

    public static function notificationTypeUpdateData($request){
        $notificationType = SmsNotificationsType::find($request->id);
        $notificationType->name = $request->name;
        $notificationType->save();
    }
}
