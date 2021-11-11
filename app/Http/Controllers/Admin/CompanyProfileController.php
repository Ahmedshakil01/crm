<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;
use DB;

class CompanyProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }

    
    public function edit()
    {
        $company = CompanyProfile::first();
        if($company!=""){
            if(is_null($this->user) || !$this->user->can('comProfile.edit')) {
                return view('admin.error.denied');
            } else {
                return view('admin.company_profile.edit',compact('company'));
            }
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {

		//dd($id, $request->all());
        $this->validate($request, [
            'name' => 'required|string|max:255',
			'contact' => 'required|string|max:50',
			'email' => 'required|string|max:255',
			'currency' => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            if($request->file('logo')->isValid()) {
                try {
                    $file = $request->file('logo');
                    $savedLogoName = 'logo_'.time() . '.' . $file->getClientOriginalExtension();
                    //$request->file('thumb')->move("uploads/category/", $savedLogoName);

                    $pathLarge = 'uploads/companyprofile/logo/'.$savedLogoName;
                    $this->imageResize($file,$pathLarge,$savedLogoName, 150,150);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }
        else{
            $savedLogoName = $request->exist_logo;
        }
		
		
		 if ($request->hasFile('banner')) {
            if($request->file('banner')->isValid()) {
                try {
                    $file = $request->file('banner');
                    $savedBannerName = 'banner_'.time() . '.' . $file->getClientOriginalExtension();
                    //$request->file('thumb')->move("uploads/category/", $savedBannerName);

                    $pathLarge = 'uploads/companyprofile/banner/'.$savedBannerName;
                    $this->imageResize($file,$pathLarge,$savedBannerName, 1024,null);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }
        else{
            $savedBannerName = $request->exist_banner;
        }
		
		
		 if ($request->hasFile('icon')) {
            if($request->file('icon')->isValid()) {
                try {
                    $file = $request->file('icon');
                    $savedIconName = 'icon_'.time() . '.' . $file->getClientOriginalExtension();
                    //$request->file('thumb')->move("uploads/category/", $savedIconName);

                    $pathLarge = 'uploads/companyprofile/icon/'.$savedIconName;
                    $this->imageResize($file,$pathLarge,$savedIconName, 50,50);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
            }
        }
        else{
            $savedIconName = $request->exist_icon;
        }

        $company = CompanyProfile::find($id);
        if($company!=""){
            if(is_null($this->user) || !$this->user->can('comProfile.edit')) {
                return view('admin.error.denied');
            } else {
                $companyUpdate = array(
                    'name'=> $request->name,
                    'contact'=> $request->contact,
                    'hotline'=> $request->hotline,
                    'address'=> $request->address,
                    'email'=> $request->email,
                    'currency'=> $request->currency,
                    'state'=> $request->state,
					'city'=> $request->city,
					'area'=> $request->area,
					'zipcode'=> $request->zipcode,
					'country'=> $request->country,
					'date_format'=> $request->date_format,
					'language'=> $request->language,
					'time_setting'=> $request->time_setting,
                    'logo'=> $savedLogoName,
					'banner'=> $savedBannerName,
					'icon'=> $savedIconName,
                    'created_at'=> date('Y-m-d H:i:s'),
                    'updated_at'=> date('Y-m-d H:i:s')
                );

                $company->update($companyUpdate);
                return redirect()->back()->with('message','Successfully Updated');
            }
        } else {
            abort(404);
        }
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
        ImageOptimizer::optimize($path);
    }
	
	public function searchajax(Request $req)
    {
		if($req->keywords!="")
		{
		    $keywords=$req->keywords;
			$table=$req->table;
			$colid=$req->colid;
			$searchresults = DB::table($table)->where($colid, $keywords)->get();
			$displayvar = '';

			$displayvar .= '<select name="state" class="form-control">
			<option value="">State</option>';
						   foreach($searchresults as $rows):
								$displayvar .='<option value="'.$rows->id.'">'.$rows->name.'</option>';
							endforeach;
    			$displayvar .= '</select>';
    			echo $displayvar;
		}
		else{
			echo "Null";
		}
    }
}
