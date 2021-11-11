<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\District;
use App\Models\Division;
use App\Models\Lead;
use App\Models\LeadIndustry;
use App\Models\LeadRating;
use App\Models\LeadSource;
use App\Models\LeadStatus;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Image;
use Mail;

class LeadController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth:administration');
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('administration')->user();
            return $next($request);
        });
    }

    public function index(Request $request)
    {
        //dd($request);
        if (is_null($this->user) || !$this->user->can('news.view')) {
            return view('admin.error.denied');
        } else {
            $allleadsource = Lead::orderBy('id', 'DESC')->get();
            return view('admin.lead.index', compact('allleadsource'));
        }
    }

    public function create()
    {
        if (is_null($this->user) || !$this->user->can('news.create')) {
            return view('admin.error.denied');
        } else {

            $leadsources = LeadSource::where('status', 'Display')->get();
            $leadstatus = LeadStatus::where('status', 'Display')->get();
            $leadrating = LeadRating::where('status', 'Display')->get();
            $leadindustry = LeadIndustry::where('status', 'Display')->get();
            $areas = Area::all();
            $division = Division::all();
            $districts = District::all();

            return view('admin.lead.create', compact('leadindustry', 'leadstatus', 'leadrating', 'leadsources', 'districts', 'areas', 'division'));
        }
    }

    public function store(Request $request)
    {
		$userid = Auth::guard('administration')->user()->id;
        if (is_null($this->user) || !$this->user->can('news.create')) {
            return view('admin.error.denied');
        } else {

         
            $validator=Validator::make(request()->all(),[
                'company' => 'required|string',
				'contact' => 'required|string|max:255|unique:leads',
				'email' => 'email|max:255|unique:leads',
        
        
               ]);
        
               if ($validator->fails()) {
                  return redirect()->back()->withErrors($validator)->withInput();
                }

            if ($request->hasFile('photo')) {
                if ($request->file('photo')->isValid()) {
                    try {
                        $file = $request->file('photo');
                        $savedImageName = 'leeds_' . time() . '.' . $file->getClientOriginalExtension();
                        $request->file('photo')->move("uploads/leads/file/", $savedImageName);
                    } catch (\Throwable $th) {
                        return redirect()->back()->with('error', 'Image Update failed');
                    }
                }
            } else {
                $savedImageName = '';
            }

            $photo = ['photo' => $savedImageName, 'created_by' => $userid];
            $allLeads = array_replace($request->all(), $photo);
            $result = Lead::create($allLeads);

            if ($result) {
                return redirect('administration/lead');
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
        $lead = Lead::find($id);
        $leadsources = LeadSource::where('status', 'Display')->get();
        $leadstatus = LeadStatus::where('status', 'Display')->get();
        $leadrating = LeadRating::where('status', 'Display')->get();
        $leadindustry = LeadIndustry::where('status', 'Display')->get();
        $areas = Area::all();
        $division = Division::all();
        $districts = District::all();

        if ($lead != "") {
            if (is_null($this->user) || !$this->user->can('news.edit')) {
                return view('admin.error.denied');
            } else {
                return view('admin.lead.edit', compact('leadindustry', 'leadstatus', 'leadrating', 'leadsources', 'districts', 'areas', 'division', 'lead'));
            }
        } else {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
		$userid = Auth::guard('administration')->user()->id;
        $lead = Lead::find($id);
        if ($lead != "") {
            if (is_null($this->user) || !$this->user->can('news.edit')) {
                return view('admin.error.denied');
            } else {

                $validator = Validator::make($request->all(), [
                    'company' => 'required|string',
                    'contact' => 'required|string',
                    'email' => 'required|string',
                ]);
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                  }

                if ($request->hasFile('photo')) {
                    if ($request->file('photo')->isValid()) {
                        try {
                            $file = $request->file('photo');
                            $savedImageName = 'leeds_' . time() . '.' . $file->getClientOriginalExtension();
                            $request->file('photo')->move("uploads/leads/file/", $savedImageName);
                        } catch (\Throwable $th) {
                            return redirect()->back()->with('error', 'Image Update failed');
                        }
                    }
                } else {
                    $savedImageName = $lead->photo ?? ' ';
                }

                $photo = ['photo' => $savedImageName, 'updated_by' => $userid];
                $allLeads = array_replace($request->all(), $photo);
                $result = $lead->update($allLeads);

                if ($result) {
                    return redirect('administration/lead')->with('success', 'Successfully Update!');
                } else {
                    return redirect()->back()->with('error', 'Update Failed!');
                }
            }
        } else {
            abort(404);
        }
    }

    public function destroy($id)
    {
        $lead = Lead::find($id);
        if ($lead != "") {
            if (is_null($this->user) || !$this->user->can('news.delete')) {
                return view('admin.error.denied');
            } else {
                $lead->delete();
                return redirect('administration/lead');
            }
        } else {
            abort(404);
        }
    }

    public function searchajax(Request $req)
    {
        if ($req->keywords != "") {
            $keywords = $req->keywords;
            $table = $req->table;
            $colid = $req->colid;
            $searchresults = DB::table($table)->where($colid, $keywords)->get();
            $displayvar = '';
            $p1 = "'lastcatid'";
            $p2 = "'subcat_id'";
            $p3 = "'lastcategories'";

            if ($table == "subcategories") {
                $displayvar .= '<select name="subcat_id" class="form-control" onchange="ajaxSearch(this.value,' . $p1 . ',' . $p2 . ',' . $p3 . ')">';
            } else {
                $displayvar .= '<select name="lastcat_id" class="form-control">';
            }
            $displayvar .= '<option value="">Select Category</option>';
            foreach ($searchresults as $rows):
                $displayvar .= '<option value="' . $rows->id . '">' . $rows->name . '</option>';
            endforeach;
            $displayvar .= '</select>';
            echo $displayvar;
        } else {
            echo "Null";
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

    public function approvedAccount(Request $req)
    {
        $approve_val = $req->approve_val;
        $valuearray = explode(',', $approve_val);
        //dd($valuearray);
        $tablename = $req->tablename;
        $status = $req->status;

        $arrayuval = array(
            'status' => $status,
        );
        $updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

        $getSellerinfo = DB::table($tablename)->whereIn('id', $valuearray)->get();

        foreach ($getSellerinfo as $sellerinfo) {
            $smails = $sellerinfo->email;
            $snames = $sellerinfo->name;
            $data = array(
                "from" => 'support@aleshamart.com',
                "name" => $snames,
                "to" => $smails,
            );

            Mail::send('admin.mail.seller_account_confirm', $data, function ($message) use ($data) {
                $message->to($data['to'], $data['name']);
                $message->subject('Hi ' . $data['name'] . ', Welcome to Selling on aleshamart');
                $message->from($data['from'], "aleshamart");
            });
        }

        return redirect()->back();
    }

    public function lead_details($id)
    {
        if (is_null($this->user) || !$this->user->can('news.edit')) {
            return view('admin.error.denied');
        } else {
            $lead_info = Lead::where('id', $id)->first();

            return view('admin.lead.details', compact('lead_info'));
        }
    }
    public function total_orders($id)
    {
        $lead_info = Lead::where('id', $id)->first();
        $leadOrders = Order::where('lead_id', $id)->get();
        return view('admin.lead.total_order', compact('lead_info', 'leadOrders'));
    }
    public function unshipped_orders($id)
    {
        $lead_info = Lead::where('id', $id)->first();
        $leadOrders = Order::where('lead_id', $id)->where('status', 'Unshipped')->get();
        return view('admin.lead.unshipped_order', compact('lead_info', 'leadOrders'));
    }
    public function complete_orders($id)
    {
        $lead_info = Lead::where('id', $id)->first();
        $leadOrders = Order::where('lead_id', $id)->where('status', 'Delivered')->get();
        return view('admin.lead.complete_order', compact('lead_info', 'leadOrders'));
    }
    public function canceled_orders($id)
    {
        $lead_info = Lead::where('id', $id)->first();
        $leadOrders = Order::where('lead_id', $id)->where('status', 'Canceled')->get();
        return view('admin.lead.canceled_order', compact('lead_info', 'leadOrders'));
    }
    public function returned_orders($id)
    {
        $lead_info = Lead::where('id', $id)->first();
        $leadOrders = Order::where('lead_id', $id)->where('status', 'Returned')->get();
        return view('admin.lead.returned_order', compact('lead_info', 'leadOrders'));
    }

}
