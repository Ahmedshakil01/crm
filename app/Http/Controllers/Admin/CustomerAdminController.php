<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Area;
use App\Models\Customer;
use App\Models\District;
use App\Models\Division;
use App\Models\Order;
use App\Models\SourceType;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use View;
use Hash;

use Validator;
use Image;
use Mail;


class CustomerAdminController extends Controller
{
      public function __construct()
      {
            $this->middleware(function($request, $next) {
                  $this->user = Auth::guard('administration')->user();
                  return $next($request);
            });
      }
    public function index(Request $request) {

        if(is_null($this->user) || !$this->user->can('customer.view')) {
            return view('admin.error.denied');
        } else {
       /*     $customers = Customer::where('id', '>', 0);
            if ($request->get('name')) {

                $customers = $customers->where('id', $request->get('name'))->orWhere('name', "LIKE", "%" . $request->get('name') . "%")->orWhere('phone', "LIKE", "%" . $request->get('name') . "%");

                if (($request->has('from_date') && $request->get('from_date') != '') && ($request->has('to_date') && $request->get('to_date') != '')) {
                    $is_filter = 1;
                    $customers = $customers->where(function ($query) use($request) {
                        $end_date = Carbon::parse($request->get('to_date'))->addDay()->format("Y-m-d");
                        $query->where(function ($query) use($request, $end_date) {
                            $query->where('created_at', '>=', $request->get('from_date'))
                                ->where('created_at', '<', $end_date);
                        })->orWhere(function ($query) use($request, $end_date) {
                            $query->where('created_at', '>=', $request->get('from_date'))
                                ->where('created_at', '<', $end_date);
                        })->orWhere(function ($query) use($request, $end_date) {
                            $query->where('created_at', '<', $request->get('from_date'))
                                ->where('created_at', '>', $end_date);
                        });
                    });
                } elseif ($request->has('from_date') && $request->get('from_date') != '') {
                    $is_filter = 1;
                    $customers = $customers->where(function ($query) use($request) {
                        $query->where(function ($query) use($request) {
                            $query->where('created_at', '<=', $request->get('from_date'))
                                ->where('created_at', '>=', $request->get('from_date'));
                        })->orWhere(function ($query) use($request) {
                            $query->where('created_at', '>=', $request->get('from_date'));
                        });
                    });
                } elseif ($request->has('to_date') && $request->get('to_date') != '') {
                    $is_filter = 1;
                    $customers = $customers->where(function ($query) use($request) {
                        $query->orWhere(function ($query) use($request) {
                            $query->where('created_at', '<=', $request->get('to_date'))
                                ->where('created_at', '>=', $request->get('to_date'));
                        })->orWhere(function ($query) use($request) {
                            $query->where('created_at', '<=', $request->get('to_date'));
                        });
                    });
                }

            }*/
            $customers = Customer::orderBy('created_at','DESC');
            //$customers = Customer::orderBy('name','DESC');
            $allcustomer = $customers->paginate(100);

            return view('admin.customer.index',compact('allcustomer'));
        }
    }
    public function ajaxfilter(Request $req)
    {

        if(is_null($this->user) || !$this->user->can('customer.view')) {
            return view('admin.error.denied');
        } else {
            $query = Customer::query();
            list($operator, $optType) = explode('_',$req->keys);

            if($optType=='days'){
                if($operator!='all'){
                    $date = Carbon::today()->subDays($operator);

                    $query->where('created_at', '>=', date($date));
                    $query->orderBy('created_at','desc');
                }
            }

            $allcustomer = $query->orderBy('id','ASC')->get();
            $htmlview = view('admin.customer.customerajax')->with(compact('allcustomer'))->render();
            return response()->json(['operators' => $operator, 'totalOCounts' => $allcustomer->count(), 'viewpages' => $htmlview]);
            //return view('admin.customer.index',compact('allcustomer'));
        }
    }
/*	public function index(Request $request)
  {
  	//dd($request);
    if(is_null($this->user) || !$this->user->can('customer.view')) {
      return view('admin.error.denied');
    } else {

		 $allcustomer = Customer::where('id', '>', 0);

		  if ($request->get('keywords')) {
			  $allcustomer = $allcustomer->where('fullname', "LIKE", "%" . $request->get('keywords') . "%")->orWhere('contact', "LIKE", "%" . $request->get('keywords') . "%")->orWhere('email', "LIKE", "%" . $request->get('keywords') . "%");
		  }

		  if (($request->has('from_date') && $request->get('from_date') != '') && ($request->has('to_date') && $request->get('to_date') != '')) {
			  $allcustomer = $allcustomer->where(function ($query) use($request) {
				  $end_date = Carbon::parse($request->get('to_date'))->addDay()->format("Y-m-d");
				  $query->where(function ($query) use($request, $end_date) {
					  $query->where('created_at', '>=', $request->get('from_date'))
						  ->where('created_at', '<', $end_date);
				  })->orWhere(function ($query) use($request, $end_date) {
					  $query->where('created_at', '>=', $request->get('from_date'))
						  ->where('created_at', '<', $end_date);
				  })->orWhere(function ($query) use($request, $end_date) {
					  $query->where('created_at', '<', $request->get('from_date'))
						  ->where('created_at', '>', $end_date);
				  });
			  });
		  } elseif ($request->has('from_date') && $request->get('from_date') != '') {
			  $allcustomer = $allcustomer->where(function ($query) use($request) {
				  $query->where(function ($query) use($request) {
					  $query->where('created_at', '<=', $request->get('from_date'))
						  ->where('created_at', '>=', $request->get('from_date'));
				  })->orWhere(function ($query) use($request) {
					  $query->where('created_at', '>=', $request->get('from_date'));
				  });
			  });
		  } elseif ($request->has('to_date') && $request->get('to_date') != '') {
			  $allcustomer = $allcustomer->where(function ($query) use($request) {
				  $query->orWhere(function ($query) use($request) {
					  $query->where('created_at', '<=', $request->get('to_date'))
						  ->where('created_at', '>=', $request->get('to_date'));
				  })->orWhere(function ($query) use($request) {
					  $query->where('created_at', '<=', $request->get('to_date'));
				  });
			  });
		  }

		  $allcustomer = $allcustomer->orderBy('id','DESC')->get();
		  return view('admin.customer.index',compact('allcustomer'));
	}
  }*/
	// public function guestIndex(Request $request)
  // {
	//  	$allcustomer = Guest::orderBy('id','DESC')->get();
  //   	return view('admin.customer.guest',compact('allcustomer'));
  // }

