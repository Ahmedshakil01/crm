<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menu;
use Auth;
use DB;
use App\Administration;
//use App\Traits\UniqueKeyGenerate;
use App\Product;
use App\ProductGallery;
use Redirect;

class CommonController extends Controller
{
	//use UniqueKeyGenerate;
   public function deletedata(Request $req)
    {
	    $id = $req->id;
		$deletetype = $req->deletetype;
		$deleteimage = $req->deleteimage;
		$tablename = $req->tablename;

		if($deletetype=='single'){
			//$menuItem = Administration::find($id)->delete();
			DB::table($tablename)->where('id', $id)->delete();
		}
		elseif($deletetype=='multiple'){
			//$menuItem = Administration::whereIn('id', $id)->delete();
			DB::table($tablename)->whereIn('id', $id)->delete();
		}
		 return $id;
    }

	public function permissionsCampaign(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'status'=>$status
		);
		DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);
		
		DB::table('campaign_sellers')->whereIn('campaign_id', $valuearray)->update($arrayuval);
		DB::table('campaign_products')->whereIn('campaign_id', $valuearray)->update($arrayuval);
		

        return Redirect::back();
    }
	
	public function permissionsTransaction(Request $req)
    {
		$status = $req->status;
		$valuearray = explode(',',$req->approve_val);
		
		foreach($valuearray as $k=>$val){
			$getUpdatedStatus = DB::table('transaction_histories')->where('id', $valuearray[$k])->first();
			$custid = $getUpdatedStatus->customer_id;
			$amount = $getUpdatedStatus->amount;
			if($getUpdatedStatus->status != $status){			
				
				 $arrayuval =  array(
					'status'=>$status
				);
				DB::table('transaction_histories')->where('id', $valuearray[$k])->update($arrayuval);		
				
				
				if($getUpdatedStatus->status=='Pending'){
					$customerBalanceCheck = DB::table('customer_balances')->where('customer_id',$custid)->first();
					
					if($customerBalanceCheck!=""){
						$customerBalance = array('customer_id'=>$custid,'balance'=>$customerBalanceCheck->balance + $amount);
						DB::table('customer_balances')->where('customer_id',$custid)->update($customerBalance);
					}
					else{
						$customerBalance = array('customer_id'=>$custid,'balance'=>$amount);
						DB::table('customer_balances')->insert($customerBalance);
					}
				}
				elseif($getUpdatedStatus->status=='Approved'){
					$customerBalanceCheck = DB::table('customer_balances')->where('customer_id',$custid)->first();
					
					if($customerBalanceCheck!=""){
						$customerBalance = array('customer_id'=>$custid,'balance'=>$customerBalanceCheck->balance - $amount);
						DB::table('customer_balances')->where('customer_id',$custid)->update($customerBalance);
					}
					else{
						$customerBalance = array('customer_id'=>$custid,'balance'=>0);
						DB::table('customer_balances')->insert($customerBalance);
					}
				}
			}
			
		}

        return Redirect::back();
    }
	
	
	public function permissions(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'status'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }
	
	public function adminPermissions(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		//dd($valuearray);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'active'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }



	public function changestatus(Request $req)
    {
		$approve_val = $req->approve_val;
		$valuearray = explode(',',$approve_val);
		$tablename = $req->tablename;
		$status = $req->status;

		 $arrayuval =  array(
			'member_type'=>$status
		);
		$updval = DB::table($tablename)->whereIn('id', $valuearray)->update($arrayuval);

         return Redirect::back();
    }



	public function getDistrict(Request $req)
    {
		if($req->divisoin_id!="")
		{
		
			 
		    $divisoin_id=$req->divisoin_id;
			$searchresults = DB::table('districts')->where('division_id', $divisoin_id)->get();
			$displayvar = '';
			$displayvar .= '<select name="district" class="form-control" onchange="getArea(this.value)">
			<option value="">District</option>';
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
	
	
	public function getArea(Request $req)
    {
		if($req->district_id!="")
		{
		    $district_id=$req->district_id;
			$searchresults = DB::table('upazilas')->where('district_id', $district_id)->get();
			$displayvar = '';
			$displayvar .= '<select name="area" class="form-control">
			<option value="">Area</option>';
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
	
	
	public function updateSlug(Request $req)
    {
		
	//////////////// Update Slug /////////////////
		/*$allDatas = DB::table('products')->get();
		foreach($allDatas as $datas){
				$occasionid = $datas->id;
				$expval=explode(' ',$datas->name);
				$impval=implode('-',$expval);
				$slug = str_replace([',', "'",'"', '/','|',"'","`"],'' , strtolower($impval));
				
				$arrayvals = array('slug'=>$slug);
				DB::table('products')->where('id',$occasionid)->update($arrayvals);
			
		}*/
		
		
		
		
	/*//////////////// Update Quantity /////////////////
		$allDatas = DB::table('products')->get();
		foreach($allDatas as $datas){				
			$productid = $datas->id;
			$arrayvals = array('minQty'=>1);
			$updated = DB::table('products')->where('id',$productid)->update($arrayvals);				
		}	
		
		if($updated){
			echo 'Successfully updated';
		}
		else{
			echo 'Failed';
		}*/
		
		
		
		
		//////////////// Update discount amount /////////////////
		/*$allDatas = DB::table('product_inventories')->get();
		foreach($allDatas as $datas){				
			$productid = $datas->id;
			$discount = $datas->discount;
            $dis_type = $datas->discount_type;
            $unitprice = $datas->unit_price;

            if($discount!=""){
                if($dis_type=='Tk'){
                    $discountamount = $unitprice - $discount;
                }
                elseif($dis_type=='%'){
                    $disPer = ($unitprice*$discount)/100;
                    $discountamount = $unitprice - $disPer;
                }
            }
            else{
                $discountamount = 0;
                $dis_type = '';
            }
			
			
			$arrayvals = array('discount_amount'=>$discountamount);
			$updated = DB::table('product_inventories')->where('id',$productid)->update($arrayvals);				
		}	
		
		if($updated){
			echo 'Successfully updated';
		}
		else{
			echo 'Failed';
		}*/
		
		
		
		//////////////// Update Product category slug /////////////////
		//$allDatas = DB::table('products')->get();
		//$allDatas = DB::table('lastcategories')->get();
		//$allDatas = DB::table('subsubcategories')->get();
		//$allDatas = DB::table('subcategories')->get();
		/*$allDatas = DB::table('categories')->get();
		foreach($allDatas as $datas){
				$occasionid = $datas->id;
				$expval=explode(' ',$datas->name);
				$impval=implode('-',$expval);
				$slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"','?','&','$','@','*','(',')','&amp','(',')',':',''],'' , strtolower($impval));
						
				$arrayvals = array('slug'=>$slug);
				//DB::table('products')->where('id',$occasionid)->update($arrayvals);
				//DB::table('lastcategories')->where('id',$occasionid)->update($arrayvals);
				//DB::table('subsubcategories')->where('id',$occasionid)->update($arrayvals);
				//DB::table('subcategories')->where('id',$occasionid)->update($arrayvals);
				DB::table('categories')->where('id',$occasionid)->update($arrayvals);
		}*/
		
		
		
		//////////////// Update Product category slug /////////////////
		$allDatas = DB::table('products')->get();
		//$allDatas = DB::table('lastcategories')->get();
		//$allDatas = DB::table('subsubcategories')->get();
		//$allDatas = DB::table('subcategories')->get();
		//$allDatas = DB::table('categories')->get();
		foreach($allDatas as $datas){
				$occasionid = $datas->id;
				$expval=explode(' ',$datas->slug);
				$impval=implode('-',$expval);
				$slug = str_replace('--','-' , strtolower($impval));
						
				$arrayvals = array('slug'=>$slug);
				DB::table('products')->where('id',$occasionid)->update($arrayvals);
				//DB::table('lastcategories')->where('id',$occasionid)->update($arrayvals);
				//DB::table('subsubcategories')->where('id',$occasionid)->update($arrayvals);
				//DB::table('subcategories')->where('id',$occasionid)->update($arrayvals);
				//DB::table('categories')->where('id',$occasionid)->update($arrayvals);
		}
		

		//////////////// Update Inventories /////////////////

		/*$allDatas = DB::table('product_inventories')->get();
		foreach($allDatas as $datas){

			$arrayvals = array(
				'product_id'=>$datas->product_id,
				'initial_qty'=>$datas->initial_qty,
				'initial_price'=>$datas->unit_price,
				'increment_qty'=>0,
				'decrement_qty'=>0,
				'current_qty'=>$datas->initial_qty,
				'purchase_price'=>$datas->purchase_price,
				'sell_price'=>$datas->sell_price,
				'created_at'=>date('Y-m-d H:i:s'),
				'updated_at'=>date('Y-m-d H:i:s')
			);

			DB::table('inventories')->insert($arrayvals);
		}*/
	}
	

}
