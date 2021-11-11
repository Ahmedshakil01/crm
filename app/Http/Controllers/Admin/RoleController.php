<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Administration;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DB;
use View;
use Hash;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use Validator;


class RoleController extends Controller
{
    public $user;
    //  public function __construct(Role $role)
    //  {
    //     $this->role = $role;
    //     $this->middleware('auth:administration');
    //  }
    public function __construct(Role $role)
    {
        $this->role = $role;
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }

	 public function index(Request $request)
     {
        if(is_null($this->user) || !$this->user->can('roles.view')) {
            return view('admin.error.denied');
        } else {
            $roles = $this->role::all();
            return view('admin.role.index', ['roles' => $roles]);
        }
     }


    public function create()
    {
        if(is_null($this->user) || !$this->user->can('roles.create')) {
            return view('admin.error.denied');
        } else {
            $allPermissions = Permission::all();
            $permissionGroup = Administration::getpermissionGroups();
            return view('admin.role.create', compact('allPermissions', 'permissionGroup'));
        }
    }

    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('roles.create')) {
           abort(403, 'Unauthorized Access');
        } else {
            // $validator = Validator::make($request->all(), [
            $validated = $request->validate([
                'name' => ['required', 'string', 'max:255', 'unique:roles'],
            ]);

            $role = new Role;
            $role->name = $request->name;
            $role->guard_name = 'administration';
            // $m->status = 1;
            $role->created_at = date('Y-m-d H:i:s');
            $role->updated_at = date('Y-m-d H:i:s');
            $role->save();

            // $role = DB::table('roles')->where('name', $request->name)->first();
            $permissions = $request->input('permissions');

            if(!empty($permissions)) {
                $role->syncPermissions($permissions);
            }

            return redirect('administration/role');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::findById($id, 'administration');
        if($role!=""){
            if(is_null($this->user) || !$this->user->can('roles.edit')) {
                return view('admin.error.denied');
            } else {
                $allPermissions = Permission::all();
                $permissionGroup = Administration::getpermissionGroups();
                return view('admin.role.edit',compact('role', 'allPermissions', 'permissionGroup'));
            }
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255', 'unique:roles,name,' .$id]
		]);

        $role = Role::findById($id, 'administration');
        if($role!=""){
            if(is_null($this->user) || !$this->user->can('roles.edit')) {
                return view('admin.error.denied');
            } else {
                $permissions = $request->input('permissions');

                if(!empty($permissions)) {
                    $role->name = $request->name;
                    $role->save();
                    $role->syncPermissions($permissions);
                }

                return redirect('administration/role');
            }
        }
        else{
            abort(404);
        }
    }

    public function destroy($id)
    {
        //if(is_null($this->user) || !$this->user->can('roles.delete')) {
//            abort(403, 'Unauthorized Access');
//        }
        $menuItem = Role::findById($id, 'administration');
        if($menuItem!=""){
            if(is_null($this->user) || !$this->user->can('roles.delete')) {
                return view('admin.error.denied');
            } else {
                $menuItem->delete();
                return redirect('administration/role');
            }
        }
        else{
            abort(404);
        }
    }



}