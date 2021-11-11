<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use Validator;

class PermissionController extends Controller
{
    public function __construct(Permission $permission)
    {
        $this->permission = $permission;
        // $this->middleware('auth:administration');
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(is_null($this->user) || !$this->user->can('permission.view')) {
            return view('admin.error.denied');
        } else {
            $permissions = $this->permission::all();
            // dd($permissions);
            return view('admin.permission.index', ['permissions' => $permissions]);
        }
    }

    // public function getPermission()
    // {
    //     $permissions = $this->permission::all();
    //     return response()->json([
    //         'permissions' => $permissions
    //     ], 200);
    // }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('permission.create')) {
            return view('admin.error.denied');
        } else {
            $groupList = Group::all();
            return view('admin.permission.create', compact('groupList'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('permission.create')) {
            return view('admin.error.denied');
        } else {
            $validator = Validator::make($request->all(), [
                'name' => ['required', 'string', 'max:255'],
                'group_name' => ['required'],
            ]);

            $prm = new Permission;
            $prm->name = $request->name;
            $prm->group_name = $request->group_name;
            $prm->created_at = date('Y-m-d H:i:s');
            $prm->updated_at = date('Y-m-d H:i:s');
            $prm->save();

            return redirect('administration/permission');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::find($id);
        if($permission!=""){
            if(is_null($this->user) || !$this->user->can('permission.edit')) {
                return view('admin.error.denied');
            } else {
                return view('admin.permission.edit',compact('permission'));
            }
        }
        else{
            abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'unique:permissions']
       ]);

       $permission = Permission::find($id);
        if($permission!=""){
            if(is_null($this->user) || !$this->user->can('permission.edit')) 
            {
                return view('admin.error.denied');
            } else {
                $permissionUpdate = array(
                    'name'=> $request->name,
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s')
                );
                $permission->update($permissionUpdate);
                return redirect('administration/permission');
            }
        }
        else{
            abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
