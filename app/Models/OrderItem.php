<?php
namespace App\Models;

use App\Helpers\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class OrderItem extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'order_id', 'product_id', 'variation_id', 'title', 'photo', 'specifications', 'quantity', 'price', 'discount_price', 'discount', 'deleted_at',
        'supplier_id', 'shipping_group', 'shipping_id', 'shipping_cost', 'shipping_status', 'shipping_details', 'supplier_price', 'source_product_id',
        'purchase_price', 'stocking', 'picked', 'po_item_id','campaign','campaign_id', 'status','delivery_status'
    ];

    protected $appends = [
        'photoUrl','delivery_item_status','request_qty','picked_qty'
    ];

	public function assignPickupDetails()
    {
        return $this->hasMany(AssignPickupDetail::class, 'order_item_id','id');
    }

    public function product() {
        return $this->belongsTo(Product::class, 'product_id')->withTrashed();
    }

    public function order() {
        return $this->belongsTo(Order::class, 'order_id')->withTrashed();
    }

    public function supplier() {
        return $this->belongsTo(Supplier::class, 'supplier_id')->withTrashed();
    }

    public function getPhotoUrlAttribute(){
        if($this->photo){
            return asset(Helper::storagePath($this->photo));
        }else{
            return '';
        }
    }
	public function getDeliveryItemStatusAttribute($id){
        return $this->belongsTo(DeliveryItem::class,'id', 'order_item')->value('delivery_status');
    }

	public function getRequestQtyAttribute(){
        return $this->belongsTo(AssignPickupDetail::class,'id', 'order_item_id')->value('request_qty');
    }

	public function getPickedQtyAttribute(){
        return $this->belongsTo(AssignPickupDetail::class,'id', 'order_item_id')->value('picked_qty');
    }

}
