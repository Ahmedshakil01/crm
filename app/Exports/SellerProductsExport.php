<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SellerProductsExport implements FromView
{
    protected $products;

    public function __construct($products) {
        $this->products = $products;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $data = [
            'products' => $this->products,
        ];

        return view('frontend.seller.reports.product', $data);
    }
}
