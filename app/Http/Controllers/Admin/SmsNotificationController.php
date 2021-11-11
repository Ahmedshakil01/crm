<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Models\SmsNotification;
use App\Models\SmsNotificationsType;
use App\Models\SmsNotificationTemplate;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class SmsNotificationController extends Controller
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
            $notifications = SmsNotification::all();
            return view('admin.sms.index',compact('notifications'));
        }
    }

    public function createNotification() {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
            $customers = Customer::select('id', 'name', 'phone')->limit(1000)->get();
            $notificationTypes = SmsNotificationsType::all();
            return view('admin.sms.create',compact('notificationTypes','customers'));
        }
    }

    public function storeNotification (Request $request)
    {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {

            $validator = Validator::make($request->all(), [
                'topic_type' => 'required',
                'user_id' => 'required',
                'details' => 'required|string',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
              }

            if($request->selectAll=='on'){
                $customers=Customer::all();
            }else{
                $customers=Customer::whereIn('id', $request->user_id)->get();
            }

            $customerId=[];
            $customerPhone=[];
            foreach ($customers as  $customer) {
                array_push($customerPhone, '88'.$customer->phone);
                array_push($customerId, $customer->id);
            }
            $notification = new SmsNotification();
            $notification->customer_id      = join(',',$customerId);
            $notification->sms_type   = ($request->selectAll=='on')? "All": null;
            $notification->sender_id   = Auth::guard('administration')->user()->id;
            $notification->topic_type   = $request->topic_type;
            $notification->details      = $request->details;
            $result=$notification->save();

            if($result){
                Helper::sendSMS( $customerPhone, $request->details, 1);
                return  redirect()->route('sms-notification.index')->with('success', 'SMS Send Successfully !');
            }else{

                return  redirect()->back()->with('error', 'Something Wrong.. !');
            }
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
        if(is_null($this->user) || !$this->user->can('notification.view')) {
            return view('admin.error.denied');
        } else {
            $notificationsTypes = SmsNotificationsType::all();
            return view('admin.sms.notification-type',compact('notificationsTypes'));
        }
    }




    public function createNotificationType() {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
         return view('admin.sms.create-notification-type');
        }
    }





    public function notificationTypeStore(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {

            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
              }
            $notificationType = new SmsNotificationsType();
            $notificationType->name     = $request->name;
            $notificationType->save();
            return redirect('administration/sms-notification/type')->with('success', 'Created Successfully !');
        }
    }





    public function notificationTypeEdit($id) {
        if(is_null($this->user) || !$this->user->can('notification.edit')) {
            return view('admin.error.denied');
        } else {
            $notificationType = SmsNotificationsType::find($id);
            return view('admin.sms.notification-type-edit',compact('notificationType'));
        }
    }



    public function notificationTypeUpdate(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.edit')) {
            return view('admin.error.denied');
            } else {
            SmsNotificationsType::notificationTypeUpdateData($request);
            return redirect()->route('sms-notification.type')->with('success', 'Update Successfully !');
            }
    }






    /*
     *
     * Notification Template types
     * this method use for crate notification type
     *
     *
     * */


    public function notificationTemplate() {
        if(is_null($this->user) || !$this->user->can('notification.view')) {
            return view('admin.error.denied');
        } else {
            $notificationTemplates = SmsNotificationTemplate::with('notificationsTypes')->get();
            return view('admin.sms.notificationTemplate',compact('notificationTemplates'));
        }
    }


    public function createNotificationTemplate() {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
            $notificationsTypes = SmsNotificationsType::all();
            return view('admin.sms.create-notification-template', compact('notificationsTypes'));
        }
    }





    public function notificationTemplateStore(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {

            $validator = Validator::make($request->all(), [
                'message' => 'required',
                'nt_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
              }
            $notificationType = new SmsNotificationTemplate();
            $notificationType->message     = $request->message;
            $notificationType->notifications_type_id     = $request->nt_id;
            $notificationType->save();
            return redirect('administration/sms-notification/template')->with('success', 'Created Successfully !');
        }
    }





    public function notificationTemplateEdit($id) {
        if(is_null($this->user) || !$this->user->can('notification.edit')) {
            return view('admin.error.denied');
        } else {
            $notificationTemplate = SmsNotificationTemplate::find($id);
            $notificationsTypes = SmsNotificationsType::all();
            return view('admin.sms.notification-template-edit',compact('notificationTemplate', 'notificationsTypes'));
        }
    }



    public function notificationTemplateUpdate(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.edit')) {
            return view('admin.error.denied');
        } else {
            SmsNotificationTemplate::notificationTemplateUpdateData($request);
            return redirect()->route('sms-notification.template')->with('success', 'Update Successfully !');
        }
    }


/*
     *
     * Notification Template API
     *
     *
     * */

    public function notificationTypeAjax(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.view')) {
            return view('admin.error.denied');
        } else {
            $notificationsTypes = SmsNotificationTemplate::where('notifications_type_id', $request->id)->select('message')->first();
            return response()->json($notificationsTypes);
        }
    }

}
