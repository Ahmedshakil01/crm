<?php

namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;

class ProductGroup extends Model
{
    protected $fillable = [
        'title', 'slug', 'status', 'admin_id', 'photo', 'for_member', 'sort'
    ];

    protected $hidden = ['pivot'];

    public function products() {
        return $this->belongsToMany(Product::class, 'product_group_items', 'product_group_id', 'product_id')->withTimestamps();
    }

}
