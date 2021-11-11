<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name', 'Aleshamart') }} |  ADMIN PANEL</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('assets/backend/admin/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Chart CSS -->
    {{-- <link rel="stylesheet" href="{{asset('assets/backend/admin/plugins/chart.js/chart.css')}}"> --}}
    {{-- <link rel="stylesheet" href="{{asset('assets/backend/admin/plugins/chart.js/chart.min.css')}}"> --}}
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bbootstrap 4 -->
    <link rel="stylesheet" href="{{asset('/')}}assets/backend/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <link rel="stylesheet" href="{{ asset('assets/backend/admin/plugins/toastr/toastr.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('/')}}assets/backend/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{asset('/')}}assets/backend/admin/plugins/jqvmap/jqvmap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/')}}assets/backend/admin/dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{asset('/')}}assets/backend/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{asset('/')}}assets/backend/admin/plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->
    <link rel="stylesheet" href="{{asset('/')}}assets/backend/admin/plugins/summernote/summernote-bs4.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('assets/backend/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/backend/admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/backend/admin/css/vendor.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('assets/backend/admin/css/elephant.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('assets/backend/admin/css/application.min.css') }}">

    {{-- select2 cdn --}}
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"> --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{--<link href="{{ url('assets/seller/css/style.css') }}?time={{ time() }}" rel="stylesheet">
    <link href="{{ url('assets/seller/css/menus.css') }}?time={{ time() }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/seller/css/responsive.css') }}?time={{ time() }}">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/blog-post.css') }}?time={{ time() }}">--}}
    
    <script src="{{ asset('assets/backend/admin/plugins/chartjs/chart.js') }}"></script>

    <style>
        .os-viewport-native-scrollbars-invisible{
            margin-bottom: 20px;
        }
        .sidenav-heading {
            color: rgb(187 246 255);
            font-size: 18px;
            font-weight: 500;
            line-height: 1;
            margin-bottom: 0px;
            margin-top: 15px;
            text-overflow: ellipsis;
            white-space: nowrap;
            overflow: hidden;
            padding: 15px 15px;
        }
       /* .orderTabs {
            width: 100%;
            height: auto;
            float: left;
            font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
            font-size: 16px;
            font-weight: 500;
            border-bottom: 1px solid #ccc;
            margin-bottom: 20px;
        }
        .orderTabs ul {
            margin: 0;
            padding: 0;
            display: inline;
        }
        .orderTabs ul li {
            margin: 0;
            padding: 0;
            display: inline;
        }
        .orderTabs ul li a {
            width: 16.6%;
            height: auto;
            float: left;
            display: inline;
            font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
            font-size: 17px;
            padding: 15px;
            font-weight: 400;
            color: #fff;
            background:#d8b609;
        }
        .orderTabs ul li a:hover,
        .orderTabs ul li a.active {
            text-decoration: none;
            opacity:0.7;
        }
        .sellONAleshamart {
            width: 100%;
            height: 800px;
            float: left;
            background: url(../seller/image/bg.png) 100% no-repeat;
            width: 100%;
            height: 800px;
            float: left;
        }
        .commonArea {
            width: 100%;

            height: auto;
            float: left;
        }
        .commonBoxArea {
            width: 90%;
            height: auto;
            float: left;
            border: 1px solid #eaeaea;
            box-shadow: #eaeaea 0 0 1px 1px;
            padding: 10px;
            margin: 10px;
        }
        .shareArea {
            width: 100%;
            height: auto;
            float: left;
            margin-top: 5px;
        }
        .shareArea ul {
            padding: 0;
            margin: 0;
            display: inline;
        }
        .shareArea ul li {
            display: inline;
        }
        .shareArea ul li a {
            font-family: Helvetica Neue,Helvetica,Arial,sans-serif;
            font-size: 13px;
            color: #666;
            font-weight: 500;
            display: inline;
            padding: 0;
            margin: 0 10px 0 0;
        }
        @media only screen and (max-width: 770px) {
            .sellONAleshamart {
                background: linear-gradient(rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.9)), url(../seller/image/bg.png) 100% no-repeat;
            }
        }
        .customTables {
            width: 100%;
            height: auto;
            background: #fff;
            border-collapse: collapse;
            border: 1px solid #eaeaea;
            font-size: 12px;
        }
        .customTables tr th {
            border: 0;
            padding: 10px;
        }
        .customTables tr td {
            padding: 5px;
            font-size: 14px;
        }
        .commonBox {
            width: 100%;
            height: auto;
            float: left;
            background: #f6f6f6;
            padding: 10px;
            border: 1px solid #ccc;
            margin: 20px;
            border-radius: 5px;
        }
        .commonBox h4 {
            font-size: 16px;
            color: #333;
            padding: 10px;
        }
        .commonBox p {
            font-size: 12px;
            color: #333;
            padding: 5px;
        }
        .commonBox span {
            font-size: 11px;
            color: #999;
            margin-bottom: 10px;
            float: left;
            width: 100%;
        }
        .commonBox div {
            margin: 10px 0 5px;
            font-size: 12px;
            font-weight: 700;
            float: left;
            width: 100%;
        }
        .commonBox ul{
            width:100%;
            height:auto;
            float:left;
            padding:0;
            margin:0;
            display:block;
        }
        .commonBox ul li{
            width:100%;
            height:auto;
            float:left;
            padding:0;
            margin:0;
            display:inline;
            cursor:pointer;
        }
        .commonBox input[type='radio'],input[type='checkbox']{
            width:15px; height:15px;float:left; margin:3px 5px 0 0
        }
        .commonBox label{
            font-size:14px; color:#333; margin-top:0px; font-weight:normal;
        }
        }
        .orderAreas {
            width: 100%;
            height: auto;
            float: left;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .orderAreas .orderHeadline {
            width: 100%;
            height: auto;
            float: left;
            background-color: #ddd !important;
            padding: 7px 10px;
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }
        .orderAreas .orderHeadline h2 {
            color: #666;
            font-size: 12px;
            padding: 3px;
            margin: 0;
            text-transform: uppercase;
            text-align: left;
        }
        .orderAreas .orderHeadline h3 {
            color: #333;
            font-size: 12px;
            padding: 3px;
            margin: 0;
            text-transform: capitalize;
            text-align: left;
        }
        .orderAreas .orderHeadline h3 a {
            color: #06c;
            font-size: 12px;
        }
        .orderAreas .displayArea a {
            color: #06c;
            font-size: 13px;
            padding: 0 0 0 10px;
            float: left;
        }
        .orderAreas .displayArea p {
            color: #666;
            font-size: 13px;
            padding: 0 0 0 10px;
            margin: 0;
            float: left;
        }
        .orderAreas .displayArea .prices {
            color: #900;
            font-size: 13px;
            padding: 0 0 0 10px;
            margin: 0;
        }
        .orderDetailsAreas {
            width: 100%;
            height: auto;
            float: left;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-bottom: 20px;
            padding: 20px;
        }
        .orderDetailsAreas h6 {
            color: #222;
            font-size: 13px;
            float: left;
            font-weight: 700;
            width: 100%;
        }
        .orderDetailsAreas a {
            color: #06c;
            font-size: 13px;
            float: left;
        }
        .orderDetailsAreas p {
            width: 100%;
            color: #666;
            font-size: 13px;
            margin: 0;
            float: left;
        }
        .orderDetailsAreas .prices {
            color: #900;
            font-size: 13px;
            padding: 0 0 0 10px;
            margin: 0;
        }
        .seller_order_btn_group ul {
            padding-left: 0;
            list-style: none;
            float: right;
        }
        .seller_order_btn_group ul li {
            display: inline-block;
        }
        .seller_order_btn_group ul li .cartBtnSum {
            background: #eff1f3;
            background: -webkit-linear-gradient(top, #f7f8fa, #e7e9ec);
            background: linear-gradient(to bottom, #f7f8fa, #e7e9ec);
            display: block;
            position: relative;
            overflow: hidden;
            height: 38px;
            width: auto;
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.6) inset;
            border-radius: 2px;
            font-size: 13px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            padding: 0;
            margin-right: 2%;
            cursor: pointer;
            line-height: 38px;
            color: #111;
            padding-left: 5px;
            padding-right: 5px;
        }
        .seller_order_btn_group ul li select {
            width: auto !important;
        }
        .checkoutBtn {
            background: #f4d078;
            background: -webkit-linear-gradient(top, #f7dfa5, #f0c14b);
            background: linear-gradient(to bottom, #f7dfa5, #f0c14b);
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.4) inset;
            display: block;
            position: relative;
            overflow: hidden;
            height: 40px;
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.6) inset;
            border-radius: 2px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            font-size: 12px;
            float: left;
            width: 100%;
            padding: 0;
            cursor: pointer;
        }
        .cartBtn {
            background: #eff1f3;
            background: -webkit-linear-gradient(top, #f7f8fa, #e7e9ec);
            background: linear-gradient(to bottom, #f7f8fa, #e7e9ec);
            display: block;
            position: relative;
            overflow: hidden;
            height: auto;
            box-shadow: 0 1px 0 rgba(255, 255, 255, 0.6) inset;
            border-radius: 2px;
            font-size: 13px;
            font-family: Verdana, Arial, Helvetica, sans-serif;
            float: left;
            width: 100%;
            padding: 5px;
            margin-right: 2%;
            cursor: pointer;
            color:#333;
            border:1px solid #ccc;
        }
        .searchBtn {
            background: #666c74;
            background: -webkit-linear-gradient(top, #5e656d, #70767d);
            background: linear-gradient(to bottom, #5e656d, #70767d);
            display: block;
            position: relative;
            overflow: hidden;
            height: auto;
            border-radius: 5px;
            font-size: 15px;
            float: left;
            width: 100%;
            padding: 4px 0;
            border: 1px solid #ccc;
            cursor: pointer;
            color: #fff;
            text-align: center;
            margin-left: 28px!important;
        }*/
    </style>

    <link rel="stylesheet" href="{{ asset('assets/backend/admin/css/customs.css') }}">
</head>
