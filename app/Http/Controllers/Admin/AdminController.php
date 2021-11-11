<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use DB;
use Illuminate\Validation\Rule;
use View;
use Hash;
use App\Models\Customer;
use App\Models\Administration;
use App\Models\OthersIncome;
use App\Models\Expense;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Carbon\Carbon;
// use Auth;

class AdminController extends Controller
{
    //
    public function __construct()
    {
        // $this->middleware('auth:administration');
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }

    public function dashboard()
    {

		$totalCustomer = Customer::count();
		$monthlyCustomer = Customer::whereMonth('created_at', Carbon::now()->month)->count();
		$totalActiveCustomer = Customer::where('status',1)->count();
		$monthlyActiveCustomer = Customer::where('status',1)->whereMonth('created_at', Carbon::now()->month)->count();

    	return view('admin.dashboard',compact('totalCustomer','monthlyCustomer','totalActiveCustomer','monthlyActiveCustomer'));
    }

	public function index(Request $request)
    {
       if(is_null($this->user) || !$this->user->can('admin.view')) {
            return view('admin.error.denied');
       } else {
            $alladmins = Administration::all();
            return view('admin.administration.index',compact('alladmins'));
       }

    }

    public function create()
    {
       if(is_null($this->user) || !$this->user->can('admin.create')) {
        //    abort(403, 'Unauthorized Access');
            return view('admin.error.denied');
       } else {
            $roles = Role::orderBy('id','DESC')->get();
            return view('admin.administration.create', compact('roles'));
       }
    }

    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('admin.create')) {
        //    abort(403, 'Unauthorized Access');
            return view('admin.error.denied');
        } else {
            $this->validate($request, [
                'fullname' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:administrations'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:administrations'],
                'password' => ['required', 'string', 'min:6', 'confirmed'],
                'contact' => ['required','bd_mobile', 'unique:administrations'],
            ]);

            $m = new Administration;
            $m->fullname = $request->fullname;
            $m->username = $request->username;
            $m->email = $request->email;
            $m->contact = $request->contact;
            $m->designation = $request->designation;
            $m->role = $request->roles;
            $m->password = Hash::make($request->password);
            $m->password_hints = $request->password;
            $m->status = $request->status;
            $m->created_at = date('Y-m-d H:i:s');
            $m->updated_at = date('Y-m-d H:i:s');
            $m->save();

            if($request->roles) {
                $m->assignRole($request->roles);
            }

            return redirect('administration/admins')->with('success', 'Created Successfully');
        }
    }

	public function show($id)
    {
        //
    }

    public function edit($id)
    {
            $admin = Administration::find($id);
            $roles = Role::all();
            if($admin!=""){
                if(is_null($this->user) || !$this->user->can('admin.edit')) {
                    return view('admin.error.denied');
                } else {
                    return view('admin.administration.edit',compact('admin', 'roles'));
                }
            }
            else {
                abort(404);
            }
    }

    public function update(Request $request, $id)
    {
            $this->validate($request, [
                'fullname' => ['required', 'string', 'max:255'],
                'username' => ['required', 'string', 'max:255', 'unique:administrations,username,'.$id.',id'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:administrations,email,'.$id.',id'],
                'contact' => ['required','bd_mobile', 'unique:administrations,contact,'.$id.',id'],
            ]);

            $admins = Administration::find($id);
            if($admins!=""){
                if(is_null($this->user) || !$this->user->can('admin.edit'))
                {
                    return view('admin.error.denied');
                } else {

                    $menuUpdate = array(
                        'fullname'=> $request->fullname,
                        'username'=> $request->username,
                        'email'=> $request->email,
                        'contact'=> $request->contact,
                        'designation'=> $request->designation,
                        'role'=> $request->roles,
                        'status'=> $request->status,
                        'created_at'=> date('Y-m-d H:i:s'),
                        'updated_at'=> date('Y-m-d H:i:s')
                    );
                    //dd($menuUpdate);

                    $admins->update($menuUpdate);
                    // dd($admins);

                    $admins->roles()->detach();
                    if($request->roles) {
                        $admins->assignRole($request->roles);
                    }
                    return redirect('administration/admins')->with('success', 'Updated Successfully');
                }
            }
            else{
                abort(404);
            }
    }

    public function destroy(Request $request, $id)
    {
        $admin = Administration::find($id);
        if($admin!="")
        {
            if($request->user()->hasAnyRole(Role::whereIn('name', ['Super Admin'])->get())) {
                $admin->delete();
            } else {
                return view('admin.error.denied');
            }
            return redirect('administration/admins')->with('success', 'Deleted Successfully');
        }
        else{
            abort(404);
        }

    }


}
