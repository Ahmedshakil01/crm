<?php
namespace App\Exports;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection,WithHeadings
{

    public function collection()
    {
        return DB::table('products AS p')
            ->join('product_inventories AS pi', 'p.id', '=', 'pi.product_id')
            ->join('merchants AS m', 'p.seller_id','=','m.id')
            ->select('p.name','pi.unit_price','m.username','p.minQty','p.sku','p.brand','p.manufacturer_part_number','p.sizes','p.colors','p.read_count','p.item_weight','p.free_shipping','p.entry_date','p.entry_from','pi.initial_qty','pi.market_price','pi.discount','pi.stock_qty')
//            ->select('p.id','p.cat_id','p.name','p.slug','p.code','p.minQty','p.sku','p.brand','p.sizes','p.item_weight','p.warranty','p.colors','m.name','m.id','m.businessname','pi.unit_price','pi.market_price','pi.discount','pi.discount_type')
            ->get();
    }


    public function headings() :array
    {
        return ["Product name","Unit price","Merchant name","Minimum Quantity","Sku","Brand","Manufacturer Part Number","Size","Color","Read Count","Item Weight","Shipping","Entry Date","Entry Form","Initial Quentity","Market Price","Discount","Stock Quantity"];
//        return ["Product Id", "Product Category Id", "Product Name","Product Slug", "Product Code", "Product Min Quantity","Product Sku", "Product brand", "Product Size","Product Weight", "Product Warranty", "Product Colors","Merchant Name", "Merchant Id", "Merchant Business Name", "Product Unite Price", "Product Market Price", "Product Discount", "Product Discount Type"];
    }
}
