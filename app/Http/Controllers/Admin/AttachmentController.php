<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Attachment;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use Mail;

class AttachmentController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:administration');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        //dd($request);
        if (is_null($this->user) || !$this->user->can('news.view')) {
            return view('admin.error.denied');
        } else {
			$type = $request->type;
			$id = $request->id;
			
			if($type!=""){
				if($type=='lead'){
					$colid = 'lead_id';
				}
				elseif($type=='lead'){
					$colid = 'contact_id';
				}
				$allleadsource = Attachment::where($colid,$request->id)->orderBy('id', 'DESC')->get();
           	    return view('admin.attachments.index', compact('allleadsource','type','id'));
			}
			else{
				 return redirect()->back()->with('message','Pleased select lead or contact');
			}
            
        }
    }

    public function store(Request $request)
    {
		$userid = Auth::guard('administration')->user()->id;
        if (is_null($this->user) || !$this->user->can('news.create')) {
            return view('admin.error.denied');
        } else {

		$type = $request->type;
		$id = $request->id;
		$caption = $request->caption;
		if($type!=""){
			if($type=='lead'){
				$colid = 'lead_id';
			}
			elseif($type=='lead'){
				$colid = 'contact_id';
			}
			
			if($request->hasfile('noticefile'))
			 {
				$pi = 0;
				foreach($request->file('noticefile') as $k=>$noticefiles)
				{
					$nt = new Attachment;
					$pi++;
					
					$savedFileName = 'notice'.$pi.'_'.time() . '.' . $noticefiles->getClientOriginalExtension();        
					$noticefiles->move("uploads/attachment/".$type."/", $savedFileName);
					
					$nt->files = $savedFileName;
					$nt->caption = $caption[$k];	
					$nt->$colid = $id;
					$nt->created_at = date('Y-m-d H:i:s');
					$nt->updated_at = date('Y-m-d H:i:s');
					$nt->save();
				}
			 }	
			 return redirect()->back()->with('message','Successfully inserted');		
		}
		else{
			 return redirect()->back()->with('message','Pleased select lead or contact');
		}
       }
    }
	
     public function sampleFileDownload(Request $req)
    {
		$getFile = $req->file_names;
		//$getFile = $req->file_names.'.csv';		
    	$filePath = public_path($req->path.'/'.$getFile);		
    	$headers = ['Content-Type: application/*'];
    	return response()->download($filePath, $getFile, $headers);
    }


}
