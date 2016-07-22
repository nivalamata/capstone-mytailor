@extends('layouts.master')

@section('content')


	<div class="row">
      <div class="col s12 m12 l12">
        <span class="page-title"><center><h3><b>Welcome to <font color="white">MyTailor</font></b></h3></center></span>
        <center><h5>Walk-in Company - Payout</h5></center>
      </div>
    </div>

    	<div class="row" style="padding:30px">
        
	        <ul class="col s12 breadcrumb">
				<li><a style="padding-left:200px" href="{{URL::to('transaction/walkin-company-payment-customer-info')}}"><b>1.FILL-UP FORM</b></a></li>
				<li><a class="active" style="padding-left:200px" href="#payment-info"><b>2.PAYMENT</b></a></li>
				<li><a style="padding-left:200px" href="{{URL::to('transaction/walkin-company-payment-measure-detail')}}"><b>3.ADD MEASUREMENT DETAIL</b></a></li>
			</ul>

			<!-- Tab for Payment-->
	    <div id="payment-info" class = "hue col s12 active" style="background-color: white; border:2px outset">
	        <div class="row">
		        <div class="col s12 m12 l12">
                	<span class="page-title" style="margin:15px"><center><h5><b>Payment Information</b></h5></center></span>
              		<div class="divider" style="height:1px; background-color:#80d8ff"></div>
              		<div class="divider" style="height:1px; background-color:#80d8ff"></div>
              	</div>
	       	</div>

	       	<div class="left col s12">
		        <div class="fixed-action-btn vertical" style="bottom: 45px; right: 24px;">
			        <a class="mdi-action-print btn-floating btn-large red " style="font-size:40px; height:70px; width:70px; padding:5px; padding-bottom:3px; margin-right:40px" ></a>
			          	<ul>
					      <li><a href="{{URL::to('transaction/walkin-company')}}" class="btn-floating blue tooltipped" data-position="left" data-delay="50" data-tooltip="Print a copy of the contract" style="height:50px; width:50px; margin-right:40px; padding-top:5px;"><i class="mdi-content-content-copy"></i></a></li>
					      <li><a href="{{URL::to('transaction/walkin-company-customize-orders')}}" class="btn-floating yellow darken-2 tooltipped" data-position="left" data-delay="50" data-tooltip="Print a receipt" style="height:50px; width:50px; margin-right:40px; padding-top:5px;"><i class="mdi-action-assignment">Return to Customize Order</i></a></li>
					 	</ul>
				</div>		    
			</div>

	       	<div class="row" style="background-color:white;">
	       		<div class="container">
	            <div class="col s12"> 

	            	<div class="col s12" style="margin-bottom:20px">
						<div class="col s6">
	            			<div class="col s6" style="color:gray;padding-left:50px;padding-top:15px"><p>Transaction No.:</p></div>
			      			<div class="col s6" style="color:red;"><p><input value="" id="transac_no" name="transac_no" type="text" class="" readonly></p></div>
                        </div>

                        <div class="col s6">              
	                        <div class="col s12">
	                          <div class="col s4" style="color:gray"><p>Date:</div>
	                          <div class="col s8" id="Date" style="padding:15px; color:teal;"></div>
	                        </div>
	                        <div class="col s12">
	                           <div class="col s4" style="color:gray"><p>Time:</div>
	                          <div class="col s8" id="clock" style="padding:15px; color:teal;"></div>
	                        </div>
	                    </div>
                    </div>

                    <label style="font-size:15px; color:black"><center>Order Summary</center></label>
                    <div class="container overflow-x">
                        <table class = "table centered order-summary" border = "1">
		       				<thead style="color:gray">
			          			<tr>
				                  <th data-field="product">Product</th>         
				                  <th data-field="quantity">Quantity</th>
				                  <th data-field="design">Design</th>
				                  <th data-field="fabric">Fabric</th>
				                  <th data-field="price">Unit Price</th>
				                  <th data-field="price">Total Price</th>
				              	</tr>
			              	</thead>
			              	<tbody>
					            <tr>
					               <td>Uniform, Polo</td>
					               <td>1</td>
					               <td>No-fit</td>
					               <td>Traditional Cotton</td>
					               <td>800.00 PHP</td>
					               <td>800.00 PHP</td>
					            </tr>

					             <tr>
					               <td>Uniform, Polo</td>
					               <td>1</td>
					               <td>Slim-fit</td>
					               <td>Remarkable Cotton</td>
					               <td>850.00 PHP</td>
					               <td>850.00 PHP</td>
					            </tr>
					        </tbody>
					    </table>
		      		</div>

		      		<div class="container">
			      			<div class="col s4" style="color:teal"><p><b>Total Amount</b></p></div>
			      			<div class="col s8" style="color:red;"><p><input id="total-price" name="total-price" type="text" class="" readonly></p></div>

	                        <div class="left col s12" id="mode-of-payment" style="margin-bottom:20px">
	                        	<div class="col s6">
			          				<input name="modePayment" type="radio" class="filled-in payment" id="half_pay" />
	      							<label for="half_pay">Half-payment</label>
								</div>
								<div class="col s6">
				          			<input name="modePayment" type="radio" class="filled-in payment" id="full_pay" />
		      						<label for="full_pay">Full-payment</label>
		      					</div>
		      				</div>

		      				<div class="col s4" style="color:teal"><p><b>Amount Payable:</b></p></div>
		      				<div class="col s8" style="color:red;"><p><input value="" id="amount-payable" name="amount-payable" type="text" class="" readonly></p></div>

		      				<div class="col s4" style="color:teal"><p><b>Remaining Balance:</b></p></div>
		      				<div class="col s8" style="color:red;"><p><input value="" id="balance" name="balance" type="text" class="" readonly></p></div>
                    </div>

                    <div class="col s12" style="border:4px solid teal; padding:5px">
							<left><p style="padding-left:40px"><font size="+1"><b>CHEQUE DETAILS</b></font><font color="gray" style="padding-left:30px">In case payment is made through cheque</font></p></left> 
							
							<div class="divider" style="height:2px; background-color:teal; margin-left:30px; margin-right:30px"></div>        
								
								<div class="col s4" style="color:teal; padding-top:20px; padding-left:30px"><p>Account Number:</p></div>
		      					<div class="col s8" style="color:black; padding-right:50px"><p><input value="" id="account_no" name="account_no" type="text" class=""></p></div>
							
								<div class="col s4" style="color:teal; padding-top:20px; padding-left:30px"><p>Account Name:</p></div>
		      					<div class="col s8" style="color:black; padding-right:50px"><p><input value="" id="account_name" name="account_name" type="text" class=""></p></div>

		      					<div class="col s4" style="color:teal; padding-top:20px; padding-left:30px"><p>Check Number:</p></div>
		      					<div class="col s8" style="color:black; padding-right:50px"><p><input value="" id="check_no" name="check_no" type="text" class=""></p></div>

		      					<div class="col s4" style="color:teal; padding-top:20px; padding-left:30px"><p>Date:</p></div>
		      					<div class="col s8" style="color:black; padding-right:50px"><p><input value="" id="transac_date" name="transac_date" type="date" class="datepicker"></p></div>
    

                     </div>

                    <div class="container">
                    	
                    		<a href="{{URL::to('transaction/walkin-company-payment-measure-detail')}}" class="right btn tooltipped" data-position="top" data-delay="50" data-tooltip="Click to save payment information and get measured" style="background-color:teal; padding:9.5px; padding-bottom:45px; margin-top:20px;"><label style="font-size:15px; color:white">Start Measurement</label></a>
                    		<a href="{{URL::to('transaction/walkin-company')}}" class="left btn tooltipped" data-position="top" data-delay="50" data-tooltip="Transfers you back to shopping for garments and clears current unsaved transaction" style="background-color:teal; padding:9.5px; padding-bottom:45px; margin-top:20px;"><label style="font-size:15px; color:white">Cancel Transaction</label></a>
                    	
                    </div>


	            </div>
	        	</div>
	        </div>

	        <div class="divider" style="height:2px; margin-bottom:20px; margin-top:50px"></div>
	      	
	      		<center><p><font color="gray">End of Payment Information Form</font></p></center>
	
	    </div>
	    <!-- End of Tab for Payment-->


		</div>





