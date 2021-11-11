<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use View;
use Hash;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use App\Models\Offer;
use Validator;
use Image;


class OfferController extends Controller
{
    public function __construct()
    {
        $this->middleware(function($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }

	public function index(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('offer.view')) {
            return view('admin.error.denied');
        } else {
            $alloffer = Offer::orderBy('id','desc')->get();
            return view('admin.offer.index',compact('alloffer'));
        }
    }


    public function create()
    {
        if(is_null($this->user) || !$this->user->can('offer.create')) {
            return view('admin.error.denied');
        } else {
            $categories = Category::all();
            $subcategories = Subcategory::all();
            return view('admin.offer.create',compact('categories', 'subcategories'));
        }
    }

    public function store(Request $request)
    {
        if(is_null($this->user) || !$this->user->can('offer.create')) {
            return view('admin.error.denied');
        } else {
            $validated = $request->validate([
                // 'cat_id' => 'required|numeric',
                // 'subcat_id' => 'required|numeric',
                'name' => 'required|string|max:255',
                'image' => 'required|image'
            ],
            [
                // 'cat_id.required' => 'The Category Field is required', 
                // 'subcat_id.required' => 'The First Category Field is required', 
                'name.required' => 'The Name Field is required', 
                'image.required' => 'The Image Field is required', 
            ]);


            if ($request->hasFile('image')) {
                if($request->file('image')->isValid()) {
                    try {
                        $file = $request->file('image');
                        $savedFileName = 'image'.time() . '.jpg';
                        $savedFileNameWebp = 'image'.time() . '.webp';
                        //$request->file('thumb')->move("uploads/offer/", $savedFileName);

                        $pathLarge = 'uploads/offer/jpg/'.$savedFileName;
                        $this->imageResize($file,$pathLarge,$savedFileName, 1024, 317);

                        $pathLargeWebp = 'uploads/offer/webp/'.$savedFileNameWebp;
                        $this->imageResize($file,$pathLargeWebp,$savedFileNameWebp, 1024, 317);

                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
                }
            }
            else{
                $savedFileName = '';
            }


            $m = new Offer;
            $m->cat_id = $request->cat_id;
            $m->subcat_id = $request->subcat_id;
            $m->name = $request->name;
            $m->url = $request->url;
            $m->image = $savedFileName;
            $m->sequence = $request->sequence;
            $m->status = $request->status;
            $m->meta_details = $request->meta_details;
            $m->keywords = $request->keywords;
            $m->created_at = date('Y-m-d H:i:s');
            $m->updated_at = date('Y-m-d H:i:s');
            $m->save();

            session()->flash('success', 'The Offer has been created successfully!');
            return redirect('administration/offer');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit(Request $req, $id)
    {
        $offer = Offer::find($id);
        if($offer!=""){
            if(is_null($this->user) || !$this->user->can('offer.edit')) {
                return view('admin.error.denied');
            } else {
                // $cat_id = Offer::find($id)->cat_id;
                $categories = Category::all();

                $subcategories = Subcategory::all();
                // $subsubcategories = Subsubcategory::all();

                if ($req->has('cat_id')) {
                    $catids = $req->cat_id;
                    $subcatids = $req->subcat_id;
                    // $subsubcatids = $req->subsubcat_id;
                }
                else{
                    $catids = '';
                    $subcatids = '';
                    // $subsubcatids = '';
                }

                // $subsubcategory = Subsubcategory::find($id);
                // $catids = $subsubcategory->cat_id;
                // $subcatids = $subsubcategory->subcat_id;
                // $subsubcatids = $subsubcategory->subsubcat_id;

                $selectedCat = Category::find($catids);
                $selectedSubCat = Subcategory::find($subcatids);
                // $current_category = Category::find($cat_id)->first();
                // return view('admin.offer.edit',compact('offer','categories','current_category', 'selectedCat', 'selectedSubCat', 'subcatids', 'subsubcatids'));
                return view('admin.offer.edit',compact('offer','categories', 'selectedCat', 'selectedSubCat', 'subcatids'));
            }
        } else {
            abort(404);
        }

    }

    public function update(Request $request, $id)
    {
		$validated = $request->validate([
            // 'cat_id' => 'required|numeric',
            // 'subcat_id' => 'required|numeric',
            'name' => 'required|string|max:255',
            // 'image' => 'required|image'
        ],
        [
            // 'cat_id.required' => 'The Category Field is required', 
            // 'subcat_id.required' => 'The First Category Field is required', 
            'name.required' => 'The Name Field is required', 
            'image.required' => 'The Image Field is required', 
        ]);


		if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $file = $request->file('image');
                    $savedFileName = 'image_'.time() . '.jpg';
                    $savedFileNameWebp = 'image_'.time() . '.webp';
                    //$request->file('thumb')->move("uploads/offer/", $savedFileName);

					$pathLarge = 'uploads/offer/jpg/'.$savedFileName;
				    $this->imageResize($file,$pathLarge,$savedFileName, 1024, 317);

					$pathLargeWebp = 'uploads/offer/webp/'.$savedFileNameWebp;
				    $this->imageResize($file,$pathLargeWebp,$savedFileNameWebp, 1024, 317);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
              }
            }
        }
        else{
            $savedFileName = $request->stillthumb;
         }

        $offer = Offer::find($id);
        if($offer!=""){
            if(is_null($this->user) || !$this->user->can('offer.edit')) {
                return view('admin.error.denied');
            } else {
                $menuUpdate = array(
                    'cat_id'=>  $request->cat_id,
                    'subcat_id'=>  $request->subcat_id,
                    'name'=>  $request->name,
                    'url'=>  $request->url,
                    'image'=>  $savedFileName,
                    'sequence'=>  $request->sequence,
                    'status'=>  $request->status,
                    'meta_details'=>  $request->meta_details,
                    'keywords'=>  $request->keywords,
                    'updated_at'=> date('Y-m-d H:i:s')
                );
                $offer->update($menuUpdate);
                session()->flash('success', 'The Offer has been updated successfully!');
                return redirect('administration/offer');
                // print_r($request->subcat_id);
            }
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $menuItem = Offer::find($id);
        if($menuItem!=""){
            if(is_null($this->user) || !$this->user->can('offer.delete')) {
                return view('admin.error.denied');
            } else {
                $menuItem->delete();
                return redirect('administration/offer');
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
	}

	public function searchajax(Request $req)
    {
		$id=$req->id;
		$searchresults = DB::table('subcategories')->where('category_id', $id)->get();
			$displayvar = '<select name="subcat_id" class="form-control"><option value="">Select Category</option>';
				   foreach($searchresults as $rows):
						$displayvar .='<option value="'.$rows->id.'">'.$rows->name.'</option>';
					endforeach;
			$displayvar .= '</select>';
			echo $displayvar;
    }

}
