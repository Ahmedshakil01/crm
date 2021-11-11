<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SmsNotificationTemplate extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    public function notificationsTypes()
    {
        return $this->belongsTo(SmsNotificationsType::class, 'notifications_type_id', 'id');
    }

    public static function notificationTemplateUpdateData($request){
        $NotificationTemplate = SmsNotificationTemplate::find($request->id);
        $NotificationTemplate->message = $request->message;
        $NotificationTemplate->notifications_type_id = $request->nt_id;
        $NotificationTemplate->save();
    }
}
