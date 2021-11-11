<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'customer_id', 'order_no', 'name', 'email', 'phone', 'total_price', 'payment_status', 'status', 'admin_id',
        'references', 'deleted_at', 'shipping_cost', 'note', 'coupon_discount', 'coupon_id', 'upload_order_id',
        'discount_amount', 'shipping_date', 'shipping_info', 'is_flat_shipping', 'sub_total', 'payment_method_id', 'payment_check_date',
        'stock_update', 'bid_id', 'offer_update', 'type', 'back_status', 'picked', 'po_id','delivery_status'
    ];

    protected $hidden = [
        //'items',
        //'addresses',
        //'logs',
        //'transactions',
    ];

    protected $appends = [
        'due_amount',
        'paid_amount',
        'delivery_status',
    ];

    public function customer() {
        return $this->belongsTo(Customer::class, 'customer_id')->withTrashed();
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function addresses() {
        return $this->hasMany(OrderAddress::class);
    }

    public function logs() {
        return $this->hasMany(OrderLog::class);
    }

    public function transactions() {
        return $this->hasMany(Transaction::class)->orderBy('id', 'DESC');
    }

    public function billing() {
        return $this->hasMany(OrderAddress::class)->where('address_type', 'billing');
    }

    public function shipping() {
        return $this->hasMany(OrderAddress::class)->where('address_type', 'shipping');
    }

    public function shippingdelivery() {
        return $this->belongsTo(OrderAddress::class)->where('address_type', 'shipping');
    }

    public function orderDiscounts() {
        return $this->hasMany(OrderDiscount::class);
    }

    public function coupon() {
        return $this->belongsTo(Coupon::class, 'coupon_id')->withTrashed();
    }

    public function paymentMethod() {
        return $this->belongsTo(PaymentMethod::class, 'payment_method_id')->withTrashed();
    }

    public function getDueAmountAttribute(){
        $paid = $this->transactions->sum('amount');
        return $this->total_price - $paid;
    }

    public function getPaidAmountAttribute(){
        return $this->transactions->sum('amount');
    }
	 public function getDeliveryStatusAttribute($id){
        return $this->belongsTo(AssignDelivery::class,'id', 'order_id')->value('status');
    }
}
