<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\Traits\LogsActivity;

class OrderAddress extends Model
{
    use SoftDeletes, LogsActivity;

    protected static $logName = 'Order Address';
    protected static $recordEvents = ['created','deleted'];
    protected static $logAttributes = ['*'];
    protected static $logOnlyDirty = true;
    protected static $submitEmptyLogs = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'customer_id', 'district_id', 'area_id', 'name', 'email', 'company', 'mobile', 'mobile_alt',
        'address', 'address_alt', 'post_code', 'address_type', 'deleted_at'
    ];

    public function district() {
        return $this->belongsTo(District::class)->withTrashed();
    }

    public function area() {
        return $this->belongsTo(Area::class)->withTrashed();
    }
}
