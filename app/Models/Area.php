<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Area extends Model {





    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'status', 'deleted_at', 'district_id', 'admin_id', 'sort',
    ];

    public function district() {
        return $this->belongsTo(District::class,'district_id');
    }

}
