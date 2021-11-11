<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use HasFactory, SoftDeletes;
    use HasFactory;

    protected $fillable = ['user_id','user_type','topic_type', 'details','image','status','deleted_at'];

    public function TemplateType()
    {
        return $this->belongsTo(EmailTemplateType::class, 'temp_type', 'id');
    }
    public function notificationTypes() {
        return $this->belongsTo(NotificationsType::class,'topic_type');
    }

    public function customer() {
        return $this->belongsTo(Customer::class, 'user_id', 'id');
    }

    public function sender() {
        return $this->belongsTo(Administration::class,);
    }

    public static function notificationUserUpdateData($request) {
        $notification = Notification::find($request->id);
        $notificationImage = $request->file('image');
        if ($notificationImage){
            unlink($notification->blog_image);
        }
    }
}
