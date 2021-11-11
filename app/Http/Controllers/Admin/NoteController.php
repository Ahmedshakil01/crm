<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Note;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use Mail;

class NoteController extends Controller
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
				$allleadsource = Note::where($colid,$request->id)->orderBy('id', 'DESC')->get();
           	    return view('admin.note.index', compact('allleadsource','type','id'));
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
		
			if($type!=""){
				if($type=='lead'){
					$colid = 'lead_id';
				}
				elseif($type=='lead'){
					$colid = 'contact_id';
				}
				
				$nt = new Note;
				
				/*$noticefiles = $request->file('noticefile');
				$savedFileName = 'note_'.time() . '.' . $noticefiles->getClientOriginalExtension();        
				$noticefiles->move("uploads/note/", $savedFileName);*/
				
				
				if ($request->hasFile('noticefile')) {
            		if($request->file('noticefile')->isValid()) {
						try {
							$file = $request->file('noticefile');
							$savedFileName = 'note_'.time() . '.' . $file->getClientOriginalExtension();    
							$file->move("uploads/note/", $savedFileName);	
						   
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
		$noteid = $request->noteid;
		
			if($type!=""){
				if($type=='lead'){
					$colid = 'lead_id';
				}
				elseif($type=='lead'){
					$colid = 'contact_id';
				}
				
				$nt = Note::find($noteid);
				
				if ($request->hasFile('noticefileupdate')) {
            		if($request->file('noticefileupdate')->isValid()) {
						try {
							$file = $request->file('noticefileupdate');
							$savedImageName = 'note_'.time() . '.' . $file->getClientOriginalExtension();    
							$file->move("uploads/note/", $savedFileName);	
						   
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