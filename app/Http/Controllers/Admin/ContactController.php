<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;
use View;
use Hash;
use App\Models\Contact;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use App\Models\LeadRating;
use App\Models\LeadIndustry;
use App\Models\District;
use App\Models\Area;
use App\Models\Division;
use Image;
use Mail;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
  public function __construct()
  {
    // $this->middleware('auth:administration');
    $this->middleware(function($request, $next) {
      $this->user = Auth::guard('administration')->user();
      return $next($request);
    });
  }

	public function index(Request $request)
  {
  	//dd($request);
    if(is_null($this->user) || !$this->user->can('news.view')) {
      return view('admin.error.denied');
    } else {		
		 $allcontactsource = Contact::orderBy('id','DESC')->get();
		  return view('admin.contact.index',compact('allcontactsource'));
	}
  }


  public function create()
  {
    if(is_null($this->user) || !$this->user->can('news.create')) {
      return view('admin.error.denied');
    } else {
		
		$contactsources = LeadSource::where('status','Display')->get();
		$contactstatus = LeadStatus::where('status','Display')->get();
		$contactrating = LeadRating::where('status','Display')->get();
		$contactindustry = LeadIndustry::where('status','Display')->get();
		$areas = Area::all();
		$division = Division::all();
		$districts = District::all();

      return view('admin.contact.create',compact('contactindustry','contactstatus','contactrating','contactsources','districts','areas', 'division'));
    }
  }

  public function store(Request $request)
  {
    if(is_null($this->user) || !$this->user->can('news.create')) {
      return view('admin.error.denied');
    } else {
    

          $validator = Validator::make($request->all(), [
            'company' => 'required|string',
            'contact' => 'required|string',
            'email' => 'required|string|unique:contacts,email',
        ]);
        if ($validator->fails()) {
          return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('photo')) {
            if ($request->file('photo')->isValid()) {
                try {
                  $file = $request->file('photo');
                    $savedImageName = 'leeds_' . time() . '.' . $file->getClientOriginalExtension();
                    $request->file('photo')->move("uploads/contacts/file/", $savedImageName);
                } catch (\Throwable $th) {
                  return redirect()->back()->with('error', 'Image Update failed');
                }
            }
        } else {
            $savedImageName = '';
        }
        
        $photo=['photo'=>$savedImageName];
        $allLeads=array_replace($request->all(),$photo);
        $result = Contact::create( $allLeads);

        if ($result) {
            return redirect('administration/contact');
        } else {
            return redirect()->back();
        }
    }
  }
	public function show($id)
  {
    //
  }


  public function edit($id)
  {
      $contact = Contact::find($id);
      $contactsources = LeadSource::where('status', 'Display')->get();
      $contactstatus = LeadStatus::where('status', 'Display')->get();
      $contactrating = LeadRating::where('status', 'Display')->get();
      $contactindustry = LeadIndustry::where('status', 'Display')->get();
      $areas = Area::all();
      $division = Division::all();
      $districts = District::all();

      if ($contact != "") {
          if (is_null($this->user) || !$this->user->can('news.edit')) {
              return view('admin.error.denied');
          } else {
              return view('admin.contact.edit', compact('contactindustry', 'contactstatus', 'contactrating', 'contactsources', 'districts', 'areas', 'division', 'contact'));
          }
      } else {
          abort(404);
      }
  }

  public function update(Request $request, $id)
    {

        $contact = Contact::find($id);
        if ($contact != "") {
            if (is_null($this->user) || !$this->user->can('news.edit')) {
                return view('admin.error.denied');
            } else {

                $validator = Validator::make($request->all(), [
                    'company' => 'required|string',
                    'contact' => 'required|string',
                    'email' => 'required|string|unique:contacts,email',
                ]);
                if ($validator->fails()) {
                  return redirect()->back()->withErrors($validator)->withInput();
                }

                if ($request->hasFile('photo')) {
                    if ($request->file('photo')->isValid()) {
                        try {
                            $file = $request->file('photo');
                            $savedImageName = 'leeds_' . time() . '.' . $file->getClientOriginalExtension();
                            $request->file('photo')->move("uploads/contacts/file/", $savedImageName);
                        } catch (\Throwable $th) {
                            return redirect()->back()->with('error', 'Image Update failed');
                        }
                    }
                } else {
                    $savedImageName = $contact->photo ?? ' ';
                }

                $photo = ['photo' => $savedImageName];
                $allLeads = array_replace($request->all(), $photo);
                $result = $contact->update($allLeads);

                if ($result) {
                    return redirect('administration/contact')->with('success', 'Successfully Update!');
                } else {
                    return redirect()->back()->with('error', 'Update Failed!');
                }
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



    public function contact_details($id)
    {
      if(is_null($this->user) || !$this->user->can('news.edit')) {
        return view('admin.error.denied');
      } else {
        $contact_info = Contact::with('quotes')->where('id', $id)->first();
       
        return view('admin.contact.details',compact('contact_info'));
      }
    }
   

}
