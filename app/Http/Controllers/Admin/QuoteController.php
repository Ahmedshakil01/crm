<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Quote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class QuoteController extends Controller
{

    public function __construct()
    {
      // $this->middleware('auth:administration');
      $this->middleware(function($request, $next) {
        $this->user = Auth::guard('administration')->user();
        return $next($request);
      });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.quote.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $id)
    {
        if (is_null($this->user) || !$this->user->can('news.edit')) {
            return view('admin.error.denied');
        } else {
            $contact=Contact::find($id);
            return view('admin.quote.create', compact('contact'));
        }
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (is_null($this->user) || !$this->user->can('news.edit')) {
            return view('admin.error.denied');
        } else {

            $data = json_decode($_POST['data']);
            $getDataValue=[];
            $getDataValue['quote_owner'] = $data['0']->quote_owner;
            $getDataValue['status'] = $data['0']-> status;
            $getDataValue['subject'] = $data['0']-> subject;
            $getDataValue['team'] = $data['0']-> team;
            $getDataValue['deal_name'] = $data['0']-> deal_name;
            $getDataValue['valid_until'] = $data['0']-> valid_until;
            $getDataValue['contact_id'] = $data['0']-> contact_id;
            $getDataValue['billing_street'] = $data['0']-> billing_street;
            $getDataValue['billing_city'] = $data['0']-> billing_city;
            $getDataValue['billing_state'] = $data['0']-> billing_state;
            $getDataValue['billing_code'] = $data['0']-> billing_code;
            $getDataValue['billing_country'] = $data['0']-> billing_country;
            $getDataValue['shipping_street'] = $data['0']-> shipping_street;
            $getDataValue['shipping_city'] = $data['0']-> shipping_city;
            $getDataValue['shipping_state'] = $data['0']-> shipping_state;
            $getDataValue['shipping_code'] = $data['0']-> shipping_code;
            $getDataValue['shipping_country'] = $data['0']-> shipping_country;
            
            $quote=Quote::create($getDataValue);

            if($quote){
                $quote_id =  $quote->id;
                $contact_id = $quote->contact_id;

                $product_name = $data['0']-> product_name;
                $quantity = $data['0']-> quantity;
                $price = $data['0']-> price;
                $amount = $data['0']-> amount;
                $discount = $data['0']-> discount;
                $tax = $data['0']-> tax;
                $total = $data['0']-> total;

                foreach($product_name as $k=>$val){
                    $array = array(
                        "quote_id"=>$quote_id,
                        "contact_id"=>$contact_id,
                        "product_name"=>$product_name[$k],
                        "quantity"=>$quantity[$k],
                        "price"=>$price[$k],
                        "amount"=>$amount[$k],
                        "discount"=>$discount[$k],
                        "tax"=>$tax[$k],
                        "total"=>$total[$k],
                    );
                    Product::create($array);
                }



                return  true;
            }else{
                return  false;
            }
         




       
           
            // return redirect()->route('admin.contact.details',  $quote->contact_id)->with('success', 'Successfully Created');
        }
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    
    public function quote_details($id)
    {
      if(is_null($this->user) || !$this->user->can('news.edit')) {
        return view('admin.error.denied');
      } else {
        $quote_details = Quote::with('products')->where('id', $id)->first();
       
        return view('admin.quote.details',compact('quote_details'));
      }
    }

    public function quote_print($id)
    {
      if(is_null($this->user) || !$this->user->can('news.edit')) {
        return view('admin.error.denied');
      } else {
        $quote_details = Quote::with('products')->where('id', $id)->first();
       
        return view('admin.quote.print',compact('quote_details'));
      }
    }
}
