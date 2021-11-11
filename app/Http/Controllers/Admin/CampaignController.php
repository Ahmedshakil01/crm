<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductGroup;
use App\Models\ProductGroupItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use View;
use App\Models\Campaign;
use Validator;
use Image;
use ImageOptimizer;

class CampaignController extends Controller
{
     public function __construct()
     {
        $this->middleware('auth:administration');
     }

	 public function index(Request $request)
     {
	 	$allcampaigns = ProductGroup::orderBy('id','desc')->get();
    	return view('admin.campaign.index',compact('allcampaigns'));
     }



    public function create()
    {

    }

    public function store(Request $request)
    {

    }

    public function show($id)
    {
        $campaign = ProductGroup::find($id);
        $total_order = DB::table('order_items')->where('campaign_id', $id)->distinct('order_id')->pluck('order_id');
        $total_amount = Order::whereIn('id', $total_order)->sum('total_price');
        $total_product = ProductGroupItem::where('product_group_id', $id)->count();

        $campaign_blocks = [
            [
                'title' => 'Total Product :',
                'number' => $total_product
            ],
            [
                'title' => 'Total Order :',
                'number' => Order::whereIn('id', $total_order)->count()
            ],
            [
                'title' => 'Total Order from Website :',
                'number' => Order::whereIn('id', $total_order)->where('type','web')->count()
            ],
            [
                'title' => 'Total Order from App :',
                'number' => Order::whereIn('id', $total_order)->where('type','api')->count()
            ],
            [
                'title' => 'Total Transaction Amount:',
                'number' => 'Tk. '.number_format($total_amount,2)
            ],
            [
                'title' => 'Total Customer :',
                'number' => DB::table('orders')->whereIn('id', $total_order)->distinct('customer_id')->count()
            ],
        ];

        $order_blocks = [
            [
                'title' => 'Total Pending Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','pending')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','pending')->sum('total_price')
            ],
            [
                'title' => 'Total Processing Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','processing')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','processing')->sum('total_price')
            ],
            [
                'title' => 'Total Ready to Ship Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','ready_to_ship')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','ready_to_ship')->sum('total_price')
            ],
            [
                'title' => 'Total Shipped Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','shipped')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','shipped')->sum('total_price')
            ],
            [
                'title' => 'Total Delivered Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','delivered')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','delivered')->sum('total_price')
            ],
            [
                'title' => 'Total Canceled Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','canceled')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','canceled')->sum('total_price')
            ],
            [
                'title' => 'Total Refunded Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','refunded')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','refunded')->sum('total_price')
            ],

            [
                'title' => 'Total Picked Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','Picked')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','Picked')->sum('total_price')
            ],

            [
                'title' => 'Total Partial Delivered Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','partial_delivered')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','partial_delivered')->sum('total_price')
            ],
            [
                'title' => 'Total Returned Order :',
                'number' => Order::whereIn('id', $total_order)->where('status','returned')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('status','returned')->sum('total_price')
            ],

        ];

        $transaction_blocks = [
            [
                'title' => 'Total Partial Order :',
                'number' => Order::whereIn('id', $total_order)->where('payment_status','partial')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('payment_status','partial')->sum('total_price'),
            ],
            [
                'title' => 'Total Paid Order :',
                'number' => Order::whereIn('id', $total_order)->where('payment_status','paid')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('payment_status','paid')->sum('total_price'),
            ],
            [
                'title' => 'Total Unpaid Order :',
                'number' => Order::whereIn('id', $total_order)->where('payment_status','unpaid')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('payment_status','unpaid')->sum('total_price'),
            ],
            [
                'title' => 'Total Refunded Order :',
                'number' => Order::whereIn('id', $total_order)->where('payment_status','refunded')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('payment_status','refunded')->sum('total_price'),
            ],
            [
                'title' => 'Total Partial Refunded Order :',
                'number' => Order::whereIn('id', $total_order)->where('payment_status','partial_refunded')->count(),
                'amount' => Order::whereIn('id', $total_order)->where('payment_status','partial_refunded')->sum('total_price'),
            ],

        ];
        return view('admin.campaign.show',compact('campaign','campaign_blocks','order_blocks','transaction_blocks'));
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }


}
