<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Database\Schema\Blueprint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\Mailbox;
use App\Models\MailAttachment;
use App\Models\MailReply;
use App\Models\Merchant;
use App\Models\Menu;
// use Auth;
use Carbon;
use Schema;
use Session;
use DB;
use Image;
use View;

class MailboxController extends Controller
{

    public function __construct()
    {
    	// $this->middleware('auth:administration');
		$this->middleware(function($request, $next) {
			$this->user = Auth::guard('administration')->user();
			return $next($request);
		  });
    }


    public function inbox()
    {
		if(is_null($this->user) || !$this->user->can('support.inbox')) {
			return view('admin.error.denied');
		} else {
			$allmails = Mailbox::where([['sender_type','Seller'],['status','Sent']])->get();

			return view('admin.mailbox.lists',compact('allmails'));
		}
    }


	public function details($id)
    {
		// dd($id);
		$allmails = MailReply::where('id',$id)->first();
		// $allmails = Mailbox::where('id',$id)->first();
        //$sellerinfo =Merchant::where('id', $allmails->tomail)->select('email')->get();

        return view('admin.mailbox.maildetails',compact('allmails'));
    }


	public function sentmail()
	{
		if(is_null($this->user) || !$this->user->can('support.sentmail')) {
			return view('admin.error.denied');
		} else {
			$allmails = Mailbox::where([['sender_type','Admin'],['status','Sent']])->get();
			return view('admin.mailbox.sentmail',compact('allmails'));
		}
    }

	public function draftmail()
    {
		if(is_null($this->user) || !$this->user->can('support.draftmail')) {
			return view('admin.error.denied');
		} else {
			$allmails = Mailbox::where([['sender_type','Admin'],['status','Draft']])->get();
			return view('admin.mailbox.draftmail',compact('allmails'));
		}
    }

	public function newMail()
    {
		if(is_null($this->user) || !$this->user->can('support.compose')) {
			return view('admin.error.denied');
		} else {
//			$sellerinfo = DB::table('customers')->get();
			return view('admin.mailbox.newmail');
		}
    }

	private function getToken($length){
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";

       // mt_srand($seed);      // Call once. Good since $application_id is unique.
	   mt_srand(time());

        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }


	public function mailSendAction(Request $request){
		$userid = Auth::guard('administration')->user()->id;

		if(isset($request->send) && $request->send!=''){
			$status = 'Sent';
		}
		elseif(isset($request->draft) && $request->draft!=''){
			$status = 'Draft';
		}

		$token = $this->getToken(40);
        $codes = 'EN'. $token . substr(strftime("%Y", time()),2);

		$posts['userid'] = $userid;
		$posts['tomail'] = $request->tomail;
		$posts['subject'] = $request->subject;
		$posts['slug'] = strtolower(implode('-', explode(' ', $request->subject)));
		$posts['description'] = $request->message;
		$posts['sender_type'] = "Admin";
		$posts['mailtype'] = $request->mailtype;
		$posts['receiver_type'] = 'Seller';
		$posts['status'] = $status;
		$posts['token'] = $codes;
		$posts['active'] = 0;
		$posts['created_at'] = date('Y-m-d H:i:s');
		$posts['updated_at'] = date('Y-m-d H:i:s');

		$updateprofile = Mailbox::insert($posts);
		$getMailid = DB::getPdo()->lastInsertId();

		if($request->hasfile('mailattach'))
         {
		 	$pi = 0;
            foreach($request->file('mailattach') as $noticefiles)
            {
				$nt = new MailAttachment;
				$pi++;

				$savedFileName = 'mail'.$pi.'_'.time() . '.' . $noticefiles->getClientOriginalExtension();
                $noticefiles->move("uploads/mail/", $savedFileName);

				$nt->userid = $userid;
				$nt->files = $savedFileName;
				$nt->mail_id = $getMailid;
				$nt->created_at = date('Y-m-d H:i:s');
				$nt->updated_at = date('Y-m-d H:i:s');
				$nt->save();
            }
         }

		Session::flash('successmessage', 'Successfully '.$status);
		return redirect()->back();
    }


	public function mailReply(Request $request)
	{

		$posts['mail_id'] = $request->mailid;
		$posts['tomail'] = $request->tomail;
		$posts['description'] = $request->replymsg;
		$posts['sender_type'] = "Admin";
		$posts['receiver_type'] = 'Seller';
		$posts['created_at'] = date('Y-m-d H:i:s');
		$posts['updated_at'] = date('Y-m-d H:i:s');

		$updateprofile = MailReply::insert($posts);
		$getMailid = DB::getPdo()->lastInsertId();

		DB::table('mailboxes')->update(['mailtype' => $request->mailtype] );

		if($request->hasfile('mailattach'))
         {
		 	$pi = 0;
            foreach($request->file('mailattach') as $noticefiles)
            {
				$nt = new MailAttachment;
				$pi++;

				$savedFileName = 'mail'.$pi.'_'.time() . '.' . $noticefiles->getClientOriginalExtension();
                $noticefiles->move("uploads/mail/reply/", $savedFileName);

				$nt->files = $savedFileName;
				$nt->mail_id = $getMailid;
				$nt->created_at = date('Y-m-d H:i:s');
				$nt->updated_at = date('Y-m-d H:i:s');
				$nt->save();
            }
         }

		Session::flash('successmessage', 'Successfully replied');
		return redirect()->back();
    }

	public function allMailReply()
	{
		if(is_null($this->user) || !$this->user->can('support.sentmail')) {
			return view('admin.error.denied');
		} else {
			$allmails = MailReply::where([['sender_type','Seller']])->with('mailBoxes')->orderBy('id','desc')->get();
			return view('admin.mailbox.replies',compact('allmails'));
		}
    }



	public function autocomplete(Request $req)
    {
		$key = $req->input('q');
		if (isset($key) && $key!='') {
			$custominfo = Customer::where('name', 'LIKE', "%{$req->input('q')}%")->get();
			//return Merchant::where('name', 'LIKE', "%{$request->input('tomail')}%")->get();
		}
		else{
			$custominfo = '';
		}


		return $custominfo;

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



}
