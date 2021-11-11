<?php

namespace App\Imports;

use App\Models\Category;
use App\Models\Lastcategory;
use App\Models\Product;
use App\Models\Merchant;
use App\Models\ProductInventory;
use App\Models\Subcategory;
use App\Models\Subsubcategory;
use Maatwebsite\Excel\Concerns\ToModel;
use DB;

class ProductsImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $check_merchant = Merchant::find($row[0]);
        $check_category = Category::find($row[1]);

        if( $check_merchant !='' && $check_category !=''){
            $productdata = array(
                'seller_id'=>$row[0],
                'cat_id'=>$row[1],
                'subcat_id'=>$row[2],
                'subsubcat_id'=>$row[3],
                'lastcat_id'=>$row[4],
                'parent_id'=>$row[5],
                'productType'=>$row[6],
                'minQty'=>$row[7],
                'name'=>$row[8],
                'slug'=>$row[9],
                'mainimage'=>$row[10],
                'caption'=>$row[11],
                'code'=>$row[12],
                'product_tax_code'=>$row[13],
                'product_id_type'=>$row[14],
                'sku'=>$row[15],
                'conditions'=>$row[16],
                'brand'=>$row[17],
                'manufacturer'=>$row[18],
                'manufacturer_part_number'=>$row[19],
                'features'=>$row[20],
                'details'=>$row[21],
                'additional_details'=>$row[22],
                'sizes'=>$row[23],
                'colors'=>$row[24],
                'sequence'=>$row[25],
                'status'=>$row[26],
                'comparable'=>$row[27],
                'compareItems'=>$row[28],
                'read_count'=>$row[29],
                'item_weight'=>$row[30],
                'item_weight_unit'=>$row[31],
                'package_weight'=>$row[32],
                'package_weight_unit'=>$row[33],
                'dimensions_length'=>$row[34],
                'dimensions_width'=>$row[35],
                'dimensions_height'=>$row[36],
                'warranty'=>$row[37],
                'warranty_type'=>$row[38],
                'warranty_duration'=>$row[39],
                'package_dimension_length'=>$row[40],
                'package_dimension_width'=>$row[41],
                'package_dimension_height'=>$row[42],
                'key_target_audiance'=>$row[43],
                'meta_description'=>$row[44],
                'keywords'=>$row[45],
                'tag'=>$row[46],
                'giftreceipt'=>$row[47],
                'giftwrapped'=>$row[48],
                'gift_wrap_name'=>$row[49],
                'wrapping_cost'=>$row[50],
                'free_shipping'=>$row[51],
                'feature'=>$row[52],
                'entry_date'=>$row[53],
                'entry_from'=>$row[54],
                'created_by'=>$row[55],
                'updated_by'=>$row[56],
                'deleted_by'=>$row[57],
                'created_at'=>$row[58],
                'updated_at'=>$row[59],
                'deleted_at'=>$row[60],
            );

            Product::insert($productdata);
            $product_id = DB::getPdo()->lastInsertId();

            $productinventorydata = array(
                'product_id'=>$product_id,
                'initial_qty'=>$row[30],
                'unit_price'=>$row[31],
                'market_price'=>$row[32],
                'purchase_price'=>$row[33],
                'sell_price'=>$row[34],
                'discount'=>$row[35],
                'discount_type'=>$row[36],
                'discount_amount'=>$row[37],
                'seller_commission'=>$row[38],
                'commission_type'=>$row[39],
                'commission_amount'=>$row[40],
                'stock_qty'=>$row[41],
                'created_by'=>$row[42],
                'created_at'=>$row[43],
                'updated_at'=>$row[44],
                'deleted_at'=>$row[45],


            );

            ProductInventory::insert($productinventorydata);
       }

    }
}