    public function customer_order_report(Request $req){
        if(is_null($this->user) || !$this->user->can('customer.view')) {
            return view('admin.error.denied');
        } else {
            /*$allcustomer = DB::table('orders AS o')
                ->leftJoin('customers AS c','c.id','=','o.customer_id')
                ->select(DB::raw("count('o.id') AS total_order_id"), 'o.customer_id AS id','c.name AS name','c.email AS email','c.phone as phone')
                ->orderBy('total_order_id','DESC')->get();*/


            $allcustomer = DB::table('customers AS c')
                ->leftJoin('orders AS o','c.id','=','o.customer_id')
                ->select(DB::raw("count('o.id') AS total_order_id"), 'c.id AS customer_id','c.name AS name','c.email AS email','c.phone as phone')
                ->orderBy('total_order_id','DESC')->groupBy('o.customer_id')->paginate(100);


            return view('admin.customer.customer_order',compact('allcustomer'));
        }

    }
    public function order_ajax(Request $req){
        if(is_null($this->user) || !$this->user->can('customer.view')) {
            return view('admin.error.denied');
        } else {
             $query = Order::query();
             list($operator, $optType) = explode('_',$req->keys);

             if($optType=='days'){
                 if($operator!='all'){
                     //$query->orderBy('created_at','desc');

                     $query = DB::table('customers AS c')
                         ->leftJoin('orders AS o','c.id','=','o.customer_id')
                         ->select(DB::raw("count('o.id') AS total_order_id"), 'c.id AS customer_id','c.name AS name','c.email AS email','c.phone as phone')

                         ->groupBy('o.customer_id');


                     $date = Carbon::today()->subDays($operator);
                     $query->where('o.created_at', '>=', date($date));
                 }
             }

            $allcustomer = $query->orderBy('total_order_id','DESC')->get();
            $htmlview = view('admin.customer.customer_order_ajax')->with(compact('allcustomer'))->render();
            return response()->json(['operators' => $operator, 'totalOCounts' => $allcustomer->count(), 'viewpages' => $htmlview]);
            //return view('admin.customer.customer_order',compact('allcustomer'));
        }
    }

  public function create()
  {
    if(is_null($this->user) || !$this->user->can('customer.create')) {
      return view('admin.error.denied');
    } else {

        $customersources = SourceType::orderBy('id','DESC')->get();
      return view('admin.customer.create',compact('customersources'));
    }
  }

