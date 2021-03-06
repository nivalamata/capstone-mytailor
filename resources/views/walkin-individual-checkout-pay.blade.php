@extends('layouts.master')

@section('content')


	<div class="row">
      <div class="col s12 m12 l12">
        <span class="page-title"><center><h3><b>Welcome to <font color="white">MyTailor</font></b></h3></center></span>
        <center><h5>Walk-in Individual - Payout</h5></center>
      </div> 
    </div>

	<div class="row" style="padding:30px">
        <div class="col s12" style="padding-left:15%">
	        <ul class="breadcrumb">
				<li><a>1. Fill-up form</a></li>
				<li><a>2. Add measurement detail</a></li>
				<li><a class="active" href="#payment-info">3. Payment</a></li>
			</ul>
		</div>

		<!-- Tab for Payment-->
	    <div id="payment-info" class = "hue col s12 active" style="background-color: white; border:2px outset">
	        <div class="row">
		        <div class="col s12 m12 l12">
                	<span class="page-title" style="margin:15px"><center><h5><b>Payment Information</b></h5></center></span>
              		<div class="divider" style="height:1px; background-color:#80d8ff"></div>
              		<div class="divider" style="height:1px; background-color:#80d8ff"></div>
              	</div>
	       	</div>

	       <!-- 	<div class="col s12 left">
		        <a href="{{ URL::to('generate-payment-receipt') }}" class="right btn-floating tooltipped btn-large green" data-position="bottom" data-delay="50"  data-tooltip="CLick to print a receipt for current transaction" href="#!" style="color:black; margin-right:35px; margin-left: 20px;"><i class="large mdi-action-print"></i></a>
		    </div>
 -->
	       	<div class="row" style="background-color:white; padding:40px">
	            <div class="col s12"> 

	            	<div class="col s12" style="margin-bottom:20px">
	            		<div class="col s6">
	            			<div class="col s6" style="color:gray;padding-left:50px;padding-top:15px"><p>Transaction No.:</p></div>
			      			<div class="col s6" style="color:red;"><p><input value="{{ $joID }}" id="transac_no" name="transac_no" type="text" class="" readonly></p></div>
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
					
					<label style="font-size:23px; color:teal;"><center><b>ORDER SUMMARY</b></center></label>
					<div class="col s12 overflow-x" style="min-height:300px; max-height:550px; border: 3px gray solid; padding:10px">
						<div class="col s12">		                    
		                        <div class="col s12" style="margin-bottom:30px"></div>
		                        <table class="table centered" border="1">
		                        	<thead style="border:1px teal solid; background-color:rgba(54, 162, 235, 0.5)">
		                        		<tr style="border:1px teal solid">
		                        			<th style="border:1px teal solid">Quantity</th>
		                        			<th colspan="3" style="border:1px teal solid">Description</th>
		                        			<th style="border:1px teal solid; border-bottom:none">Unit Price</th>
		                        			<th style="border:1px teal solid">Total Price</th>
		                        		</tr>
		                        		<tr style="border:1px teal solid">
		                        			<th style="border:1px teal solid; border-top:none"></th>
		                        			<th style="border:1px teal solid" colspan="2">Item Name</th>
		                        			<th style="border:1px teal solid">Price</th>
		                        			<th style="border:1px teal solid"></th>
		                        			<th style="border:1px teal solid"></th>
		                        		</tr>
		                        	</thead>
		                        	<tbody style="border:1px teal solid">
		                        	@for($i = 0; $i < count($values); $i++)
		                        		<tr style="border:1px teal solid">
		                        			<td style="border:1px teal solid; background-color:rgba(52, 162, 232, 0.2)"><b>{{ $quantities[$i] }}</b></td>
		                        			<td style="border:1px teal solid; padding-left:5%; padding-right:5%; background-color:rgba(52, 162, 232, 0.2)"><b>{{ $values[$i]['strGarmentCategoryName'] }}, {{ $values[$i]['strSegmentName'] }}</b></td>
		                        			<td style="padding-left:2%; padding-right:2%; background-color:rgba(52, 162, 232, 0.2)"></td>
		                        			<td style="border:1px teal solid; background-color:rgba(52, 162, 232, 0.2)"><b>P {{ number_format( $values[$i]['dblSegmentPrice'] , 2)}}</b></td>
		                        			<td style="border:1px teal solid; background-color:rgba(52, 162, 232, 0.2)"><b>P {{ number_format(($unitPrice[$i]) , 2) }}</b></td>
		                        			<td style="border:1px teal solid; background-color:rgba(52, 162, 232, 0.2)"><b>P {{ number_format(($lineTotal[$i]) , 2) }}</b></td>
		                        		</tr>
		                        		<!-- <tr>
		                        			<td style="border-left:1px teal solid;"></td>
		                        			<td style="border:1px teal solid; color:black; padding-left:10%; padding-top:1%; padding-bottom:1%; color:black"><b></b></td>
		                        			<td style="padding-top:1%; padding-bottom:1%; border:1px teal solid"><b>Fabric Name</b></td>
		                        			<td style=""></td>
		                        			<td style="border:1px teal solid"></td>
		                        			<td style="border:1px teal solid"></td>
		                        		</tr> -->
		                        		<tr style="border:1px teal solid">
		                        			<td style="border:1px teal solid"></td>
		                        			<td style="border:none; color:teal; padding-left:10%">Fabric Name</td>
		                        			<td style="padding-left:4%; padding-right:4%; border:1px teal solid">{{ $values[$i]['strFabricName'] }}</td>
		                        			<td style="border:1px teal solid">P {{ number_format($values[$i]['dblFabricPrice'], 2) }}</td>
		                        			<td style="border:1px teal solid"></td>
		                        			<td style="border:1px teal solid"></td>
		                        		</tr>
		                        		<!-- <tr>
		                        			<td style="border-left:1px teal solid"></td>
		                        			<td style="border:1px teal solid; color:black; padding-left:10%; padding-top:1%; padding-bottom:1%; color:black"><b>Style Name</b></td>
		                        			<td style="padding-top:1%; padding-bottom:1%; border:1px teal solid"><b>Segment Pattern</b></td>
		                        			<td style=""></td>
		                        			<td style="border:1px teal solid"></td>
		                        			<td style="border:1px teal solid"></td>
		                        		</tr> -->
		                        		@for($j = 0; $j < count($styles[$i]); $j++)
											@if($styles[$i][$j]->strSegmentID == $values[$i]['strSegmentID'])
		                        		<tr style="border:1px teal solid">
		                        			<td style="border:1px teal solid"></td>
		                        			<td class="right" style="border:none; color:teal; padding-right:10%">Style Name and Pattern</td>
		                        			@if($styleFabric[$i][$j]->strFabricName != $values[$i]['strFabricName'])
		                        			<td style="border:1px teal solid">{{ $styles[$i][$j]->strSegStyleName }} <br> <font color="gray"><b><i>{{ $styles[$i][$j]->strSegPName }} ({{ $styleFabric[$i][$j]->strFabricName}})</i></b></font></td>
		                        			@elseif($styleFabric[$i][$j]->strFabricName == $values[$i]['strFabricName'])
		                        			<td style="border:1px teal solid">{{ $styles[$i][$j]->strSegStyleName }} <br> <font color="gray"><b><i>{{ $styles[$i][$j]->strSegPName }}</i></b></font></td>
		                        			@endif
		                        			@if($styleFabric[$i][$j]->strFabricName != $values[$i]['strFabricName'])
		                        			<td style="border:1px teal solid">P {{ number_format(($styles[$i][$j]->dblPatternPrice + $styleFabric[$i][$j]->dblFabricPrice), 2) }}</td>
		                        			@elseif($styleFabric[$i][$j]->strFabricName == $values[$i]['strFabricName'])
		                        			<td style="border:1px teal solid">P {{ number_format($styles[$i][$j]->dblPatternPrice, 2) }}</td>
		                        			@endif
		                        			<td style="border:1px teal solid"></td>
		                        			<td style="border:1px teal solid"></td>
		                        			@endif
										@endfor
		                        		</tr>
		                        	@endfor
		                        	</tbody>
		                        </table>
		                        <!-- <table class = "table centered order-summary z-depth-1" border = "1">
				       				<thead style="color:gray">
					          			<tr style="border-top:1px black solid; border-bottom:1px black solid; background-color:teal; color:white">
						                  <th colspan="1" data-field="labor-price-per-segment" style="border-right:1px black solid">Quantity</th>
						                  <th colspan="1" data-field="product" style="border-right:1px black solid; border-left:1px black solid">Product</th> 
						                  <th colspan="1" data-field="fabric" style="border-right:1px black solid">Fabric</th>
						                  <th colspan="1" data-field="base-price" style="border-right:1px black solid">Base Price</th>
						                  <th colspan="3" data-field="description" style="border-right:1px black solid">Description</th>  
						                  <th colspan="1" data-field="style-price-total" style="border-right:1px black solid">Style Price Total</th>
						                  
						                  <th colspan="1" data-field="line-total" style="border-right:1px black solid">Line Total</th>        
						             </tr>
						             <tr style="border-top:1px black solid; border-bottom:1px black solid; background-color:teal; color:white">
						             	<th style="border:1px black solid"></th>
						             	<th style="border:1px black solid"></th>
						             	<th style="border:1px black solid"></th>
						             	<th style="border:1px black solid"></th>
						             	<th style="border:1px black solid">Style Category</th>
						             	<th style="border:1px black solid">Segment Pattern</th>
						             	<th style="border:1px black solid">Style Price</th>
						             	<th style="border:1px black solid"></th>
						             	<th style="border:1px black solid"></th>
						             </tr>

					              	</thead>
					              	<tbody>
					              		@for($i = 0; $i < count($values); $i++)
								            <tr style="border-top:1px black solid; border-bottom:1px black solid">
								                <td style="border-right:1px black solid; border-left:1px black solid">{{ $quantities[$i] }}</td>
								                <td style="border-right:1px black solid">{{ $values[$i]['strGarmentCategoryName'] }}, {{ $values[$i]['strSegmentName'] }}</td>
												<td style="border-right:1px black solid">{{ $values[$i]['strFabricName'] }}</td>
								                <td style="border-right:1px black solid">{{ number_format(($values[$i]['dblSegmentPrice'] + $values[$i]['dblFabricPrice']) , 2) }} PHP</td>
												
												<td style="border-right:1px black solid">
													@for($j = 0; $j < count($styles[$i]); $j++)
														@if($styles[$i][$j]->strSegmentID == $values[$i]['strSegmentID'])
															{{ $styles[$i][$j]->strSegStyleName }}<br>
														@endif
													@endfor
												</td>
												<td style="border-right:1px black solid">
													@for($j = 0; $j < count($styles[$i]); $j++)
														@if($styles[$i][$j]->strSegmentID == $values[$i]['strSegmentID'])
															{{ $styles[$i][$j]->strSegPName }}<br>
														@endif
													@endfor
												</td>
												<td style="border-right:1px black solid">
													@for($j = 0; $j < count($styles[$i]); $j++)
														@if($styles[$i][$j]->strSegmentID == $values[$i]['strSegmentID'])
															{{ number_format($styles[$i][$j]->dblPatternPrice, 2) }} PHP <br>
														@endif
													@endfor
												</td>

												<td style="border-right:1px black solid">{{ number_format($style_total[$i]['dblPatternPrice'] , 2) }} PHP</td>
												
												<td style="border-right:1px black solid">{{ number_format(($lineTotal[$i]) , 2) }} PHP</td>
										

											@endfor       
								            </tr>						            		
							           

							        </tbody>
							    </table> -->					
						</div>
						<div class="col s12" style="margin-bottom:38px"></div>
					</div>

					<div class="col s12" style="margin:10px"></div>
					{!! Form::open(['url' => 'transaction/walkin-individual-save-order', 'method' => 'POST']) !!}
						<div class="col s6">
							<h5 style="color:teal"><b>Price Quotation*</b></h5>
							<span>Determine terms of payment to get payment details</span>

							<!--Eto yung mga pinapadagdag non sa Capstone-->
							<!--Ikinoment ko muna dahil hindi naman yata pina-require sa soft eng..... ADD NOTE: Dahil tapos na ang SOFTENG!!!-->
							
							<div class="col s12 z-depth-2" style=" padding:2%; margin-top:2%">
								
								<div class="col s12">
									<div class="col s4" style="color:gray; font-size:15px"><p><b>Total Amount Due</b></p></div>
			      					<div class="col s8" style="color:black;"><p><input id="total_due" name="total_due" type="text" class="" readonly /></p></div>
								</div>

								<div class="col s12">
									<div class="col s4" style="color:grey; font-size:10px"><p><b>Labor Fee Inclusive</b>
										<b style="color:gray; font-size:15px">Estimated Total Sales</b></p>
									</div>
			      					<div class="col s8" style="color:black;"><p><input id="estimated_total" name="estimated_total" type="text" class="" readonly /></p></div>
								</div>

								<div class="col s12">
									<div class="col s4" style="color:gray; font-size:15px"><p><b>VAT ( {{$vat}}% )</b></p></div>
			      					<div class="col s8" style="color:black;"><p><input id="vat_total" name="vat_total" type="text" class="" readonly /></p></div>
								</div>

								<!--<div class="col s12">
									<div class="col s4" style="color:gray; font-size:15px"><p><b>Total Labor Price</b></p></div>
			      					<div class="col s8" style="color:black;"><p><input id="labor_price_total" name="labor_price_total" type="text" class="" readonly /></p></div>
								</div>
								
								<div class="col s12">
									<div class="col s4" style="color:gray; font-size:15px"><p><b>Additional Fee</b></p></div>
			      					<div class="col s8" style="color:black;"><p><input id="addtnl_fee" name="addtnl_fee" type="text" class="" readonly /></p></div>
								</div>-->

							</div>

							<div class="col s12"><div class="divider" style="margin:15px; height:5px"></div></div>
							
							<!-- <div class="col s4" style="color:gray; font-size:15px"><p><b>Total Labor Price</b></p></div>
			      			<div class="col s8" style="color:gray;"><p><input id="style_price_total" name="style_price_total" type="text" class="" readonly><b></b></p></div> -->

			      			<!--<div class="col s12" style="color:grey; font-size:10px"><p><b>12% VAT Inclusive</b></p></div>-->
			      			<div class="col s4" style="color:black; font-size:15px"><p><b>Grand Total</b></p></div>
			      			<div class="col s8" style="color:black;"><p><input id="total_price" name="total_price" type="text" class="" readonly style="font-size:3em"></p></div>
			      			<input id="total_price_hidden" name="total_price_hidden" type="hidden" class="">

                        	<div class="col s4" style="color:gray; font-size:15px"><p><b>Terms of Payment</b></p></div>
                        	<div class="col s8" style="padding:18px; padding-top:30px">
	                        	<div class="col s6">
			          				<input name="termsOfPayment" value="Half Payment" type="radio" class="filled-in payment" id="half_pay"/>
	      							<label for="half_pay">Half (50%)</label>
								</div>
								<div class="col s6">
				          			<input name="termsOfPayment" value="Full Payment" type="radio" class="filled-in payment" id="full_pay" />
		      						<label for="full_pay">Full (100%)</label>
		      					</div>
								<div class="col s12 center" style="padding:18px; padding-top:20px">
				          			<input name="termsOfPayment" value="Specific Amount" type="radio" class="filled-in payment" id="specify_pay" />
		      						<label for="specify_pay">Specify Amount</label>
		      					</div>
	      					</div>
							
							<input type="hidden" id="transaction_date" name="transaction_date" />

		      				<!-- <div class="col s4" style="color:gray; font-size:15px"><p><b>Amount Payable</b></p></div>
		      				<div class="col s8" style="color:red;"><p><input value="" id="amount-payable" name="amount-payable" type="text" class="" readonly></p></div>

		      				<div class="col s4" style="color:gray; font-size:15px"><p><b>Additional Charge (*)</b></p></div>
		      				<div class="col s8" style="color:red;"><p><input value="" id="add-charge" name="add-charge" type="text" class="" readonly></p></div> 

		      				<div class="col s4" style="color:gray; font-size:15px"><p><b>Remaining Balance</b></p></div>
		      				<div class="col s8" style="color:red;"><p><input value="" id="balance" name="balance" type="text" class="" readonly></p></div>		
 -->
						</div>

						<div class="col s6 z-depth-1"  style="border-left:2px gray solid">
							<h5 style="color:teal"><b>Payment</b></h5>
							<span>Fill up the following information</span>
							<div class="col s12"><div class="divider" style="margin:15px"></div></div>

	                        <div style="color:black" class="col s12"> 
								<div class="col s4"><p style="color:black; margin-top:5px; font-size:15px"><b>Amount To Pay:</b></p></div>                
	                          	<div class="col s8"><b><input  style="padding:5px; border:3px gray solid; font-size:1.5em" id="amount-payable" name="amount-payable" type="text" class="right"></b></div>
	                          	<input id="amount-payable-hidden" name="amount-payable-hidden" type="hidden" class="">
	                        </div>

	                        <div style="color:black" class="col s12"> 
								<div class="col s4"><p style="color:black; margin-top:5px; font-size:15px"><b>Outstanding Balance*:</b></p></div>                
	                          	<div class="col s8" style="color:black;"><b><input readonly style="padding:5px; border:3px gray solid; font-size:1.5em" id="balance" name="balance" type="text" class="right"></b></div>
	                          	<input id="balance-hidden" name="balance-hidden" type="hidden" class="">
	                        </div>

	                        <div style="color:black" class="col s12"> 
								<div class="col s4"><p style="color:black; margin-top:5px; font-size:15px"><b>Amount Tendered:</b></p></div>                
	                          	<div class="col s8"><input style="padding:5px; border:3px gray solid; font-size:1em" name="amount-tendered" id="amount-tendered" type="text" class="right"><right></right></div>	     	                          
	                        </div>

	                        <div style="color:black" class="col s12"> 
								<div class="col s4"><p style="color:black; margin-top:5px; font-size:15px"><b>Change*:</b></p></div>                
	                          	<div class="col s8" style="color:black;"><input readonly style="padding:5px; border:3px gray solid; font-size:1em" name="amount-change" id="amount-change" type="text" class="right"></div>
	                          	<input name="amount-change-hidden" id="amount-change-hidden" type="hidden" class="">
	                        </div>


							<input type="hidden" id="Date" name="Date">
							<input type="hidden" id="dueDate" name="dueDate" />
							<input type="hidden" id="deliveryDate" name="deliveryDate" />

							<div class="col s12"><div class="divider" style="padding-top:10px"></div></div>								
								<!-- <div class="modal-content col s12" style="padding-bottom:20px;">
										<div class="col s5" style="padding-top:10px"><h5><font color="teal"><center><b>Due Date</b></center></font></h5></div>
										<div class="col s7"><p style="font-size:20px" ><b id="due-date"></b></p></div>

										<div class="col s12" style="padding-left:10px"><p style="color:gray;">Pay balance on (or before) the said due date above</p></div>
								</div> -->
	                        <!--<div class="right col s12" style="padding:18px"><a style="margin-top:5px; background-color:red" type="submit" class="right waves-effect waves-green btn modal-trigger tooltipped z-depth-2" data-position="bottom" data-delay="50" data-tooltip="Click to continue payment process" href="#due-date"><font color="white" size="+1">Pay for Order</font></a>		
								<div id="due-date" class="modal modal-fixed-footer" style="height:250px; width:500px; margin-top:50px">
										<h5><font color="red"><center><b>Reminder:</b></center></font></h5>	
										<div class="col s12"><div class="divider" style="padding-top:50px"></div></div>								
											<div class="modal-content col s12" style="padding:40px;">
												<div class="col s5" style="padding-top:10px"><h5><font color="teal"><center><b>Due Date</b></center></font></h5></div>
												<div class="col s7"><p style="font-size:20px"><b>August 16,2016</b></p></div>

												<div class="col s12" style="padding-left:10px"><p style="color:gray;">Pay balance on (or before) the said due date above</p></div>
											</div>

											<div class="modal-footer col s12">
												<p class="left" style="margin-left:10px; color:gray; font-size:15px">Continue with payment?</p>
								                <button type="submit" class="modal-action modal-close waves-effect waves-green btn-flat" ><font color="black">Yes</font></button>
								                <a class="modal-action modal-close waves-effect waves-green btn-flat"><font color="black">No</font></a>
								            </div>

								</div>
								
							</div>-->			
						</div>


                    		<!--start of bottom button-->
                    		<div class="col s12" style="margin-top:20px">
	                    		<button type="submit" class="right btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click to save data and proceed to next step" style="margin-left:40px; background-color:#00695c; color:white"><b><i class="mdi-navigation-check" style="padding-right:10px"></i>Save Order</b></button> 
									
									<!-- <div class="col s12" style="margin-top:30px">
							              <div  id="confirm-submission" class="modal modal-fixed-footer" style="height:300px; width:500px; margin-top:80px">
							                  <h5><font color="black"><center><b>Warning!</b></center></font></h5>
							                 
							                      <div class="divider" style="height:2px"></div>
							                        <div class="modal-content col s12">
							                          <div class="center col s4"><i class="mdi-alert-warning" style="color:green; font-size:60px"></i></div>
							                          <div class="col s8"><p style="font-size:18px">Print Receipt</p></div>
							                        </div>

							                      <div class="modal-footer col s12">
							                          <button type="submit"  href="{{ URL::to('/transaction/walkin-individual') }}" class="modal-action modal-close waves-effect waves-green btn-flat"><font color="black">OK</font></button>
							                      </div>
							                </div>
							        </div> -->
			{!! Form::close() !!}   
							<!--end of bottom button-->
	            			</div>	
	        </div>

	        <div class="col s12"><div class="divider" style="height:2px; margin-bottom:20px; margin-top:30px"></div></div>
	      	
	      	<center><p><font color="gray">End of Payment Information Form</font></p></center>
	
	    </div>
	    <!-- End of Tab for Payment-->

	</div>

