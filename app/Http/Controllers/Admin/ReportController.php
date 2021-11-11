<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\InvoiceLog;
use App\Models\Merchant;
use App\Models\Order;
use App\Models\OrderDetail;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use MyCLabs\Enum\Enum;
use ZipArchive;

class ReportController extends Controller
{
    //
    /**
     * @var string
     */
    private $browser;

    public function __construct()
    {
        // $this->middleware('auth:administration');
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
        $this->browser = get_browser_name($_SERVER['HTTP_USER_AGENT']);
    }

    public function generatePO(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('po.generate')) {
            return view('admin.error.denied');
        } else { 
            $merchants = Merchant::where('status',1)->get();
            $fromdate = $request->get('from_date');
            $todate = $request->get('to_date');
            $merchant_id = $request->get('merchant_id');

            if ($request->merchant_id != ''){
                $merchant_name = Merchant::where('id',$merchant_id)->first();
            }
            else{
                $merchant_name='';
            }

            if (($request->has('from_date') && $request->get('from_date') != '') && ($request->has('to_date') && $request->get('to_date') != '') && $request->merchant_id != ''){

                $orders = Order::where('status','Processing')->where('seller_id',$merchant_id)->whereBetween('order_date',[$fromdate, $todate])->get();
            }
            elseif (($request->has('from_date') && $request->get('from_date') != '')  && $request->merchant_id != ''){

                $orders = Order::where('status','Processing')->where('seller_id',$merchant_id)->whereDate('order_date',$fromdate)->get();
            }
            elseif (($request->has('to_date') && $request->get('to_date') != '')  && $request->merchant_id != ''){

                $orders = Order::where('status','Processing')->where('seller_id',$merchant_id)->whereDate('order_date',$todate)->get();
            }
            elseif (($request->has('from_date') && $request->get('from_date') != '') && ($request->has('to_date') && $request->get('to_date') != '')){

                $orders = Order::where('status','Processing')->whereBetween('order_date',[$fromdate, $todate])->get();
            }
            elseif (($request->has('from_date') && $request->get('from_date') != '')){
                $orders = Order::where('status','Processing')->whereDate('order_date',$fromdate)->get();
            }
            elseif (($request->has('to_date') && $request->get('to_date') != '')){
                $orders = Order::where('status','Processing')->whereDate('order_date',$todate)->get();
            }
            elseif ($request->merchant_id != ''){
                $orders = Order::where('status','Processing')->where('seller_id',$merchant_id)->get();
            }
            else{
                $orders = Order::where('status','Processing')->paginate(30);
            }

            return view('admin.po.po',compact('merchants','orders','merchant_name','fromdate','todate','merchant_id'));
        }
    }

    public function poDownloadFromStorage(Request $request,$id)
    {
        if(is_null($this->user) || !$this->user->can('po.generate')) {
            return view('admin.error.denied');
        } else { 
            $this->validate($request,[
                'invoice_number' => 'unique:invoices',
                'order_id'       => 'unique:invoices',
            ]);

            $browser = $this->browser;
            $order = Order::findorFail($id);

            if ($order){
                $invoice_number = mt_rand(1000000000, 9999999999);
                //changing order status to picked
                $orderstatusUpdate = array(
                    'status' => 'Picked',
                );
                $order->update($orderstatusUpdate);


                $orderdetailsstatusUpdate = array(
                    'status' => 'Picked',
                );
                OrderDetail::whereIn('order_id', [$order->id])->where('status','Processing')->update($orderdetailsstatusUpdate);

                //invoice for po
                $menuUpdate = array(
                    'order_id'=> $order->id,
                    'customer_id'=> $order->customer_id,
                    'invoice_number'=> $invoice_number,
                    'invoice_date'=> date('Y-m-d'),
                    'created_at'=> date('Y-m-d H:i:s'),
                    'created_by'=> Auth::user()->id,
                    'updated_by'=> Auth::user()->id,
                    'updated_at'=> date('Y-m-d H:i:s')
                );

                $existInvoices = Invoice::where('order_id',$order->id)->first();
                if($existInvoices!=""){
                    $invoices = Invoice::findorfail($existInvoices->id);
                    $invoices->update($menuUpdate);
                }
                else{
                    $invoices = new Invoice();
                    $invoices->create($menuUpdate);
                }
                //pdf save
                $orderdetails = OrderDetail::whereIn('order_id', [$order->id])->where('status','Picked')->get();
                PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
                $pdf = PDF::loadView('admin.po.download-po', compact('order', 'invoice_number','browser','orderdetails'))->setPaper('a4', 'landscape');
                return $pdf->download('PO_AM'.$order->order_number . '.pdf');
            }
            return back();
        }
    }

    public function viewPO(){
        if(is_null($this->user) || !$this->user->can('po.generatedViewPO')) {
            return view('admin.error.denied');
        } else { 
            $invoices = Invoice::whereHas('getOrder')->paginate(50);
            return view('admin.po.view-po',compact('invoices'));
        }
    }

    public function downloadGeneratedPO($id){
        if(is_null($this->user) || !$this->user->can('po.generatedViewPO')) {
            return view('admin.error.denied');
        } else { 
            $browser = $this->browser;
            $order = Order::findorFail($id);
            $invoice = Invoice::where('order_id',$id)->first();

            $log = new InvoiceLog();
            $log->invoice_id = $invoice->id;
            $log->created_by = Auth::guard('administration')->user()->id;
            $log->updated_by = Auth::guard('administration')->user()->id;
            $log->save();

            PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
            $pdf = PDF::loadView('admin.po.generatedpo.view', compact('order','browser','invoice'))->setPaper('a4', 'landscape');
            return $pdf->stream('PO_AM'.$order->order_number . '.pdf');
        }
    }

    public function POLog(){
        if(is_null($this->user) || !$this->user->can('po.log')) {
            return view('admin.error.denied');
        } else { 
            $invoices = InvoiceLog::paginate(50);
            return view('admin.po.generatedpo.log',compact('invoices'));
        }
    }

}
