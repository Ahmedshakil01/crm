<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Mailbox;
use App\Models\MailReply;
use App\Models\MailAttachment;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use Carbon;
use Schema;
use Session;
use DB;
use Image;
use View;

class MailboxController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:customer');
    // }
    // public function commons()
    // {
	// 	$userid = Auth::guard('customer')->user()->id;
	// 	$arrayval = array('tables'=>'customers','userid'=>$userid);
	// 	return $arrayval;
	// }

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

    public function index()
    {
		// $guardtables = $this->commons();
		// $userid = $guardtables['userid'];
		// $custominfo = DB::table($guardtables['tables'])->where('id',$userid)->first();

		// $menus = Menu::where('parent_id', NULL)->get();
    	// $mainmenus = Menu::all();
        $userid = 7328;
		$allmails = Mailbox::where([['tomail',$userid],['sender_type','Admin'],['status','Sent']])->get();
        // dd($allmails);
        return view('frontend.customer.mailbox.lists',compact('allmails'));
    }

    public function details($id)
    {
		// $guardtables = $this->commons();
		// $userid = $guardtables['userid'];
		// $custominfo = DB::table($guardtables['tables'])->where('id',$userid)->first();
		$allmails = Mailbox::where('id',$id)->first();
        // dd($allmails);
        return view('frontend.customer.mailbox.maildetails',compact('allmails'));
    }
    public function mailReply(Request $request){
        // dd($request->all());
		$posts['mail_id'] = $request->mailid;
		$posts['tomail'] = $request->tomail;
		$posts['description'] = $request->replymsg;
		$posts['sender_type'] = "Seller";
		$posts['receiver_type'] = 'Admin';
		$posts['created_at'] = date('Y-m-d H:i:s');
		$posts['updated_at'] = date('Y-m-d H:i:s');

		$updateprofile = MailReply::insert($posts);
		$getMailid = DB::getPdo()->lastInsertId();

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

    public function sentmail()
    {
		// $guardtables = $this->commons();
		// $userid = $guardtables['userid'];
		// $custominfo = DB::table($guardtables['tables'])->where('id',$userid)->first();
        $userid = 119;
		$allmails = Mailbox::where([['userid',$userid],['sender_type','Seller'],['status','Sent']])->get();
        dd($allmails);
        return view('frontend.seller.mailbox.sentmail',compact('allmails','userid'));
    }
}