  public function store(Request $request)
  {
    if(is_null($this->user) || !$this->user->can('customer.create')) {
      return view('admin.error.denied');
    } else {
        $this->validate($request , [
        'name' => 'required|string|max:255',
        'dob' => 'required|string|max:255',
        'source' => 'required|string|max:255',
        'phone' => 'bd_mobile|unique:customers',
        'email' => 'email|max:255|unique:customers',
        'password' => 'required|string|min:6|confirmed',

      ]);

      $m = new Customer;
      $m->name = $request->name;
      $m->phone = $request->phone;
      $m->dob = $request->dob;
      $m->source = $request->source;
      $m->email = $request->email;
      $m->gender = $request->gender;
      $m->status = $request->status;
      $m->password = Hash::make($request->password);
      $m->save();
      return redirect('administration/customer')->with('success', 'Created Successfully !');
    }
  }

	public function createThumbnail($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

      $img = Image::make($file);
      $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
      });

      $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		  $img->save($path);
	}

	public function show($id)
  {
    //
  }

  public function customer_edit($id)
  {
    $customer = Customer::find($id);
    if($customer!=""){
      if(is_null($this->user) || !$this->user->can('customer.edit')) {
        return view('admin.error.denied');
      } else {
        return view('admin.customer.edit',compact('customer'));
      }
    }
    else{
      abort(404);
    }
  }

