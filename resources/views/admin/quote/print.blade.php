<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aleshamart | Purchase Order</title>
    <style>
        .tablestr{
            color:#333;
            border: none;
            font-size: 11px;
        }

        .tablestr th{
            font-size:11px;
            padding:4px;
            text-align:center;
            color:#fff;
            background: #000;
            font-weight: bold;
            font-family: Sans-Serif, serif;
            border: none;
        }

        .tablestr td{
            border:1px solid #666;
            font-size:11px;
            padding:3px;
            text-align:center;
            color:#000;
            font-family: Sans-Serif, serif;
            margin: 0;
            font-weight: normal;
        }

        page {
            background: #fff;
            display: block;
            margin: 0 auto;
            margin-bottom: 0.5cm;
            box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
        }
        page[size="A4"] {
            width: 100%;
            height:auto;
        }
        page[size="A4"][layout="portrait"] {
            width: 100%;
            /* height: 21cm;  */
            height:auto;
        }
        .summTable{
            border-collapse:collapse;
        }
        .summTable td{
            padding:2px;
            color:#000;
            font-size: 11px;
        }
        .summTable .center-align{
            width: 100%;
            font-size: 11px;
        }
        .summTable .center-align td{
            text-align: center;
            font-size: 11px;
            padding: 0 !important;
        }
        .total{
            font-size: 12px;
        }
        {{-- page[size="A3"] {
             width: 29.7cm;
             height: 42cm;
         }
         page[size="A3"][layout="portrait"] {
             width: 42cm;
             height: 29.7cm;
         }
         page[size="A5"] {
             width: 14.8cm;
             height: 21cm;
         }
         page[size="A5"][layout="portrait"] {
             width: 21cm;
             height: 14.8cm;
         }
         @media print {
             body, page {
                 margin: 0;
                 box-shadow: none;
             }
         }--}}
    </style>

</head>

<body>
<page size="A4" layout="portrait">
    <div style="width:100%; height:auto; border: 1px solid #000;page-break-before: auto; page-break-after: auto">

        <div style="width:100%; height:auto;">
            <table class="summTable" border="1" width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td colspan="2">
                        <table class="center-align">
                            <tr>
                                <td width="90%">
                                    <table class="center-align" style="margin-left: 60px;">
                                        <tr><td><strong>ALESHAMART LIMITED</strong></td></tr>
                                        <tr><td>E-mail: {{ $PO_EMAIL->value ?? ''}}</td></tr>
                                        <tr><td>Call: {{ $SITE_PHONE->value ?? ''}}</td></tr>
                                        <tr><td><strong>ONLINE PURCHASE REQUEST FORM</strong></td></tr>
                                    </table>
                                </td>
                                <td width="10%" valign="top" align="center"><img src="{{ asset('images/frontend/logo.png') }}" alt="Logo" style="width:70px; height:auto;" /></td>
                            </tr>

                        </table>
                    </td>
                </tr>
                <tr>
                          <th scope="row" class="">Quote Owner :</th>
                          <td>{{ $quote_details->quote_owner ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Subject :</th>
                          <td>{{ $quote_details->subject ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Team :</th>
                          <td>{{ $quote_details->team ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Deal Name :</th>
                          <td>{{ $quote_details->deal_name ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class=""> Valid Until :</th>
                          <td>{{ $quote_details->valid_until ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class=""> Contact Id :</th>
                          <td>{{ $quote_details->contact_id ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing Street :</th>
                          <td>{{ $quote_details->billing_street ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing City :</th>
                          <td>{{ $quote_details->billing_city ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing State :</th>
                          <td>{{ $quote_details->billing_state ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing Code :</th>
                          <td>{{ $quote_details->billing_code ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Billing Country :</th>
                          <td>{{ $quote_details->billing_country ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping Street :</th>
                          <td>{{ $quote_details->shipping_street ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping City :</th>
                          <td>{{ $quote_details->shipping_city ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping State :</th>
                          <td>{{ $quote_details->shipping_state ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping Code :</th>
                          <td>{{ $quote_details->shipping_code ?? ' ' }}</td>
                        </tr>
                        <tr>
                          <th scope="row" class="">Shipping Country :</th>
                          <td>{{ $quote_details->shipping_country ?? ' ' }}</td>
                        </tr>

                        <tr>
                          <th scope="row" class=""> Created At :</th>
                          <td>{{ date('d-M-Y', strtotime($quote_details->created_at)); }}</td>
                        </tr>
            </table>
        </div>
        <div style="width:100%; height:auto; ">
            <table class="tablestr" border="0" width="100%" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <th style="width: 5%;">Sl No</th>
                        <th> Product Name</th>
                        <th> Quantity</th>
                        <th> Price</th>
                        <th> Amount</th>
                        <th> Discount</th>
                        <th> Tax</th>
                        <th> Total</th>
                        <th> Created At</th>
                    </tr>

                    @foreach ($quote_details->products as $key=> $products)
                      <tr id="tablerow<?php echo $products->id;?>">
                        <td>{{ $key+1 ?? " "}}</td>
                        <td>{{ $products->product_name ?? " "}}</td> 
                        <td>{{ $products->quantity ?? " "}}</td> 
                        <td>{{ $products->price ?? " "}}</td> 
                        <td>{{ $products->amount ?? " "}}</td> 
                        <td>{{ $products->discount ?? " "}}</td> 
                        <td>{{ $products->tax ?? " "}}</td> 
                        <td>{{ $products->total ?? " "}}</td> 
                        <td>{{ date('d-M-Y', strtotime($products->created_at)); }}</td>
                    
                      </tr>
                    @endforeach

                </tbody>
            </table> 
           

        </div>

    </div>

 
</page>


</body>
</html>