@stop

@section('scripts')

	<script type="text/javascript">
		$(document).ready(function(){
			$('select').material_select();

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

			var a = {!! json_encode($values) !!};
			var b = {!! json_encode($styles) !!};
			var c = {!! json_encode($lineTotal) !!};
			var d = {!! json_encode($vat) !!};

			var totalAmount = 0.00;
			var minDays = 0;
			var laborTotal = 0.00;
			var addtnlFees = 0.00;
			var grandtotal = 0.00;

			//grand total
			for(var i = 0; i < a.length; i++){
				grandtotal += c[i];
				minDays += a[i].intMinDays;
			}

			var due = grandtotal;
			var vat = 0.00;
			var vatValue;
			vatValue = d;
			vatValue = vatValue / 100;
			vat = grandtotal * vatValue;
			totalAmount = grandtotal - vat;

			var monthNames = [ "January", "February", "March", "April", "May", "June",
		    "July", "August", "September", "October", "November", "December" ];
			var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

			var newDate = new Date();
			var dueDate = new Date();
			var deliveryDate = new Date();

			/*Date.prototype.addDays = function(days)
			{
			    var dueDate = new Date();
			    dueDate.setDate(dueDate.getDate() + days);
			    return dueDate;
			}*/
			var parameter = minDays + 2;

			newDate.setDate(newDate.getDate());   
			dueDate.setDate(newDate.getDate()+minDays);
			deliveryDate.setDate(newDate.getDate()+parameter);

			function commaSeparateNumber(val){
			    while (/(\d+)(\d{3})/.test(val.toString())){
			      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			    }
			    return val;
			 }
			 //alert(dueDate.getFullYear() + "-" +  (dueDate.getMonth()+1) + "-" + dueDate.getDate());
			$('#estimated_total').val(commaSeparateNumber(totalAmount.toFixed(2)));
			$('#total_price').val(commaSeparateNumber(grandtotal.toFixed(2)));
			$('#total_price_hidden').val(grandtotal.toFixed(2));
			$('#vat_total').val(commaSeparateNumber(vat.toFixed(2)));
			$('#total_due').val(commaSeparateNumber(due.toFixed(2)));
			//$('#due-date').text(dayNames[dueDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
			//$('#transaction_date').val(monthNames[(newDate.getMonth())] + " " + newDate.getDate() + ", " + newDate.getFullYear());
			$('#dueDate').val(dueDate.getFullYear() + "-" +  (dueDate.getMonth()+1) + "-" + dueDate.getDate());
			$('#deliveryDate').val(deliveryDate.getFullYear() + "-" +  (deliveryDate.getMonth()+1) + "-" + deliveryDate.getDate());
		});
	</script>

	<script>
		$('.payment').change(function(){
				$('#amount-payable').prop('readonly', false);
				$('#amount-payable').val('');
				$('#balance').val('');

				function commaSeparateNumber(val){
				    while (/(\d+)(\d{3})/.test(val.toString())){
				      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
				    }
				    return val;
				 }

				if($('#half_pay').prop("checked")){

					var a = {!! json_encode($values) !!};
					var c = {!! json_encode($lineTotal) !!};
					var grandtotal = 0.00;

					for(var i = 0; i < a.length; i++){
						grandtotal += c[i];
					}
					
					$('#amount-payable').val(commaSeparateNumber((grandtotal/2).toFixed(2)));
					$('#amount-payable-hidden').val((grandtotal/2).toFixed(2));
					$('#amount-payable').prop('readonly', true);
					$('#balance').val(commaSeparateNumber((grandtotal - (grandtotal/2)).toFixed(2)));
					$('#balance-hidden').val((grandtotal - (grandtotal/2)).toFixed(2));
				}

				if($('#full_pay').prop("checked")){

					var a = {!! json_encode($values) !!};
					var c = {!! json_encode($lineTotal) !!};
					var grandtotal = 0.00

					for(var i = 0; i < a.length; i++){
						grandtotal += c[i];
					}
					
					$('#amount-payable').val(commaSeparateNumber(grandtotal.toFixed(2)));
					$('#amount-payable-hidden').val(grandtotal.toFixed(2));
					$('#amount-payable').prop('readonly', true);
					$('#balance').val(commaSeparateNumber((grandtotal - grandtotal).toFixed(2)));
					$('#balance-hidden').val((grandtotal - grandtotal).toFixed(2));
				}

				if($('#specify_pay').prop("checked")){
					//$("#amount-payable").removeAttr('readonly');
					//$('#amount-payable').prop('readonly', false);
				}
		});

		$('#amount-tendered').blur(function(){	
			var tendered = $('#amount-tendered').val();

			function parsePotentiallyGroupedFloat(stringValue) {
			    stringValue = stringValue.trim();
			    var result = stringValue.replace(/[^0-9]/g, '');
			    if (/[,\.]\d{2}$/.test(stringValue)) {
			        result = result.replace(/(\d{2})$/, '.$1');
			    }
			    return parseFloat(result);
			}

			function commaSeparateNumber(val){
			    while (/(\d+)(\d{3})/.test(val.toString())){
			      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
			    }
			    return val;
			 }

			var payable = parsePotentiallyGroupedFloat($('#amount-payable').val());

			if(tendered == ''){
				$('#amount-change').val('');
			}else {
				var amountChange = $('#amount-tendered').val() - payable;
				$('#amount-change').val(commaSeparateNumber(amountChange.toFixed(2)));
				$('#amount-change-hidden').val(amountChange.toFixed(2));
			}
		});

		$('#amount-payable').blur(function(){	
			// if($('#amount-to-pay').val() > $('#total_price').val()){
			// 	alert("You can't choose to pay more than the total.");
			// 	$('#amount-to-pay').val("");
			// }
				/*var amountChange = $('#amount-tendered').val() - $('#amount-payable').val();
				$('#amount-change').val(amountChange.toFixed(2));	
				// $('#outstanding-bal').val(($('#total_price').val() - $('#amount-to-pay').val()).toFixed(2) + ' PHP');*/
				var a = {!! json_encode($values) !!};
				var c = {!! json_encode($lineTotal) !!};
				var grandtotal = 0.00;

				for(var i = 0; i < a.length; i++){
					grandtotal += c[i];
				}

				var payable = $('#amount-payable').val();
				$('#amount-payable-hidden').val($('#amount-payable').val());

				if(event.which >= 37 && event.which <= 40){
			        event.preventDefault();
			    }

			    function commaSeparateNumber(val){
				    while (/(\d+)(\d{3})/.test(val.toString())){
				      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
				    }
				    return val;
				 }

			    if(payable == ''){
					$('#balance').val('');
				}else if(payable > grandtotal){
					alert("You can't pay more than the total.")
				}else{
					$('#balance').val(commaSeparateNumber((grandtotal - payable).toFixed(2)));	
					$('#balance-hidden').val((grandtotal - payable).toFixed(2));	
				}

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
	
	<script type="text/javascript">
		var monthNames = [ "January", "February", "March", "April", "May", "June",
	    "July", "August", "September", "October", "November", "December" ];
		var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

		var newDate = new Date();
		newDate.setDate(newDate.getDate());    
		$('#Date').html(dayNames[newDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
   	 	$('#transaction_date').val(newDate.getFullYear() + "-" +  (newDate.getMonth()+1) + "-" + newDate.getDate());

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
		$(document).ready(function(){
			$("#confirm-submission").on('click', function(){
				// window.open($this.)
			});
		});

	</script>

@stop