/*  public function customer_update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
  		'fullname' => 'required|string|max:255',
  		'username' => 'required|string|max:255',
  		'contact' => 'required|string|max:255|unique:customers',
  		'email' => 'required|email|max:255',
      'password' => 'nullable|string|min:6|confirmed',
  	]);


    $customer = Customer::find($id);
    if($customer!=""){
      if(is_null($this->user) || !$this->user->can('customer.edit')) {
        return view('admin.error.denied');
      } else {
        $arrayVal = array(
          'fullname' => $request->fullname,
          'username' => $request->username,
          'contact' => $request->contact,
          'email' => $request->email,
          'address' => $request->address,
          'division' => $request->division,
          'district' => $request->district,
          'area' => $request->area,
          'zipcode' => $request->zipcode,
          'updated_at' => date('Y-m-d H:i:s'),
        );

        $customer->update($arrayVal);

        if ($request->password != "") {
          $arrayVal = array(
            'password' => Hash::make($request->password),
            'password_hints' => $request->password,
          );
          $customer->update($arrayVal);
        }
          return redirect('administration/customer')->with('success', 'Successfully Update!');
      }
    }
    else{
      abort(404);
    }
  }*/

  public function destroy($id)
  {
    $customer = Customer::find($id);
    if($customer!=""){
      if(is_null($this->user) || !$this->user->can('customer.delete')) {
        return view('admin.error.denied');
      } else {
        $customer->delete();
        return redirect('administration/customer');
      }
    }
    else{
      abort(404);
    }
  }

	public function searchajax(Request $req)
  {
		if($req->keywords!="")
		{
			$keywords=$req->keywords;
			$table=$req->table;
			$colid=$req->colid;
			$searchresults = DB::table($table)->where($colid, $keywords)->get();
			$displayvar = '';
			$p1 = "'lastcatid'";
			$p2 = "'subcat_id'";
			$p3 = "'lastcategories'";

			if($table =="subcategories"){
    			$displayvar .= '<select name="subcat_id" class="form-control" onchange="ajaxSearch(this.value,'.$p1.','.$p2.','.$p3.')">';
			}
			else{
			   	$displayvar .= '<select name="lastcat_id" class="form-control">';
			}
				$displayvar .= '<option value="">Select Category</option>';
    							   foreach($searchresults as $rows):
    									$displayvar .='<option value="'.$rows->id.'">'.$rows->name.'</option>';
    								endforeach;
    			$displayvar .= '</select>';
    			echo $displayvar;
		}
		else{
			echo "Null";
		}
  }

	public function imageResize($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
	}


	public function approvedAccount(Request $req)
  {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'status'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);


		$getSellerinfo = DB::table($tablename)->whereIn('id', $valuearray)->get();

		 foreach($getSellerinfo as $sellerinfo){
			$smails = $sellerinfo->email;
			$snames = $sellerinfo->name;
			$data = array(
					"from"=> 'support@aleshamart.com',
					"name"=> $snames,
					"to"=> $smails,
			);

			Mail::send('admin.mail.seller_account_confirm', $data, function($message) use ($data)
			{
				$message->to($data['to'], $data['name']);
				$message->subject('Hi '.$data['name'].', Welcome to Selling on aleshamart');
				$message->from($data['from'],"aleshamart");
			 });
		 }

        return redirect()->back();
  }
    public function customer_details($id) {

        if(is_null($this->user) || !$this->user->can('customer.detail')) {
            return view('admin.error.denied');
        } else {
            $customer = Customer::find($id);
            $addresses = Address::where('customer_id',$id)->select('district_id','area_id','address','address_type','created_at','updated_at')->with('district','area')->get();

            $order_blocks = [
                [
                    'title' => 'Total Order :',
                    'number' => Order::where('customer_id', $id)->count(),
                    'amount' => Order::where('customer_id', $id)->sum('total_price')
                ],
                [
                    'title' => 'Total Order from Website :',
                    'number' => Order::where('customer_id', $id)->where('type','web')->count(),
                    'amount' => Order::where('customer_id', $id)->where('type','web')->sum('total_price')
                ],
                [
                    'title' => 'Total Order from App :',
                    'number' => Order::where('customer_id', $id)->where('type','api')->count(),
                    'amount' => Order::where('customer_id', $id)->where('type','api')->sum('total_price')
                ],
                [
                    'title' => 'Total Pending Order :',
                    'number' => Order::where('customer_id', $id)->where('status','pending')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','pending')->sum('total_price')
                ],
                [
                    'title' => 'Total Processing Order :',
                    'number' => Order::where('customer_id', $id)->where('status','processing')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','processing')->sum('total_price')
                ],
                [
                    'title' => 'Total Ready to Ship Order :',
                    'number' => Order::where('customer_id', $id)->where('status','ready_to_ship')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','ready_to_ship')->sum('total_price')
                ],
                [
                    'title' => 'Total Shipped Order :',
                    'number' => Order::where('customer_id', $id)->where('status','shipped')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','shipped')->sum('total_price')
                ],
                [
                    'title' => 'Total Delivered Order :',
                    'number' => Order::where('customer_id', $id)->where('status','delivered')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','delivered')->sum('total_price')
                ],
                [
                    'title' => 'Total Canceled Order :',
                    'number' => Order::where('customer_id', $id)->where('status','canceled')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','canceled')->sum('total_price')
                ],
                [
                    'title' => 'Total Refunded Order :',
                    'number' => Order::where('customer_id', $id)->where('status','refunded')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','refunded')->sum('total_price')
                ],

                [
                    'title' => 'Total Picked Order :',
                    'number' => Order::where('customer_id', $id)->where('status','Picked')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','Picked')->sum('total_price')
                ],

                [
                    'title' => 'Total Partial Delivered Order :',
                    'number' => Order::where('customer_id', $id)->where('status','partial_delivered')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','partial_delivered')->sum('total_price')
                ],
                [
                    'title' => 'Total Returned Order :',
                    'number' => Order::where('customer_id', $id)->where('status','returned')->count(),
                    'amount' => Order::where('customer_id', $id)->where('status','returned')->sum('total_price')
                ],

            ];

            $transaction_blocks = [
                [
                    'title' => 'Total Partial Order :',
                    'number' => Order::where('customer_id', $id)->where('payment_status','partial')->count(),
                    'amount' => Order::where('customer_id', $id)->where('payment_status','partial')->sum('total_price'),
                ],
                [
                    'title' => 'Total Paid Order :',
                    'number' => Order::where('customer_id', $id)->where('payment_status','paid')->count(),
                    'amount' => Order::where('customer_id', $id)->where('payment_status','paid')->sum('total_price'),
                ],
                [
                    'title' => 'Total Unpaid Order :',
                    'number' => Order::where('customer_id', $id)->where('payment_status','unpaid')->count(),
                    'amount' => Order::where('customer_id', $id)->where('payment_status','unpaid')->sum('total_price'),
                ],
                [
                    'title' => 'Total Refunded Order :',
                    'number' => Order::where('customer_id', $id)->where('payment_status','refunded')->count(),
                    'amount' => Order::where('customer_id', $id)->where('payment_status','refunded')->sum('total_price'),
                ],
                [
                    'title' => 'Total Partial Refunded Order :',
                    'number' => Order::where('customer_id', $id)->where('payment_status','partial_refunded')->count(),
                    'amount' => Order::where('customer_id', $id)->where('payment_status','partial_refunded')->sum('total_price'),
                ],

            ];

            return view('admin.customer.details', compact('customer','addresses','order_blocks','transaction_blocks'));
        }
    }

    public function total_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->get();
      return view('admin.customer.total_order',compact('customer_info','customerOrders'));
    }
    public function unshipped_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->where('status','Unshipped')->get();
      return view('admin.customer.unshipped_order',compact('customer_info','customerOrders'));
    }
    public function complete_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->where('status','Delivered')->get();
      return view('admin.customer.complete_order',compact('customer_info','customerOrders'));
    }
    public function canceled_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->where('status','Canceled')->get();
      return view('admin.customer.canceled_order',compact('customer_info','customerOrders'));
    }
    public function returned_orders($id)
    {
      $customer_info = Customer::where('id',$id)->first();
      $customerOrders = Order::where('customer_id', $id)->where('status','Returned')->get();
      return view('admin.customer.returned_order',compact('customer_info','customerOrders'));
    }


}
