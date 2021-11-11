
{{-- @section('content') --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
  	.lists{
		width:100%;
		height:auto;
	}
	.lists a{
		width:100%;
		height:auto;
		color:#333;
		background:#fff;
	}
	.lists table tr td{
		font-size:15px;
		font-weight:normal;
	}
	.lists:hover{
		background:#ddd!important;
		box-shadow:#ddd 0 0 2px 2px;
	}
	.customtables{
		width:100%;
		height:auto;
		float:left;
		border:1px solid #ccc;
		padding:10px;
	}
	.customtables thead tr{
		background: #fff;
		width: 100%;
		border-bottom:4px solid #AB1836;
	}
	.customtables thead tr th{
		text-align:center;
		height: 50px;
		padding: 20px;
	}
	.customtables tbody tr td{
		background:#F1F3F4;
		text-align:center;
		height: 30px;
		padding: 10px;
		border-bottom:1px solid #BCBCBC;
		color:#333;
		font-size:18px;
	}
	.composebtn{
		width:auto;
		box-shadow: 0 1px 2px 0 rgba(60,64,67,0.302), 0 1px 3px 1px rgba(60,64,67,0.149);
		-webkit-font-smoothing: antialiased;
		font-family: 'Google Sans', Roboto,RobotoDraft,Helvetica,Arial,sans-serif;
		font-size: 14px;
		letter-spacing: .25px;
		-webkit-align-items: center;
		align-items: center;
		background-color: #fff;
		background-image: none;
		-webkit-border-radius: 24px;
		border-radius: 24px;
		color: #3c4043;
		display: -webkit-inline-box;
		display: -webkit-inline-flex;
		display: inline-flex;
		font-weight: 500;
		height: 48px;
		min-width: 56px;
		overflow: hidden;
		padding: 0 24px 0 0;
		text-transform: none;
		text-align:center;
		font-weight:bold;
		padding-left:10px;
	}
	.detailsleftmenu{
		width:100%;
		height:auto;
		float:left;
		margin:10px 20px;
	}
	
	.detailsleftmenu ul{
		width:100%;
		height:auto;
		float:left;
		margin:0;
		padding:0;
		display:block;
	}
	.detailsleftmenu ul li{
		width:100%;
		height:auto;
		float:left;
		display:inline;
	}
	.detailsleftmenu ul li a{
		width:100%;
		height:auto;
		float:left;
		margin:0;
		padding:6px 10px;
		display:inline;
		color:#666;
		font-size:16px;
	}
	.detailsleftmenu ul li a:hover{
		width:100%;
		height:auto;
		float:left;
		margin:0;
		padding:6px 10px;
		display:inline;
		color:#666;
		font-size:16px;
		text-decoration:none;
		background:#FFCACA;
		border-radius:22px;
	}
  </style>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
     <div class="row">   
     	<div class="container"> 
        	<div class="col-sm-2" style="margin-bottom:20px;">
                   		<div style="width:100%; height:auto; margin-top:60px; float:left">
                           <div style="width:100%; float:left; height:auto">
                            	<a href="{{ route('seller.newmail') }}" class="composebtn"><img src="{{ asset('assets/images/create_32dp.png') }}" />Compose Ticket</a>
                            </div>
                           <div class="detailsleftmenu">                           
                                <ul>
                                    <li><a href="{{ route('customer.mailbox') }}"><i class="fa fa-bars"></i> Ticket List</a></li>
                                    <li><a href="{{ route('seller.sentmail') }}"><i class="fa fa-bars"></i> Reply Ticket</a></li>
                                </ul>
                            </div>
                        </div>
                   </div>           
       		<div class="col-md-10">
                <div class="boardTitle">
                     <h2 style="margin:20px 0;">Inbox</h2>
                </div>
                <div class="row" style="background:#fff"> 
					<table class="customtables"  width="100%" cellspacing="0">
                        <thead>
                          <tr>
                            <th width="13%">Ticket No.</th>
                            <th width="53%">Subject</th>
                            <th width="17%">Ticket Status</th>
                            <th width="17%">Date Time</th>
                          </tr>
                        </thead>                        
                        <tbody>
                         <?php $i = 0; ?>
                          @foreach($allmails as $mails)
                          <?php 
							  if($mails->read_count > 0){
							  	$fontweight = 'normal';
							  }
							  else{
							  	$fontweight = 'bold';
							  }
							  $i++; 
						?>
                        	<tr>
                            	<td colspan="6" style="padding:0;">
                                	<div class="lists">
                                    	<a href="{{ route('customer.maildetails',$mails->id)}}">
                                    		<table width="100%">
                                        	<tr>
                                                 <td width="13%" style="background:none; border:none;font-weight:{{ $fontweight }};">#{{ $mails->id }}</td>
                                              <td width="53%" style="background:none; border:none;font-weight:{{ $fontweight }};">{{ $mails->subject }}</td>
                                              <td width="17%" style="background:none; border:none;font-weight:{{ $fontweight }};">{{ ucfirst($mails->mailtype) }}</td>
                                              <td width="17%" style="background:none; border:none;font-weight:{{ $fontweight }};">{{ $mails->created_at }}</td>
                                              </tr>
                                        </table>
                                        </a>
                                    </div>
                                </td>
                            </tr>                               
                          @endforeach                          
                        </tbody>
                   </table>                    
              </div>
            </div>
        </div>
     </div>
{{-- @endsection --}}

