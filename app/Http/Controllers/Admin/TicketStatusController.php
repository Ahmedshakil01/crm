<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use View;
use Hash;
use App\Models\TicketStatus;
use Validator;
use Image;
use Mail;


class TicketStatusController extends Controller
{
  public function __construct()
  {
    // $this->middleware('auth:administration');
    $this->middleware(function($request, $next) {
      $this->user = Auth::guard('administration')->user();
      return $next($request);
    });
  }

	public function index(Request $request)
  {
  	//dd($request);
    if(is_null($this->user) || !$this->user->can('news.view')) {
      return view('admin.error.denied');
    } else {
		 $allleadsource = TicketStatus::orderBy('id','DESC')->get();
		  return view('admin.ticket_status.index',compact('allleadsource'));
	}
  }


  public function create()
  {
    if(is_null($this->user) || !$this->user->can('news.create')) {
      return view('admin.error.denied');
    } else {
      return view('admin.ticket_status.create');
    }
  }

  public function store(Request $request)
  {
    if(is_null($this->user) || !$this->user->can('news.create')) {
      return view('admin.error.denied');
    } else {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:ticket_status',
      ]);

      $m = new TicketStatus;
	  $expval=explode(' ',$request->name);
	  $impval=implode('-',$expval);
	  $slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"'],'' , strtolower($impval));

      $m->name = $request->name;
      $m->details = $request->details;
      $m->status = $request->status;
	  $m->slug = $slug;
      $m->created_at = date('Y-m-d H:i:s');
      $m->updated_at = date('Y-m-d H:i:s');
      $m->save();
      return redirect('administration/ticket_status')->with('success','Created Successfully');
    }
  }
	public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $ticket_status = TicketStatus::find($id);
    if($ticket_status!=""){
      if(is_null($this->user) || !$this->user->can('news.edit')) {
        return view('admin.error.denied');
      } else {
        return view('admin.ticket_status.edit',compact('ticket_status'));
      }
    }
    else{
      abort(404);
    }
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
  		'name' => 'required|string|max:255',
  	]);

    	$ticket_status = TicketStatus::find($id);
		if($ticket_status!=""){
		  if(is_null($this->user) || !$this->user->can('news.edit')) {
			 return view('admin.error.denied');
		  }
		  else {
			$arrayVal = array(
			  'name' => $request->name,
			  'details' => $request->details,
			  'status' => $request->status,
			  'updated_at' => date('Y-m-d H:i:s'),
			);

			$ticket_status->update($arrayVal);
			return redirect('administration/ticket_status')->with('success', 'Successfully Update!');
		  }
		}
		else{
		  abort(404);
		}
  }
}
