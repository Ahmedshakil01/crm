<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Auth;
use DB;
use App\Models\Administration;
//use App\Models\Traits\UniqueKeyGenerate;
use App\Models\Product;
use App\Models\ProductGallery;
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
	
	public function permissionsBlog(Request $req)
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
		
		
		/*$allDatas = DB::table('gift_card_formats')->whereIn('id',array(5,6))->get();
		foreach($allDatas as $datas){
			$occasionid = $datas->id;
			//echo $occasionid;
			$allSubDatas = DB::table('gift_card_themes1')->get();
			foreach($allSubDatas as $sdatas){
				$expval=explode(' ',$sdatas->name);
				$impval=implode('-',$expval);
				$slug = str_replace([',', "'",'"', '/','|',"'","`"],'' , strtolower($impval));
				
				$arrayvals = array('name'=>$sdatas->name,'slug'=>$slug,'format'=>$occasionid);
				DB::table('gift_card_themes')->insert($arrayvals);
			}
			
		}*/
		
		/*$allDatas = DB::table('gift_card_occasions')->where('id','!=',2)->get();
		foreach($allDatas as $datas){
			$occasionid = $datas->id;
			
			$allSubDatas = DB::table('gift_card_sub_occasions1')->get();
			foreach($allSubDatas as $sdatas){
				$expval=explode(' ',$sdatas->name);
				$impval=implode('-',$expval);
				$slug = str_replace([',', "'",'"', '/','|',"'","`"],'' , strtolower($impval));
				
				$arrayvals = array('name'=>$sdatas->name,'slug'=>$slug,'occasion_id'=>$occasionid);
				DB::table('gift_card_sub_occasions')->insert($arrayvals);
			}
			
		}*/
		
	/*	$allDatas = DB::table('shipment_confirms')->get();
		foreach($allDatas as $datas){
			$orderid = $datas->order_id;
			$ship_date = $datas->ship_date;
			$updated_at = $datas->updated_at;
			
			$arrayvals = array('ship_date'=>$ship_date,'delivery_date'=>$ship_date,'updated_at'=>$updated_at);

			DB::table('orders')->where('id', $orderid)->update($arrayvals);
			DB::table('order_payments')->where('order_id', $orderid)->update($arrayvals);
		}
		*/
		
		
		/*$allDatas = DB::table('gift_cards')->get();
		foreach($allDatas as $datas){
			$delivery_type = $datas->delivery_type;
			$product_id = $datas->product_id;
			
			$arrayvals = array('delivery_type'=>$delivery_type);

			DB::table('products')->where('id', $product_id)->update($arrayvals);
		}*/
		
		/*$allDatas = DB::table('products')->where('id','>',2091)->get();
		
		//dd(count($allDatas));
		foreach($allDatas as $datas){
			$product_id = $datas->id;
			
			$arrayvals = array('product_id'=>$product_id,'initial_qty'=>5,'current_qty'=>10);

			DB::table('inventories')->insert($arrayvals);
		}*/
		
		
		/*$allDatas = DB::table('categories')->get();
		foreach($allDatas as $datas){
				$occasionid = $datas->id;
				$expval=explode(' ',$datas->name);
				$impval=implode('-',$expval);
				$slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"','?','&','$','@','*'],'' , strtolower($impval));
				
				$arrayvals = array('slug'=>$slug);
				DB::table('categories')->where('id',$occasionid)->update($arrayvals);
				
				
				$expval=explode('--',$datas->slug);
				$impval=implode('-',$expval);
				
				$arrayvals1 = array('slug'=>$impval);
				DB::table('categories')->where('id',$occasionid)->update($arrayvals1);
			
		}*/
		
		
		
		$allDatas = DB::table('products')->get();
		foreach($allDatas as $datas){
				$occasionid = $datas->id;
				$expval=explode(' ',$datas->name);
				$impval=implode('-',$expval);
				$slug = str_replace([',', "'",'"', '/','|','.','`','%','#','"','?','&','$','@','*','(',')','&amp','(',')',':',''],'' , strtolower($impval));
						
				$arrayvals = array('slug'=>$slug);
				DB::table('products')->where('id',$occasionid)->update($arrayvals);
		}
	}
	
	
	private function getToken($length){    
        $token = "";
        $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvqxyz";
        $codeAlphabet.= "0123456789";

       // mt_srand($seed);      // Call once. Good since $application_id is unique.
	   mt_srand(time());

        for($i=0;$i<$length;$i++){
            $token .= $codeAlphabet[mt_rand(0,strlen($codeAlphabet)-1)];
        }
        return $token;
    }
	