@stop

@section('scripts')

	<script type="text/javascript">
	  $('.modal-trigger').leanModal({
	      dismissible: true, // Modal can be dismissed by clicking outside of the modal
	      opacity: .5, // Opacity of modal background
	      in_duration: 300, // Transition in duration
	      out_duration: 200, // Transition out duration
	      width:400,
	    }
	  );
	</script>

	<script>
	  $(document).ready(function() {
	    $('select').material_select();
	  });
	</script>	

	<script>
	$(document).ready(function(){
    	$('body').on('load', 'ul.tabs', function() {
   	 	$('ul.tabs').tabs();
		});
  		
  		$("#addMeasurementDetail").on('click', function(){
/*  			setTimeout(function(){
  				$('ul.tabs').tabs();
  				$('#tabMeasurementDetail').style('display', 'block');
  			}, 2000);
*/  		});

  	});

	</script>

	<script type="text/javascript">
		var monthNames = [ "January", "February", "March", "April", "May", "June",
	    "July", "August", "September", "October", "November", "December" ];
		var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

		var newDate = new Date();
		newDate.setDate(newDate.getDate());    
		$('#Date').html(dayNames[newDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
	
	</script>

	<script type="text/javascript">
		function updateClock ( )
		 	{
		 	var currentTime = new Date ( );
		  	var currentHours = currentTime.getHours ( );
		  	var currentMinutes = currentTime.getMinutes ( );
		  	//var currentSeconds = currentTime.getSeconds ( );

		  	// Pad the minutes and seconds with leading zeros, if required
		  	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
		  	//currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

		  	// Choose either "AM" or "PM" as appropriate
		  	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

		  	// Convert the hours component to 12-hour format if needed
		  	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

		  	// Convert an hours component of "0" to "12"
		  	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

		  	// Compose the string for display
		  	var currentTimeString = currentHours + ":" + currentMinutes + " " + timeOfDay;
		  	
		  	
		   	$("#clock").html(currentTimeString);
		   	  	
		 }

		$(document).ready(function()
		{
		   setInterval('updateClock()', 1000);
		});
	</script>

	<script>
	function tabInit() {
    $('ul.tabs').tabs();
	}

	$.ajax({
	    type: "GET",
	    //Url to the XML-file
	    url: "transaction/walkInIndividualCheckout",
	    dataType: "blade.php",
	    success: tabInit
	});
	</script>


@stop