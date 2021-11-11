<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SourceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SourceTypeController extends Controller
{
    public function __construct()
    {
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
        if(is_null($this->user) || !$this->user->can('sourceType.view')) {
            return view('admin.error.denied');
        } else {
            $sourceTypes = SourceType::all();

            return view('admin.sourceType.index',compact('sourceTypes'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(is_null($this->user) || !$this->user->can('news.create')) {
            return view('admin.error.denied');
        } else {
            return view('admin.sourceType.create');
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
        if(is_null($this->user) || !$this->user->can('news.create')) {
            return view('admin.error.denied');
        } else {
/*
            $validator = Validator::make($request->all(), [
                'name' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['success' => false, 'errors' => $validator->errors(),], Response::HTTP_UNPROCESSABLE_ENTITY);
            }*/
            $sourceType = new SourceType();
            $sourceType->name = $request->name;
            $sourceType->save();
            return redirect('administration/sourceType');
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
        if(is_null($this->user) || !$this->user->can('news.edit')) {
            return view('admin.error.denied');
        } else {
            $sourceType = SourceType::find($id);
            return view('admin.sourceType.edit',compact('sourceType'));
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
        if(is_null($this->user) || !$this->user->can('news.edit')) {
            return view('admin.error.denied');
        } else {
            $sourceType = SourceType::find($id);
            $sourceType->name = $request->name;

            $sourceType->update();
            return redirect()->route('sourceType.index');
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
        $sourceType = SourceType::find($id);
        if($sourceType!=""){
            if(is_null($this->user) || !$this->user->can('customer.delete')) {
                return view('admin.error.denied');
            } else {
                $sourceType->delete();
                return redirect('administration/sourceType');
            }
        }
        else{
            abort(404);
        }
    }
}