/////////////////////////////////////// Image name changes areas /////////////////////////////////////////////////////////


///////////////////////////////////////JPG Image name and database changes areas /////////////////////////////////////////////////////////


	public function imageNameProcess($image, $name, $code)
    {
        $url = parse_url($image);
        $ext  = pathinfo($url['path'], PATHINFO_EXTENSION);
        $NewName = strtolower($this->clean($name))."-".$code.".".$ext;
		return $NewName;
    }
	
	
	public function changeFolderImage()
    {	
		$query = Product::select('id', 'name', 'slug', 'code','mainimage');			
		$products = $query->get();

        foreach ($products as $key => $product) {
            $mainimage = $product->mainimage;
			$imageUpdate = Product::where('id', $product->id)->first();
			
			$newImageName = $this->imageNameProcess($mainimage, $product->name, $product->code);
			$imageUpdate->mainimage = $newImageName;
			$imageUpdate->update();
			
			
			/*echo $jpgLarg = 'uploads/product/large/jpg/'.$mainimage;
            $jpgMdum = 'uploads/product/mediumthumb/jpg/'.$mainimage;
            $jpgtuml = 'uploads/product/thumnail/jpg/'.$mainimage;	
			
			$jpgLargdoc = 'uploads/product/large/jpg/';
            $jpgMdumdoc = 'uploads/product/mediumthumb/jpg/';
            $jpgtumldoc = 'uploads/product/thumnail/jpg/';	
			
			$webpLarg = 'uploads/product/large/webp/'.$mainimage;
            $webpMdum = 'uploads/product/mediumthumb/webp/'.$mainimage;
            $webptuml = 'uploads/product/thumnail/webp/'.$mainimage;	
			
			$webpLargdoc = 'uploads/product/large/webp/';
            $webpMdumdoc = 'uploads/product/mediumthumb/webp/';
            $webptumldoc = 'uploads/product/thumnail/webp/';
			echo '<br>';	 					
			echo $newImageName = $this->imageNameProcess($jpgLarg, $product->name, $product->code);	
			echo '<br>';echo '<br>';
			
			
			if (file_exists($jpgLarg)) {
				rename($jpgLarg, $jpgLargdoc.$newImageName);
			 }*/
			 
			/*if (file_exists($jpgMdum)) {
				rename($jpgMdum, $jpgMdumdoc.$newImageName);
			 }
			if (file_exists($jpgtuml)) {
				rename($jpgtuml, $jpgtumldoc.$newImageName);
			 }*/
			 
			 
			/*if (file_exists($webptuml)) {
				rename($webptuml, $webptumldoc.$newImageName);
			}*/
			
			/*if (file_exists($webpMdum)) {
				rename( $webpMdum, $webpMdumdoc.$newImageName);
			}
			
			if (file_exists($webpLarg)) {
				rename($webpLarg, $webpLargdoc.$newImageName);
			}*/
			
			/* if (file_exists($jpgLarg)) {
			 	if(rename($jpgLarg, $jpgLargdoc.$newImageName)){
					//$imageUpdate->mainimage = $newImageName;
				}
			 }
			 
			  if (file_exists($jpgtuml)) {
				if(rename($jpgtuml, $jpgtumldoc.$newImageName)){
					//$imageUpdate->mainimage = $newImageName;
				}
			 }
			 
			 if (file_exists($jpgMdum)) {
			 	if(rename($jpgMdum, $jpgMdumdoc.$newImageName)){
					//$imageUpdate->mainimage = $newImageName;
				}
			 }
			 */
		}
    }
	
	
	
	public function changeMainImageName($types)
    {	
		$query = Product::select('id', 'name', 'slug', 'code','mainimage');		
		if($types=='new'){
			$query->where('mainimage', 'like', 'mainimage_products_%');  
		}
		elseif($types=='edit'){
			$query->where('mainimage', 'like', 'edit_mainimage_products_%');
		}
		else{
			$null = 'null';
		}    		    
		
		$products = $query->get();

        foreach ($products as $key => $product) {
            $mainimage = $product->mainimage;
            $jpgLarg = 'uploads/product/large/jpg/'.$mainimage;
            $jpgMdum = 'uploads/product/mediumthumb/jpg/'.$mainimage;
            $jpgtuml = 'uploads/product/thumnail/jpg/'.$mainimage;	
			//echo '<br>';		

			$ext = 'jpg';
            
			$imageUpdate = Product::where('id', $product->id)->first();

            if (file_exists($jpgLarg)) {
                $jpgLargdoc = 'uploads/product/large/jpg/';
                $jpgLarguNewName = $this->imageProcess($jpgLarg, $ext, $product->name, $product->code);
				
                if(strlen($jpgLarguNewName) > 200){
                    $jpgLarguNewName = substr($jpgLarguNewName, 100);
                    echo $jpgLarguNewName . "<br><br>";
                } else {
                    echo $jpgLarguNewName . "<br><br>";
                }
                if(rename( $jpgLarg, $jpgLargdoc.$jpgLarguNewName)){
                    $imageUpdate->mainimage = $jpgLarguNewName;
                }
            }

            if (file_exists($jpgMdum)) {
                $jpgMdumdoc = 'uploads/product/mediumthumb/jpg/';
                $jpgMdumuNewName = $this->imageProcess($jpgMdum, $ext, $product->name, $product->code);

                if(strlen($jpgMdumuNewName) > 200){
                    $jpgMdumuNewName = substr($jpgMdumuNewName, 100);
                    echo $jpgMdumuNewName . "<br><br>";
                } else {
                    echo $jpgMdumuNewName . "<br><br>";
                }
                if(rename( $jpgMdum, $jpgMdumdoc.$jpgMdumuNewName)){
                    $imageUpdate->mainimage = $jpgMdumuNewName;
                }
            }

            if (file_exists($jpgtuml)) {
                $jpgtumldoc = 'uploads/product/thumnail/jpg/';
                $jpgtumluNewName = $this->imageProcess($jpgtuml, $ext, $product->name, $product->code);

                if(strlen($jpgtumluNewName) > 200){
                    $jpgtumluNewName = substr($jpgtumluNewName, 100);
                    echo $jpgtumluNewName . "<br><br>";
                } else {
                    echo $jpgtumluNewName . "<br><br>";
                }
                if(rename( $jpgtuml, $jpgtumldoc.$jpgtumluNewName)){
                    $imageUpdate->mainimage = $jpgtumluNewName;
                }
            }
			
			$imageUpdate->update();

        }
    }


	public function changeMainWebpImageName($types)
    {	
		$query = Product::select('id', 'name', 'slug', 'code','mainimage');		
		if($types=='new'){
			$query->where('mainimage', 'like', 'mainimage_products_%');  
		}
		elseif($types=='edit'){
			$query->where('mainimage', 'like', 'edit_mainimage_products_%');
		}
		else{
			$null = 'null';
		}    		    
		
		$products = $query->get();

        foreach ($products as $key => $product) {
            $mainimage = $product->mainimage;
            $webpLarg = 'uploads/product/large/webp/'.$mainimage;
            $webpMdum = 'uploads/product/mediumthumb/webp/'.$mainimage;
            $webptuml = 'uploads/product/thumnail/webp/'.$mainimage;			
				
			$ext = 'webp';
            $imageUpdate = Product::where('id', $product->id)->first();

            if (file_exists($webpLarg)) {
                $webpLargdoc = 'uploads/product/large/webp/';
                $webpLarguNewName = $this->imageProcess($webpLarg, $ext, $product->name, $product->code);
				
                if(strlen($webpLarguNewName) > 200){
                    $webpLarguNewName = substr($webpLarguNewName, 100);
                    echo $webpLarguNewName . "<br><br>";
                } else {
                    echo $webpLarguNewName . "<br><br>";
                }
                if(rename( $webpLarg, $webpLargdoc.$webpLarguNewName)){
                    $imageUpdate->mainimage = $webpLarguNewName;
                }
            }

            if (file_exists($webpMdum)) {
                $webpMdumdoc = 'uploads/product/mediumthumb/webp/';
                $webpMdumuNewName = $this->imageProcess($webpMdum, $ext, $product->name, $product->code);

                if(strlen($webpMdumuNewName) > 200){
                    $webpMdumuNewName = substr($webpMdumuNewName, 100);
                    echo $webpMdumuNewName . "<br><br>";
                } else {
                    echo $webpMdumuNewName . "<br><br>";
                }
                if(rename( $webpMdum, $webpMdumdoc.$webpMdumuNewName)){
                    $imageUpdate->mainimage = $webpMdumuNewName;
                }
            }

            if (file_exists($webptuml)) {
                $webptumldoc = 'uploads/product/thumnail/webp/';
                $webptumluNewName = $this->imageProcess($webptuml, $ext, $product->name, $product->code);

                if(strlen($webptumluNewName) > 200){
                    $webptumluNewName = substr($webptumluNewName, 100);
                    echo $webptumluNewName . "<br><br>";
                } else {
                    echo $webptumluNewName . "<br><br>";
                }
                if(rename( $webptuml, $webptumldoc.$webptumluNewName)){
                    $imageUpdate->mainimage = $webptumluNewName;
                }
            }
			
			 $imageUpdate->update();

        }
    }
	
