<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationsType extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;
    
    public function notificationTypeName()
    {
        return $this->hasMany(Notification::class, 'topic_type','id');
    }

    public static function notificationTypeUpdateData($request){
        $notificationType = NotificationsType::find($request->id);

        $notificationType->name = $request->name;
        $notificationType->status = $request->status;
        $notificationType->save();
    }
}
