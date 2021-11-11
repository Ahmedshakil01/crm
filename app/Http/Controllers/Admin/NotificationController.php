<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Notification;
use App\Models\NotificationsType;
use App\Models\UsersType;
use Illuminate\Http\Request;
use \App\Mail\SendMail;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateType;
use Illuminate\Support\Facades\Auth;
use kcfinder\file;
use Validator;
use Intervention\Image\Facades\Image;
use Mail;
class NotificationController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth:administration');
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }

    public function indexNotification() {
        if(is_null($this->user) || !$this->user->can('notification.view')) {
            return view('admin.error.denied');
        } else {
            $notifications = Notification::with('customer','sender','TemplateType')->get();
            // dd($notifications);
            return view('admin.notification.index',compact('notifications'));
        }
    }

    public function createNotification() {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
            $customers = Customer::select('id','email')->take(1000)->get();
            $emailTemplateTypes = EmailTemplateType::all();
            return view('admin.notification.create',compact('customers','emailTemplateTypes'));
        }
    }

    public function storeNotification (Request $request)
    {
        $customerInfo = Customer::whereIn('id',$request->user_id)
                ->select('email','id')
                ->get();
        $senderId = Auth()->user()->id;     
            foreach($customerInfo as $customer) {
                $customerEmail[] = $customer->email;
                $customerId[] = $customer->id;
            }
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {

            $validator = Validator::make($request->all(), [
                'image' => ['required|image'],
                'details' => 'required|string',
                'subject' => 'required|string',
            ]);

            if ($request->hasFile('image')) {
                if($request->file('image')->isValid()) {
                    try {
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }
                }
            }

            else{
                $savePhotos = '';
            }

            $notification = new Notification();
            $notification->user_id      = join(',',$customerId);
            // $notification->user_id      = join(',',$customerId);
            $notification->sender_id    = $senderId;
            $notification->temp_type    = $request->temp_type;
            $notification->details      = $request->details;
            $notification->subject      = $request->subject;
            $notification->image        = $savePhotos;
            $notification->save();

            $data["email"] = $customerEmail;

            $data["title"] = "Mail from Alesha Mart CRM";
            $data["body"] = $request->details;
            $files = [
                $pathLarge = 'uploads/notification/'.$savePhotos,
            ];

            Mail::send('emails.sendmail', $data, function($message)use($data, $files) {
                $message->from($data["email"])->to($data["email"])
                        ->subject($data["title"]);

                foreach ($files as $file){
                    $message->attach($file);
                }
            });
            return back()->with('success', 'Create Successfully !');
        }
    }

    public function notificationEdit($id) {
        $notification = Notification::find($id);
        if($notification!=""){
            if(is_null($this->user) || !$this->user->can('notification.edit')) {
                return view('admin.error.denied');
            } else {
                $merchants = Merchant::all();
            $customers = Customer::all();
            $userTypes = UsersType::where('status', 1)->get();
            $notificationTypes = NotificationsType::where('status', 1)->get();
            return view('admin.notification.notification-edit',compact('notification','userTypes','notificationTypes','merchants','customers'));
            }
        }else{
            abort(404);
        }
    }
    public function notificationUserUpdate(Request $request) {
        $validator = Validator::make($request->all(), [
            // 'image' => ['required|image']
        ]);
        $notification = Notification::find($request->id);
        if($notification!=""){
            if(is_null($this->user) || !$this->user->can('notification.edit')) {
                return view('admin.error.denied');
            } else {
                $fileImage = $request->file('image');
                if($fileImage && $request->user_id && $request->merchant_id) {
                    try {
                        unlink($notification->image);
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }
                    $notification->user_id      = $request->user_id;
                    $notification->merchant_id  = $request->merchant_id;
                    $notification->image        = $savePhotos;

                }
                elseif($fileImage && $request->user_id) {
                    try {
                        unlink($notification->image);
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }

                    $notification->user_id      = $request->user_id;
                    $notification->image        = $savePhotos;

                }
                elseif($fileImage && $request->merchant_id){
                    try {
                        unlink($notification->image);
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }
                    $notification->merchant_id  = $request->merchant_id;
                    $notification->image        = $savePhotos;
                }
                elseif($request->user_id && $request->merchant_id){

                    $notification->user_id      = $request->user_id;
                    $notification->merchant_id  = $request->merchant_id;
                }
                elseif($fileImage){
                    try {
                        unlink($notification->image);
                        $file = $request->file('image');
                        $savePhotos = 'image_'.time() . '.' . $file->getClientOriginalExtension();
                        $pathLarge = 'uploads/notification/'.$savePhotos;
                        $this->imageResize($file,$pathLarge,$savePhotos, 600, null);

                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }

                    $notification->image        = $savePhotos;

                }
                elseif($request->user_id){
                    $notification->merchant_id  = $request->merchant_id;
                    $notification->user_id      = $request->user_id;
                }
                elseif($request->merchant_id){
                    $notification->user_id      = $request->user_id;
                    $notification->merchant_id  = $request->merchant_id;
                }
                $notification->user_type    = $request->user_type;
                $notification->topic_type   = $request->topic_type;
                $notification->details      = $request->details;
                $notification->status       = $request->status;
                $notification->save();

                return redirect()->route('notification.index')->with('success', 'Update Successfully !');;
            }
        } else {
            abort(404);

        }
    }

    /*
     *
     * Notification types
     * this method use for crate notification type
     *
     *
     * */

    public function notificationType() {
        $notificationsTypes = NotificationsType::all();
        return view('admin.notification.notification-type',compact('notificationsTypes'));
    }
    public function createNotificationType() {
        return view('admin.notification.create-notification-type');
    }
    public function notificationTypeStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        $notificationType = new NotificationsType();
        $notificationType->name     = $request->name;
        $notificationType->status   = $request->status;
        $notificationType->save();
        return redirect('administration/notification/type')->with('success', 'Created Successfully !');;
    }
    public function notificationTypeEdit($id) {
        $notificationType = NotificationsType::find($id);
        return view('admin.notification.notification-type-edit',compact('notificationType'));
    }
    public function notificationTypeUpdate(Request $request) {
        NotificationsType::notificationTypeUpdateData($request);
        return redirect()->route('notification.type')->with('success', 'Update Successfully !');;
    }

    /*
     * notification user type function
     *
     * */

    public function notificationUserType() {
        $allnews = UsersType::all();
        return view('admin.notification.notification-user-type',compact('allnews'));
    }
    public function notificationUserTypeCreate() {
        return view('admin.notification.notification-user-type-create');
    }
    public function notificationUserTypeStore(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        $userType = new UsersType();
        $userType->name = $request->name;
        $userType->status = $request->status;
        $userType->save();
        return redirect()->route('notification.user.type')->with('success', 'Create Successfully !');;
    }
    public function notificationUserTypeEdit($id) {
        $userType = UsersType::find($id);
        return view('admin.notification.notification-user-type-edit',compact('userType'));
    }
    public function notificationUserTypeUpdate(Request $request) {
        UsersType::notificationUserTypeUpdateData($request);
        return redirect()->route('notification.user.type')->with('success', 'Update Successfully !');;
    }
    public function notificationUserTypeDelete($id) {
        // dd($id);
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

    /*
     *
     * Notification Template API
     *
     *
     * */

    public function emailTypeAjax(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.view')) {
            return view('admin.error.denied');
        } else {
            $notificationsTypes = EmailTemplate::where('temp_type_id', $request->id)->select('message')->first();
            return response()->json($notificationsTypes);
        }
    }
}