/*public function changeMainWebpImageName($types)
    {
		$query = Product::select('id', 'name', 'slug', 'code','mainimage');
		if($types=='new'){
			$query->where('mainimage', 'like', 'mainimage_products_%');  
		}
		elseif($types=='edit'){
			$query->where('mainimage', 'like', 'edit_mainimage_products_%');
		}
		else{
			$null = 'null';
		}    
		     
		
		$products = $query->get();
       

        foreach ($products as $key => $product) {
            $mainimage = $product->mainimage;
             
			 $url = parse_url($mainimage);
		     $imgname = pathinfo($url['path'], PATHINFO_FILENAME);
			 $ext  = pathinfo($url['path'], PATHINFO_EXTENSION);
			 
            $webpLarg = 'uploads/product/large/webp/'.$imgname.'.webp';
            $webpMdum = 'uploads/product/mediumthumb/webp/'.$imgname.'.webp';
            $webptuml = 'uploads/product/thumnail/webp/'.$imgname.'.webp';
			$ext = 'webp';
			//dd($webptuml);
			 $imageUpdate = Product::where('id', $product->id)->first();
             if (file_exists($webpLarg)) {
                $webpLargdoc = 'uploads/product/large/webp/';
                $webpLargNewName = $this->imageProcess($webpLarg, $ext, $product->name, $product->code);

               // echo $product->id . "<br><br>";
                //echo $webpLarg . "<br><br>";
                if(strlen($webpLargNewName) > 200){
                    $webpLargNewName = substr($webpLargNewName, 100);
                    echo $webpLargNewName . "<br><br>";
                } else {
                    echo $webpLargNewName . "<br><br>";
                }
              
			    if( rename( $webpLarg, $webpLargdoc.$webpLargNewName)){
                    $imageUpdate->mainimage = $webpLargNewName;
                }				
            }

            if (file_exists($webpMdum)) {
                $webpMdumdoc = 'uploads/product/mediumthumb/webp/';
                $webpMdumNewName = $this->imageProcess($webpMdum, $ext, $product->name, $product->code);

                if(strlen($webpMdumNewName) > 200){
                    $webpMdumNewName = substr($webpMdumNewName, 100);
                    echo $webpMdumNewName . "<br><br>";
                } else {
                    echo $webpMdumNewName . "<br><br>";
                }
               
			    if(rename( $webpMdum, $webpMdumdoc.$webpMdumNewName)){
                    $imageUpdate->mainimage = $webpMdumNewName;
                }	
            }

            if (file_exists($webptuml)) {
                $webptumldoc = 'uploads/product/thumnail/webp/';
                $webptumlNewName = $this->imageProcess($webptuml, $ext, $product->name, $product->code);

                if(strlen($webptumlNewName) > 200){
                    $webptumlNewName = substr($webptumlNewName, 100);
                    echo $webptumlNewName . "<br><br>";
                } else {
                    echo $webptumlNewName . "<br><br>";
                }
                
				 if(rename( $webptuml, $webptumldoc.$webptumlNewName)){
                    $imageUpdate->mainimage = $webptumlNewName;
                }
            }
			
			 $imageUpdate->update();
        }
    }*/


