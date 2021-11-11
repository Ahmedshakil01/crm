<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UsersType extends Model
{
    use HasFactory;

    public function notification()
    {
        return $this->hasOne(Notification::class, 'user_type', 'id');
    }

    public static function notificationUserTypeUpdateData($request) {
        $userType = UsersType::find($request->id);
        $userType->name     = $request->name;
        $userType->status   = $request->status;
        $userType->save();

    }
}
