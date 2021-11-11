<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Group;
use Validator;

class GroupController extends Controller
{
    public function __construct()
     {
        // $this->middleware('auth:administration');
        $this->middleware(function($request, $next) {
          $this->user = Auth::guard('administration')->user();
          return $next($request);
        });
      }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      if(is_null($this->user) || !$this->user->can('group.view')) {
        return view('admin.error.denied');
      } else {
	 	    $allgroup = Group::orderBy('id','DESC')->get();
    	  return view('admin.group.index',compact('allgroup'));
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
      if(is_null($this->user) || !$this->user->can('group.create')) {
        //    abort(403, 'Unauthorized Access');
        return view('admin.error.denied');
      } else {
        return view('admin.group.create');
      }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
      if(is_null($this->user) || !$this->user->can('group.create')) {
        //    abort(403, 'Unauthorized Access');
            return view('admin.error.denied');
      } else {
        $validator = Validator::make($request->all(), [
              'name' => ['required', 'string', 'max:255', 'unique:groups'],
        ]);

        $grp = new Group;
        $grp->name = $request->name;
        // $grp = $request->input('name');
        $grp->created_at = date('Y-m-d H:i:s');
        $grp->updated_at = date('Y-m-d H:i:s');
        $grp->save();

        return redirect('administration/group');
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
      
        $group = Group::find($id);
        if($group!=""){
          if(is_null($this->user) || !$this->user->can('group.edit')) {
            //    abort(403, 'Unauthorized Access');
            return view('admin.error.denied');
          } else {
            return view('admin.group.edit',compact('group'));
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
            'name' => ['required', 'string', 'max:255', 'unique:groups'],
        ]);

        $m = Group::find($id);
        if($m!=""){
            if(is_null($this->user) || !$this->user->can('group.edit')) {
              //    abort(403, 'Unauthorized Access');
              return view('admin.error.denied');
            } else {
              $m->name = $request->name;
              $m->update();
              return redirect('administration/group');
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
        $grp = Group::find($id);
        if($grp!=""){
          if(is_null($this->user) || !$this->user->can('group.delete')) {
            return view('admin.error.denied');
          } else {
            $grp->delete();
            return redirect('administration/group');
          }
        }
        else{
          abort(404);
        }
    }
}