/////////////////////// Gallery Images///////////////////
	
	public function changeGalleryImageName()
    {		
		$query = ProductGallery::select('id', 'product_id','image');
			$query->where('image', 'like', 'products0_%');  
			for($i=0; $i<=100; $i++){
				$query->orWhere('image', 'like', 'products'.$i.'_%');  
			}				    
		
		$products = $query->get();	
		
        foreach ($products as $key => $product) {
			$querypro = Product::select('id', 'name', 'code')->where('id',$product->id)->first();
			if($querypro!=""){
				$pname = $querypro->name;
				$pcode = $querypro->code;
				$pgid = $querypro->id;				
				$mainimage = $product->image;
				$jpgLarg = 'uploads/product/large/jpg/'.$mainimage;
				$jpgMdum = 'uploads/product/mediumthumb/jpg/'.$mainimage;
				$jpgtuml = 'uploads/product/thumnail/jpg/'.$mainimage;			
	
				$ext = 'jpg';
				$imageUpdate = ProductGallery::where('id', $product->id)->first();
	
				if (file_exists($jpgLarg)) {
					$jpgLargdoc = 'uploads/product/large/jpg/';
					$jpgLarguNewName = $this->imageProcessGallery($jpgLarg, $ext, $pname, $pcode, $pgid);
					
					if(strlen($jpgLarguNewName) > 200){
						$jpgLarguNewName = substr($jpgLarguNewName, 100);
						echo $jpgLarguNewName . "<br><br>";
					} else {
						echo $jpgLarguNewName . "<br><br>";
					}
					if(rename( $jpgLarg, $jpgLargdoc.$jpgLarguNewName)){
						$imageUpdate->image = $jpgLarguNewName;
					}
				}
	
				if (file_exists($jpgMdum)) {
					$jpgMdumdoc = 'uploads/product/mediumthumb/jpg/';
					$jpgMdumuNewName = $this->imageProcessGallery($jpgMdum, $ext, $pname, $pcode, $pgid);
	
					if(strlen($jpgMdumuNewName) > 200){
						$jpgMdumuNewName = substr($jpgMdumuNewName, 100);
						echo $jpgMdumuNewName . "<br><br>";
					} else {
						echo $jpgMdumuNewName . "<br><br>";
					}
					if(rename( $jpgMdum, $jpgMdumdoc.$jpgMdumuNewName)){
						$imageUpdate->image = $jpgMdumuNewName;
					}
				}
	
				if (file_exists($jpgtuml)) {
					$jpgtumldoc = 'uploads/product/thumnail/jpg/';
					$jpgtumluNewName = $this->imageProcessGallery($jpgtuml, $ext, $pname, $pcode, $pgid);
	
					if(strlen($jpgtumluNewName) > 200){
						$jpgtumluNewName = substr($jpgtumluNewName, 100);
						echo $jpgtumluNewName . "<br><br>";
					} else {
						echo $jpgtumluNewName . "<br><br>";
					}
					if(rename( $jpgtuml, $jpgtumldoc.$jpgtumluNewName)){
						$imageUpdate->image = $jpgtumluNewName;
					}
				}
				
				 $imageUpdate->update();
	
			}
		}
    }
	
	
	
	
	
	public function changeGalleryImageNameWebp()
    {		
		$query = ProductGallery::select('id', 'product_id','image');
			$query->where('image', 'like', 'products0_%');  
			for($i=0; $i<=100; $i++){
				$query->orWhere('image', 'like', 'products'.$i.'_%');  
			}				    
		
		$products = $query->get();	
		
        foreach ($products as $key => $product) {
			$querypro = Product::select('id', 'name', 'code')->where('id',$product->id)->first();
			if($querypro!=""){
				$pname = $querypro->name;
				$pcode = $querypro->code;
				$pgid = $querypro->id;				
				$mainimage = $product->image;
				
				$url = parse_url($mainimage);
		    	$imgname = pathinfo($url['path'], PATHINFO_FILENAME);
			 	$ext  = pathinfo($url['path'], PATHINFO_EXTENSION);
			 
				$jpgLarg = 'uploads/product/large/webp/'.$imgname.'.webp';
				$jpgMdum = 'uploads/product/mediumthumb/webp/'.$imgname.'.webp';
				$jpgtuml = 'uploads/product/thumnail/webp/'.$imgname.'.webp';	
	
				$ext = 'webp';
	
				if (file_exists($jpgLarg)) {
					$jpgLargdoc = 'uploads/product/large/webp/';
					$jpgLarguNewName = $this->imageProcessGallery($jpgLarg, $ext, $pname, $pcode, $pgid);
					
					if(strlen($jpgLarguNewName) > 200){
						$jpgLarguNewName = substr($jpgLarguNewName, 100);
						echo $jpgLarguNewName . "<br><br>";
					} else {
						echo $jpgLarguNewName . "<br><br>";
					}
					rename( $jpgLarg, $jpgLargdoc.$jpgLarguNewName);
				}
	
				if (file_exists($jpgMdum)) {
					$jpgMdumdoc = 'uploads/product/mediumthumb/webp/';
					$jpgMdumuNewName = $this->imageProcessGallery($jpgMdum, $ext, $pname, $pcode, $pgid);
	
					if(strlen($jpgMdumuNewName) > 200){
						$jpgMdumuNewName = substr($jpgMdumuNewName, 100);
						echo $jpgMdumuNewName . "<br><br>";
					} else {
						echo $jpgMdumuNewName . "<br><br>";
					}
					rename( $jpgMdum, $jpgMdumdoc.$jpgMdumuNewName);
				}
	
				if (file_exists($jpgtuml)) {
					$jpgtumldoc = 'uploads/product/thumnail/webp/';
					$jpgtumluNewName = $this->imageProcessGallery($jpgtuml, $ext, $pname, $pcode, $pgid);
	
					if(strlen($jpgtumluNewName) > 200){
						$jpgtumluNewName = substr($jpgtumluNewName, 100);
						echo $jpgtumluNewName . "<br><br>";
					} else {
						echo $jpgtumluNewName . "<br><br>";
					}
					rename( $jpgtuml, $jpgtumldoc.$jpgtumluNewName);
				}	
			}
		}
    }



	 public function clean($string) {
        $string = str_replace(' ', '-', $string);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    }
	
    public function imageProcess($image, $ext1, $name, $code)
    {
        $url = parse_url($image);
        $ext  = pathinfo($url['path'], PATHINFO_EXTENSION);
        $NewName = strtolower($this->clean($name))."-".$code.".".$ext;
		//dd($NewName);
		return $NewName;
    }
	
	
	public function imageProcessGallery($image, $ext, $name, $code, $id)
    {
        $url = parse_url($image);
        $NewName = strtolower($this->clean($name))."-".$code.'-'.$id.".".$ext;
		return $NewName;
    }

    
	
}
