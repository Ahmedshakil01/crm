<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use App\Models\EmailTemplate;
use App\Models\EmailTemplateType;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class EmailTemplateController extends Controller
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
    public function emailTemplate() {

        if(is_null($this->user) || !$this->user->can('notification.view')) {
            return view('admin.error.denied');
        } else {
            $notificationTemplates = EmailTemplate::with('emailTemplateType')->get();
            return view('admin.email-marketing.email-template',compact('notificationTemplates'));
        }
    }

    public function createEmailTemplate() {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
            $notificationsTypes = EmailTemplateType::all();
            return view('admin.email-marketing.create-email-template', compact('notificationsTypes'));
        }
    }

    public function emailTemplateStore(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
           
            $validator = Validator::make($request->all(), [
                'message' => 'required',
                'nt_id' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors(),], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $eamilTemplate                  = new EmailTemplate();
            $eamilTemplate->message         = $request->message;
            $eamilTemplate->temp_type_id    = $request->nt_id;
            $eamilTemplate->save();
            return redirect('administration/email/template')->with('success', 'Created Successfully !');
        }
    }

    public function emailTemplateEdit($id) {
        if(is_null($this->user) || !$this->user->can('notification.edit')) {
            return view('admin.error.denied');
        } else {
            $notificationTemplate = EmailTemplate::find($id);
            $notificationsTypes = EmailTemplateType::all();
            return view('admin.email-marketing.email-template-edit',compact('notificationTemplate', 'notificationsTypes'));
        }
    }

    public function emailTemplateUpdate(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.edit')) {
            return view('admin.error.denied');
        } else {
            EmailTemplate::emailTemplateUpdateData($request);
            return redirect()->route('admin.email.template')->with('success', 'Update Successfully !');
        }
    }
}
