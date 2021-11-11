<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use View;
use Hash;
use App\Models\LeadIndustry;
use Validator;
use Image;
use Mail;


class LeadIndustryController extends Controller
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
		 $allleadsource = LeadIndustry::orderBy('id','DESC')->get();
		  return view('admin.lead_industry.index',compact('allleadsource'));
	}
  }


  public function create()
  {
    if(is_null($this->user) || !$this->user->can('news.create')) {
      return view('admin.error.denied');
    } else {
      return view('admin.lead_industry.create');
    }
  }

  public function store(Request $request)
  {
    if(is_null($this->user) || !$this->user->can('news.create')) {
      return view('admin.error.denied');
    } else {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255|unique:lead_industry',
      ]);

      $m = new LeadIndustry;
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
      return redirect('administration/lead_industry')->with('success','Created Successfully');
    }
  }
	public function show($id)
  {
    //
  }

  public function edit($id)
  {
    $lead_industry = LeadIndustry::find($id);
    if($lead_industry!=""){
      if(is_null($this->user) || !$this->user->can('news.edit')) {
        return view('admin.error.denied');
      } else {
        return view('admin.lead_industry.edit',compact('lead_industry'));
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

    	$lead_industry = LeadIndustry::find($id);
		if($lead_industry!=""){
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

			$lead_industry->update($arrayVal);
			return redirect('administration/lead_industry')->with('success', 'Successfully Update!');
		  }
		}
		else{
		  abort(404);
		}
  }
}
