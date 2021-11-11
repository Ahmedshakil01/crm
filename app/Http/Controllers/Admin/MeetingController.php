<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Meeting;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use Mail;

class MeetingController extends Controller
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
				$allleadsource = Meeting::where($colid,$request->id)->orderBy('id', 'DESC')->get();
           	    return view('admin.meeting.index', compact('allleadsource','type','id'));
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
		$details = $request->details;
		$meeting_date = $request->meeting_date;
		$status = $request->status;
		
			if($type!=""){
				if($type=='lead'){
					$colid = 'lead_id';
				}
				elseif($type=='lead'){
					$colid = 'contact_id';
				}
				
				$nt = new Meeting;
				
				/*$noticefiles = $request->file('noticefile');
				$savedFileName = 'meeting_'.time() . '.' . $noticefiles->getClientOriginalExtension();        
				$noticefiles->move("uploads/meeting/", $savedFileName);*/
				
				if ($request->hasFile('noticefile')) {
            		if($request->file('noticefile')->isValid()) {
						try {
							$file = $request->file('noticefile');
							$savedFileName = 'meeting_'.time() . '.' . $file->getClientOriginalExtension();    
							$file->move("uploads/meeting/", $savedFileName);	
						   
						} catch (Illuminate\Filesystem\FileNotFoundException $e) {        
					  }
					}
				}
				else{
					$savedFileName = '';
				}
				
				$nt->files = $savedFileName;
				$nt->caption = $caption;
				$nt->details = $details;	
				$nt->meeting_date = $meeting_date;	
				$nt->status = $status;		
				$nt->$colid = $id;
				$nt->created_at = date('Y-m-d H:i:s');
				$nt->updated_at = date('Y-m-d H:i:s');
				$nt->save();
				
				return redirect()->back()->with('message','Successfully inserted');		
			}
			else{
				 return redirect()->back()->with('message','Pleased select lead or contact');
			}
       }
    }
	
	
	
	 public function update(Request $request)
    {
		$userid = Auth::guard('administration')->user()->id;
        if (is_null($this->user) || !$this->user->can('news.create')) {
            return view('admin.error.denied');
        } else {
		
		//dd($request->all());
		$type = $request->type;
		$id = $request->id;
		$caption = $request->caption;
		$details = $request->details;
		$meeting_date = $request->meeting_date;
		$status = $request->status;
		$meetingid = $request->meetingid;
		
			if($type!=""){
				if($type=='lead'){
					$colid = 'lead_id';
				}
				elseif($type=='lead'){
					$colid = 'contact_id';
				}
				
				$nt = Meeting::find($meetingid);
				
				if ($request->hasFile('noticefileupdate')) {
            		if($request->file('noticefileupdate')->isValid()) {
						try {
							$file = $request->file('noticefileupdate');
							$savedImageName = 'meeting_'.time() . '.' . $file->getClientOriginalExtension();    
							$file->move("uploads/meeting/", $savedFileName);	
						   
						} catch (Illuminate\Filesystem\FileNotFoundException $e) {        
					  }
					}
				}
				else{
					$savedImageName = $request->stillimg;
				}
				$nt->files = $savedImageName;
				$nt->caption = $caption;
				$nt->details = $details;	
				$nt->meeting_date = $meeting_date;	
				$nt->status = $status;	
				$nt->$colid = $id;
				$nt->created_at = date('Y-m-d H:i:s');
				$nt->updated_at = date('Y-m-d H:i:s');
				$nt->save();
				
				return redirect()->back()->with('message','Successfully inserted');		
			}
			else{
				 return redirect()->back()->with('message','Pleased select lead or contact');
			}
       }
    }	   
}