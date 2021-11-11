<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use View;
use App\Models\Campaign;
use App\Models\Subcampaign;
use Validator;
use Image;
use ImageOptimizer;

class SubcampaignController extends Controller
{
    public function __construct()
     {
        $this->middleware('auth:administration');
     }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
     {
	 	$allsubcampaigns = Subcampaign::all();
    	return view('admin.campaign_sub.index',compact('allsubcampaigns'));
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function activecampaign(Request $request)
    //  {
	//  	$allcampaigns = Campaign::where('status',1)->get();
    // 	return view('admin.campaign.index',compact('allcampaigns'));
    //  }


    public function create()
    {
        $campaigns = Campaign::where('status', 1)->get();
        return view('admin.campaign_sub.create', compact('campaigns'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255']
		]);

		if ($request->hasFile('thumb')) {
            if($request->file('thumb')->isValid()) {
                try {
                    $file = $request->file('thumb');
                    $savedFileName = 'thumb_'.time() . '.' . $file->getClientOriginalExtension();
					$pathLarge = 'uploads/subcampaign/'.$savedFileName;

				    $this->imageResize($file,$pathLarge,$savedFileName, 300, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = '';
         }


		if ($request->hasFile('banner')) {
            if($request->file('banner')->isValid()) {
                try {
                    $file = $request->file('banner');
                    $savedBannerName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();
				   $pathLarge = 'uploads/subcampaign/banner/'.$savedBannerName;
				   $this->imageBannerResize($file,$pathLarge,$savedBannerName, 1024, null);

                }
				catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }
        else{
            $savedBannerName = '';
         }
		 
		 
		$m = new Subcampaign;
		$m->name =  $request->name;
		$m->camp_id =  $request->campaign_id;
		$m->image =  $savedFileName;
		$m->coverphoto =  $savedBannerName;
		if($request->start_date!=""){
			$m->start_date = date('Y-m-d H:i:s',strtotime($request->start_date));
			$m->end_date = date('Y-m-d H:i:s',strtotime($request->end_date));
		}
		$m->status =  $request->status;
		$m->created_at = date('Y-m-d H:i:s');
        $m->updated_at = date('Y-m-d H:i:s');
        $m->save();

        return redirect('administration/campaign_sub');
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
        $subcampaign = Subcampaign::find($id);
		$campaigns = Campaign::all();
		$selectedcamp = Campaign::find($subcampaign->camp_id);
		
		if($selectedcamp!=""){
		  $campinfos = $selectedcamp->name;
		}
		else{
			$campinfos = '';
		}
        return view('admin.campaign_sub.edit',compact('subcampaign','campaigns','campinfos'));
    
		// $subcampaign = Subcampaign::find($id);
        // return view('admin.campaign_sub.edit',compact('subcampaign'));
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
		//dd($request->all());
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255']
		]);


		if ($request->hasFile('thumb')) {
            if($request->file('thumb')->isValid()) {
                try {
                    $file = $request->file('thumb');
                    $savedFileName = 'thumb_'.time() . '.' . $file->getClientOriginalExtension();
					$pathLarge = 'uploads/subcampaign/'.$savedFileName;
				    $this->imageResize($file,$pathLarge,$savedFileName, 300, 300);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }


		if ($request->hasFile('banner')) {
            if($request->file('banner')->isValid()) {
                try {
                    $file = $request->file('banner');
                    $savedBannerName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();
				   $pathLarge = 'uploads/subcampaign/banner/'.$savedBannerName;
				   $this->imageBannerResize($file,$pathLarge,$savedBannerName, 1024, null);

                }
				catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }
        else{
            $savedBannerName = $request->stillbanner;
         }
		 
		$m = Subcampaign::find($id);
		$arrayVal['name'] = $request->name;
		$arrayVal['camp_id'] = $request->camp_id;		
		
		if($request->start_date!=""){
			$arrayVal['start_date'] = date('Y-m-d H:i:s',strtotime($request->start_date));
		}
		if($request->end_date!=""){
			$arrayVal['end_date'] = date('Y-m-d H:i:s',strtotime($request->end_date));
		}
		
		$arrayVal['status'] =$request->status;
		$arrayVal['coverphoto'] = $savedBannerName;
		$arrayVal['image'] = $savedFileName;
		$arrayVal['updated_at'] =date('Y-m-d H:i:s');

		$m->update($arrayVal);
        return redirect('administration/campaign_sub');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menuItem = Subcampaign::find($id);
        $menuItem->delete();
        return redirect('administration/campaign_sub');
    }

    public function imageBannerResize($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
		ImageOptimizer::optimize($path);
	}

    public function imageResize($file, $path, $filename, $width, $height)
	{
		//$img = Image::make($file)->resize($width, $height)->save($path, $filename, 100);

		$img = Image::make($file);
		$img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });

		// if ($request->has('optimize')) {
			// ImageOptimizer::optimize($path);
		// }
        $img->resizeCanvas($width, $height, 'center', false, array(255, 255, 255, 0));
		$img->save($path);
		//dd($path);
		ImageOptimizer::optimize($path);
	}
}
