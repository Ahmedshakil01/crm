<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use View;
use Hash;
use App\Models\LeadSource;
use Validator;
use Image;
use Mail;


class LeadSourceController extends Controller
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
		 $allleadsource = LeadSource::orderBy('id','DESC')->get();
		  return view('admin.lead_sources.index',compact('allleadsource'));
	}
  }


  public function create()
  {
    if(is_null($this->user) || !$this->user->can('news.create')) {
      return view('admin.error.denied');
    } else {
      return view('admin.lead_sources.create');
    }
  }

  public function store(Request $request)
  {
    if(is_null($this->user) || !$this->user->can('news.create')) {
      return view('admin.error.denied');
    } else {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:lead_sources',
      ]);

      $m = new LeadSource;
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
      return redirect('administration/lead_sources')->with('success','Created Successfully');
    }
  }
	public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $lead_sources = LeadSource::find($id);
    if($lead_sources!=""){
      if(is_null($this->user) || !$this->user->can('news.edit')) {
        return view('admin.error.denied');
      } else {
        return view('admin.lead_sources.edit',compact('lead_sources'));
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

    	$lead_sources = LeadSource::find($id);
		if($lead_sources!=""){
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

			$lead_sources->update($arrayVal);
			return redirect('administration/lead_sources')->with('success', 'Successfully Update!');
		  }
		}
		else{
		  abort(404);
		}
  }
}
