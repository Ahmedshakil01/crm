<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerWishlist extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = [];
	
	protected $guarded = [];
	public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
