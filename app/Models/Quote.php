<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function contacts()
    {
        return $this->belongsTo(Contact::class, 'contact_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'quote_id', 'id');
    }

}
