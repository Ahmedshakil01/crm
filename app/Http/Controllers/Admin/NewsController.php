<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use View;
use Hash;
use App\Models\News;
use App\Models\Subcategory;
use App\Models\Category;
use Validator;
use Image;


class NewsController extends Controller
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
        if(is_null($this->user) || !$this->user->can('news.view')) {
            return view('admin.error.denied');
        } else { 
            $allnews = News::orderBy('id','DESC')->get();
            return view('admin.news.index',compact('allnews'));
        }
     }


    public function create()
    {
        if(is_null($this->user) || !$this->user->can('news.create')) {
            return view('admin.error.denied');
        } else { 
            return view('admin.news.create');
        }
    }

    public function store(Request $request)
    {
		$validator = Validator::make($request->all(), [
			 'name' => ['required', 'string', 'max:255'],
             'image' => ['required', 'image'],
             'file' => ['required','max:10000','mimes:doc,docx,pdf']
		]);
        
        if(is_null($this->user) || !$this->user->can('news.create')) {
            return view('admin.error.denied');
        } else { 

            if ($request->hasFile('newsimages')) {
                if($request->file('newsimages')->isValid()) {
                    try {
                        $file = $request->file('newsimages');
                        $savedImageName = 'image_'.time() . '.' . $file->getClientOriginalExtension();

                        $pathLarge = 'uploads/news/image/'.$savedImageName;
                        $this->imageResize($file,$pathLarge,$savedImageName, 700, 350);

                    } catch (Illuminate\Filesystem\FileNotFoundException $e) {
                }
                }
            }
            else{
                $savedImageName = '';
            }


            if ($request->hasFile('newsfile')) {
                if($request->file('newsfile')->isValid()) {
                    try {
                        $file = $request->file('newsfile');
                        $savedFileName = 'files_'.time() . '.' . $file->getClientOriginalExtension();
                        $request->file('newsfile')->move("uploads/news/file/", $savedFileName);
                    }
                    catch (Illuminate\Filesystem\FileNotFoundException $e) {
                    }
                }
            }
            else{
                $savedFileName = '';
            }


            $m = new News;

            $expval=explode(' ',$request->name);
            $impval=implode('-',$expval);
            $slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"','?','&','$','@','*','(',')','&amp',''],'' , strtolower($impval));

            $m->postby = $request->postby;
            $m->publishdate = $request->publishdate;
            $m->name = $request->name;
            $m->slug = $slug;
            $m->image = $savedImageName;
            $m->file = $savedFileName;
            $m->details = $request->details;
            $m->meta_description = $request->meta_description;
            $m->keywords = $request->keywords;
            $m->sequence = 0;
            $m->status = 1;
            $m->entry_date = date('Y-m-d');
            $m->created_at = date('Y-m-d H:i:s');
            $m->updated_at = date('Y-m-d H:i:s');
            $m->save();

            return redirect('administration/news');
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

	  public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $news = News::find($id);
        if($news!=""){
            if(is_null($this->user) || !$this->user->can('news.edit')) {
                return view('admin.error.denied');
            } else {
                return view('admin.news.edit',compact('news'));
            }
        }
        else{
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['required', 'image'],
       ]);

       if ($request->hasFile('image')) {
            if($request->file('image')->isValid()) {
                try {
                    $img = $request->file('image');
                    $savedImageName = 'image_'.time() . '.' . $img->getClientOriginalExtension();
                    $pathLarge = 'uploads/news/image/'.$savedImageName;
                    $this->imageResize($img,$pathLarge,$savedImageName, 700, 350);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
            }
            }
        }
        else{
            $savedImageName = $request->stillimage;
        }

        if ($request->hasFile('file')) {
            if($request->file('file')->isValid()) {
                try {
                    $file = $request->file('file');
                    $savedFileName = 'file_'.time() . '.' . $file->getClientOriginalExtension();
                    $pathLarge = 'uploads/news/file/'.$savedFileName;
                    // $this->imageResize($file,$pathLarge,$savedFileName, 700, 350);

                } catch (Illuminate\Filesystem\FileNotFoundException $e) {
            }
            }
        }
        else{
            $savedFileName = $request->stillfile;
        }

        $m = News::find($id);
        if($m!=""){
            if(is_null($this->user) || !$this->user->can('news.edit')) {
                return view('admin.error.denied');
            } else {
                $expval=explode(' ',$request->name);
                $impval=implode('-',$expval);
                $slug = str_replace([',', "'",'"', '/','|'],'' , $impval);

                $arrayVal = array(
                    'postby'=> $request->postby,
                    'publishdate'=> $request->publishdate,
                    'name'=>$request->name,
                    'image'=>$savedImageName,
                    'file'=>$savedFileName,
                    'slug'=>$slug,
                    'details'=>$request->details,
                    'sequence'=>0,
                    'status'=>1,
                    'entry_date'=>date('Y-m-d'),
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s')
                );

                $m->update($arrayVal);
                return redirect('administration/news');
            }
        }
        else{
            abort(404);
        }
        
    }

    public function destroy($id)
    {
        $menuItem = News::find($id);
        if($menuItem!=""){
            if(is_null($this->user) || !$this->user->can('news.delete')) {
                return view('admin.error.denied');
            } else {
                $menuItem->delete();
                return redirect('administration/news');
            }
        }
        else{
            abort(404);
        }
    }
}
