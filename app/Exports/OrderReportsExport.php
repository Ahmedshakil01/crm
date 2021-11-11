<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Events\AfterSheet;
use \Maatwebsite\Excel\Writer;
use \Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Events\BeforeWriting;

class OrderReportsExport implements FromView
{

    protected $orders;

    public function __construct($orders) {
        $this->orders = $orders;
        //dd($this->orders);
    }



    /**
     * @return View
     */
    public function view(): View
    {
        $data = [
            'orders' => $this->orders,
        ];

        return view('admin.reports.order', $data);
    }

}
