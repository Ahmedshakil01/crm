<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model {
    use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'district_id', 'area_id', 'name', 'email', 'company', 'mobile', 'mobile_alt', 'address',
        'address_alt', 'post_code', 'address_type', 'default', 'deleted_at'
    ];

    public function district() {
        return $this->belongsTo(District::class);
    }

    public function area() {
        return $this->belongsTo(Area::class);
    }

}
