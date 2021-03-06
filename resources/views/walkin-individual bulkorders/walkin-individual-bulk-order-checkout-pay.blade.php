bulk-orders-@extends('layouts.master')

@section('content')


	<div class="row">
      <div class="col s12 m12 l12">
        <span class="page-title"><center><h3><b>Welcome to <font color="white">MyTailor</font></b></h3></center></span>
        <center><h5>Walk-in Individual - Payout</h5></center>
      </div>
    </div>

	<div class="row" style="padding:30px">
        
        <ul class="col s12 breadcrumb">
			<li><a style="padding-left:200px" href="{{URL::to('transaction/walkin-individual-bulk-orders-payment-customer-info')}}"><b>1.FILL-UP FORM</b></a></li>
			<li><a class="active" style="padding-left:200px" href="#payment-info"><b>2.PAYMENT</b></a></li>
			<li><a style="padding-left:200px" href="{{URL::to('transaction/walkin-individual-bulk-orders-payment-measure-detail')}}"><b>3.ADD MEASUREMENT DETAIL</b></a></li>
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

	       	<div class="col s12 left">
		        <a class="right btn-floating tooltipped btn-large green" data-position="bottom" data-delay="50"  data-tooltip="CLick to print a receipt for current transaction" href="#!" style="color:black; margin-right:35px; margin-left: 20px;"><i class="large mdi-action-print"></i></a>
		    </div>

	       	<div class="row" style="background-color:white;">
	       		<div class="container">
	            <div class="col s12"> 

	            	<div class="col s12" style="margin-bottom:20px">
	            	   <div style="color:gray; padding-left:140px;" class="input-field col s6">                 
                          <input value="" id="transac_no" name="transac_no" type="text" class="" readonly>
                          <label style="color:gray" for="transac_no">Transaction #: </label>
                        </div>
                        <div style="color:gray; padding-left:140px;" class="input-field col s6">                 
                          <input value="" id="transac_date" name="transac_date" type="date" class="datepicker">
                          <label style="color:gray" for="transac_date">Date and Time: </label>
                        </div>
                    </div>


                    <label style="font-size:15px; color:black"><center>Order Summary</center></label>
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

					<div class="divider" style="margin-bottom:30px"></div>
		      		<div class="container">
			      			<div style="color:gray; padding-left:140px;" class="input-field col s12">                 
	                          <input value="" id="transac_no" name="transac_no" type="text" class="" readonly>
	                          <label style="color:red" for="transac_no">Total Amount: </label>
	                        </div>
	                        <div class="center col s6">
			          				<input name="modePayment" type="radio" class="filled-in" id="half_pay" />
	      							<label for="half_pay">Half-payment (Pay first 50%)</label>
		      				</div>
		      				<div class="center col s6">
				          			<input name="modePayment" type="radio" class="filled-in" id="full_pay" />
		      						<label for="full_pay">Full-payment</label>
		      				</div>
		      				<div style="color:gray; padding-left:140px;" class="input-field col s12">                 
	                          <input value="" id="transac_no" name="transac_no" type="text" class="" readonly>
	                          <label style="color:red" for="transac_no">Amount Payable: </label>
	                        </div>
		      				<div style="color:gray; padding-left:140px;" class="input-field col s12">                 
	                          <input value="" id="transac_no" name="transac_no" type="text" class="" readonly>
	                          <label style="color:red" for="transac_no">Remaining Balance: </label>
	                        </div>
                    </div>

                    <div class="container">
                    	
                    		<a href="{{URL::to('transaction/walkin-individual-bulk-orders-payment-measure-detail')}}" class="right btn tooltipped" data-position="top" data-delay="50" data-tooltip="Click to save payment information and get measured" style="background-color:teal; padding:9.5px; padding-bottom:45px; margin-top:20px;"><label style="font-size:15px; color:white">Start Measurement</label></a>
                    		<a href="#cancel-order" class="left btn modal-trigger tooltipped" data-position="top" data-delay="50" data-tooltip="Click to cancel current unsaved transaction and be transfered back to the shop" style="background-color:teal; padding:9.5px; padding-bottom:45px; margin-top:20px;"><label style="font-size:15px; color:white">Cancel Transaction</label></a>
                    			<div id="cancel-order" class="modal modal-fixed-footer" style="height:250px; width:500px; margin-top:80px">
									<h5><font color="red"><center><b>Warning!</b></center></font></h5>
										
										{!! Form::open() !!}
											<div class="divider" style="height:2px"></div>
											<div class="modal-content col s12">
												<div class="center col s4"><i class="mdi-alert-warning" style="color:red; font-size:60px"></i></div>
												<div class="col s8"><p style="font-size:18px">Are you sure? Doing this will delete current transaction.</p></div>
											</div>

											<div class="modal-footer col s12">
								                <a class="waves-effect waves-green btn-flat" href="{{URL::to('transaction/walkin-individual')}}"><font color="black">Yes</font></a>
								                <a href="{{URL::to('/transaction/walkin-individual-bulk-orders-payment-payment-info')}}" class="modal-action modal-close waves-effect waves-green btn-flat"><font color="black">No</font></a>
								            </div>
										{!! Form::close() !!}
								</div>
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