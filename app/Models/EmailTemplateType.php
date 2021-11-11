<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplateType extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $fillable = ['name','deleted_at'];

    

    public static function emailTemplateTypeUpdateData($request){
        $notificationType = EmailTemplateType::find($request->id);
        $notificationType->name = $request->name;
        $notificationType->save();
    }

    public function emailTemplates() {
        return $this->hasMany(EmailTemplate::class, 'temp_type_id', 'id');
    }

    public function notifications() {
        return $this->hasMany(Notification::class, 'temp_type', 'id');
    }
}
