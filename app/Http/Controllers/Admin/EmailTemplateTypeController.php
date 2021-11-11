<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\EmailTemplateType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Validator;

class EmailTemplateTypeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:administration');
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }
    public function emailTemplateType() {
        
        if(is_null($this->user) || !$this->user->can('notification.view')) {
            return view('admin.error.denied');
        } else {
            $notificationsTypes = EmailTemplateType::all();
            return view('admin.email-marketing.email-template-type',compact('notificationsTypes'));
        }
    }

    public function createEmailTemplateType() {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
         return view('admin.email-marketing.create-template-type');
        }
    }

    public function storeEmailTemplateType(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.create')) {
            return view('admin.error.denied');
        } else {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors(),], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $templateType           = new EmailTemplateType();
            $templateType->name     = $request->name;
            $templateType->save();
            return redirect('administration/email-template/type')->with('success', 'Created Successfully !');
        }
    }

    public function emailTemplateTypeEdit($id) {
        if(is_null($this->user) || !$this->user->can('notification.edit')) {
            return view('admin.error.denied');
        } else {
            $notificationType = EmailTemplateType::find($id);
            return view('admin.email-marketing.template-type-edit',compact('notificationType'));
        }
    }

    public function emailTemplateTypeUpdate(Request $request) {
        if(is_null($this->user) || !$this->user->can('notification.edit')) {
            return view('admin.error.denied');
            } else {
            EmailTemplateType::emailTemplateTypeUpdateData($request);
            return redirect()->route('admin.email-template.type')->with('success', 'Update Successfully !');
            }
    }
}
