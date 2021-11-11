<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class District extends Model {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'status', 'deleted_at', 'admin_id', 'sort',
    ];

    public function areas() {
        return $this->hasMany(Area::class)->orderBy('sort', 'ASC');
    }

}
