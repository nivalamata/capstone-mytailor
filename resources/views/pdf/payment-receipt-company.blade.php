<!DOCTYPE html>
<html>
	<head>
		<title>Fashion Collection - Issue Receipt</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<style type="text/css">

			table{
				border-collapse: collapse;
				margin-left: 20px;
				margin-right:20px;
				margin-top:5%;
			}

			table, th, td{
				border: 1px solid teal;
				text-align: center;
			}
			
			.page-break {
			    page-break-after: always;
			}

		</style>
	</head>
	
	<body>
		

		
		<div class="col s12">
			<left>
				<h1 style="color:teal; font-size:20px;">
					<img src="img/logo.jpg" class="left circle responsive-img valign profile-image center" style="height:5%; width:5%; margin-top:5px;">
					<b>MyTailor</b> Store
					<p style="color:gray; font-size:-0.5px;"></p>
					<p style="color:gray">123-A Heaven St., Sta. Mesa, Manila</p>
					<p style="color:gray">Contact: 0908-223-5065</p>
					<p style="color:gray">Visit: www.myTailor.com</p>
				</h1>
			</left>
			<right>
				
			</right>
		</div>
        <div class="col s12"><div class="divider" style="height:3px; background-color:teal"></div></div>

        <h2 style="color:dimgray;"><center>PAYMENT RECEIPT</center></h2>	

        <div class="col s12" style="margin-top:0">
        	<table border="0" text-align="left">
				<thead>
				</thead>
				<tbody>
					<tr>
						<td style="width:40%; font-size:18px; text-align:left"><b>Order Payment No:</b></td>
						<td style="width:60%; font-size:18px; color:teal; text-align:right;"><b>{{$paymentID}}</b></td>
						<td style="margin:15px; color:white">Hahah</td>
						<td style="width:40%; font-size:18px; text-align:left"><b>Receipt No:</b></td>
						<td style="width:60%; font-size:18px; text-align:right; color:teal"><b>{{$paymentReceipt}}</b></td>
					</tr>
					<tr>
						<td style="width:40%; font-size:18px; text-align:left"><b>Customer Name:</b></td>
						<td style="width:60%; font-size:18px; text-align:right; color:teal"><b>{{$companyName->strCompanyName}}</b></td>
						<td></td>
						<td style="width:40%; font-size:18px; text-align:left"><b>Customer Id:</b></td>
						<td style="width:60%; font-size:18px; text-align:right; color:teal"><b>{{$companyName->strCompanyID}}</b></td>
					</tr>
					<tr>
						<td style="width:40%; font-size:18px; text-align:left"><b>Date:</b></td>
						<td style="width:60%; font-size:18px; text-align:right; color:teal"><b>{{ date('F d, Y') }}</b></td>
						<td></td>
						<td style="width:40%; font-size:18px; text-align:left"><b>Time:</b></td>
						<td style="width:60%; font-size:18px; text-align:right; color:teal"><b>{{ date('h:i A') }}</b></td>
					</tr>
					<tr>
						<td style="width:40%; font-size:18px; text-align:left"><b>Issued By:</b></td>
						<td style="width:60%; font-size:18px; text-align:right; color:teal"><b>{{$empname->employeename}}</b></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
        	</table>
        </div>


		<div class="col s12" style="margin-top:2%">
			<table style="width:98%">
				<thead style="background-color:teal; opacity:0.90; color:white">
					<tr>
						<th>JOB ORDER ID</th>
						<th>TERM OF PAYMENT</th>
						<!--condition ng terms of payment dito-->
							<th>DOWNPAYMENT (50%)</th>
						<!-- end -->
						<th>TOTAL AMOUNT PRICE</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td style="width:40%; padding-top:10px; padding-bottom:10px; padding-left:10%; padding-right:10%"><b>{{$jobOrderID}}</b></td>
						<td style="width:40%; padding-top:10px; padding-bottom:10px; padding-left:10%; padding-right:10%">{{$termsOfPayment}}</td>
						@if( $termsOfPayment != 'Full Payment')
							<td style="width:40%; padding-top:10px; padding-bottom:10px; padding-left:10%; padding-right:10%">P {!! session('outstandingBal') !!}</td>
						@endif
						<td style="width:60%">
							<b>Sub total: </b>P {!! session('totalPrice') !!}<br>
							<b>Additional Fee: </b>P 0.00<br><br>
							<div class="col s12"><div class="divider" style="height:1px; background-color:gray; margin-left:10%; margin-right:10%"></div></div>
							<b style="color:teal; padding-left:3%">Grand Total: </b><b>P {!! session('totalPrice') !!}</b>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		
		<div class="col s12" style="margin-top:1%">
			<table width="98%">
				<tbody>
					<tr>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; background-color:teal; color:white; border: 2px white solid">AMOUNT PAID</td>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; padding-left:10%; padding-right:10%; font-size:1.2em"><b>P {!! number_format(session('amountToPay'), 2) !!}</b></td>
					</tr>
					<tr>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; background-color:teal; color:white; border: 2px white solid">AMOUNT TENDERED</td>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; padding-left:10%; padding-right:10%; font-size:1em">P {{ number_format($amtTendered, 2) }}</td>
					</tr>
					<tr>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; background-color:teal; color:white; border: 2px white solid">CHANGE</td>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; padding-left:10%; padding-right:10%; font-size:1em">P {{ number_format($amtChange, 2) }}</td>
					</tr>
					
					<tr>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; background-color:teal; color:white; border: 2px white solid">OUTSTANDING BALANCE<p></p></td>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; padding-left:10%; padding-right:10%; font-size:1.2em">
							<b>P {!! session('outstandingBal') !!}</b>
						</td>
					</tr>
					<!-- condition ng terms of payment dito -->
					<tr>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; background-color:teal; opacity:0.80; color:white; border: 2px white solid">DUE DATE FOR PAYMENT</td>
						<td style="width:50%; padding-top:10px; padding-bottom:10px; padding-left:10%; padding-right:10%; font-size:1.2em; color:teal"><b>{!! session('dueDate') !!}</b> <br><font color="gray" size="15px">*Pay balance before or on the said date</font></td>
					</tr>
					<!-- end -->
				</tbody>
			</table>


			
		</div>

	</body>

</html>