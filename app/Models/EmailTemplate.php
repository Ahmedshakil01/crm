<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmailTemplate extends Model
{
    use HasFactory;
    use HasFactory, SoftDeletes;
    protected $guarded = [];

    protected $fillable = ['message','temp_type_id','deleted_at'];

    public function emailTemplateType() {
        return $this->belongsTo(EmailTemplateType::class, 'temp_type_id', 'id');
    }

    public static function emailTemplateUpdateData($request){

        $NotificationTemplate               = EmailTemplate::find($request->id);
        $NotificationTemplate->message      = $request->message;
        $NotificationTemplate->temp_type_id = $request->nt_id;
        $NotificationTemplate->save();

    }
}
