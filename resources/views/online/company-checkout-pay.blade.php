@extends('layouts.masterOnline')

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
				<li><a class="active" href="{{URL::to('company-checkout-pay')}}">3. Payment</a></li>
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
	            			<div class="col s2" style="color:gray;padding-top:15px"><p>Date:</div>
	                        <div class="col s10" id="Date" style="color:teal;padding-top:30px"></div>
                        </div>

                    </div>
					
					<label style="font-size:23px; color:teal;"><center><b>ORDER SUMMARY</b></center></label>
					<div class="col s12 overflow-x" style="min-height:300px; max-height:550px; border: 3px gray solid; padding:10px">
						<div class="col s12">	

		                        <div class="col s12" style="margin-bottom:30px"><!-- <div class="divider" style="height:2px; background-color:teal"></div> --></div>
		                        <table class="table centered" border="1">
		                        	<thead style="border:1px teal solid; background-color:rgba(54, 162, 235, 0.8)">
		                        		<tr style="border:1px teal solid">
		                        			<th style="border:1px teal solid">Quantity</th>
		                        			<th colspan="3" style="border:1px teal solid">Description</th>
		                        			<th style="border:1px teal solid; border-bottom:none"></th>
		                        			<th style="border:1px teal solid"></th>
		                        		</tr>
		                        		<tr style="border:1px teal solid">
		                        			<th style="border:1px teal solid; border-top:none"></th>
		                        			<th style="border:1px teal solid" colspan="2">Item Name</th>
		                        			<th style="border:1px teal solid">Package Price</th>
		                        			<th style="border:1px teal solid">Unit Price</th>
		                        			<th style="border:1px teal solid">Total Price</th>
		                        		</tr>
		                        	</thead>
		                        	<tbody style="border:1px teal solid">
		                        	
		                        		<tr style="border:1px teal solid">
		                        			<td style="border:1px teal solid; background-color:rgba(52, 162, 232, 0.2)"><b></b></td>
		                        			<td style="border:1px teal solid; padding-left:5%; padding-right:5%; background-color:rgba(52, 162, 232, 0.2)"><a class="btn-flat tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click to expand and see package details" onclick="packageDetail" style="color:black"><b></b></a></td>
		                        			<td style="border:1px teal solid; padding-left:2%; padding-right:2%; background-color:rgba(52, 162, 232, 0.2)"></td>
		                        			<td style="border:1px teal solid; padding-left:2%; padding-right:2%; background-color:rgba(52, 162, 232, 0.2)">{{ number_format($package_values[$i]->dblPackagePrice, 2) }} PHP</td>
		                        			<td style="border:1px teal solid; padding-left:2%; padding-right:2%; background-color:rgba(52, 162, 232, 0.2)">{{ number_format($package_values[$i]->dblPackagePrice * $package_quantity[$i] , 2) }}</b></td>
		                        			<td style="border:1px teal solid; padding-left:2%; padding-right:2%; background-color:rgba(52, 162, 232, 0.2)"><b>{{ number_format($style_total[$i] + $fabric_total[$i] + $segment_total[$i] + ($package_values[$i]->dblPackagePrice * $package_quantity[$i]), 2) }} PHP</b></td>
		                        		</tr>
		                        			                        	
		                        	</tbody>
		                        </table>			
						</div>

					<!--PACKAGE DETAIL WILL BE HERE-->
					
						<div class="card horizontal col s12 package-detail" id="package-detail{{ $i }}" style="display:none; margin-top:3%; padding-bottom:4%; border:1px #e0f2f1 outset;">
						<i class="right mdi-navigation-close tooltipped" data-poition="bottom" data-delay="50" data-tooltip="Click to close" onclick="packageClose({{$i}})" style="font-size:30px"></i>
							<center><h7 style="padding-top:1%"><b>Package Detail for <font color="teal">{{ $package_values[$i]->strPackageName}}</font></b></h7></center>
							<table class="table centered z-depth-1">
								<thead style="background-color:rgba(255, 99, 132, 0.2)">
									<tr>
										<th style="border:1px rgba(255, 99, 132, 1) solid">Quantity</th>
										<th style="border:1px rgba(255, 99, 132, 1) solid" colspan="3">Description</th>
										<th style="border:1px rgba(255, 99, 132, 1) solid">Unit Price</th>
										<th style="border:1px rgba(255, 99, 132, 1) solid">Total Price</th>
									</tr>
									<tr>
										<th style="border:1px rgba(255, 99, 132, 1) solid"></th>
										<th style="border:1px rgba(255, 99, 132, 1) solid">Item</th>
										<th style="border:1px rgba(255, 99, 132, 1) solid"></th>
										<th style="border:1px rgba(255, 99, 132, 1) solid">Price</th>
										<th style="border:1px rgba(255, 99, 132, 1) solid"></th>
										<th style="border:1px rgba(255, 99, 132, 1) solid"></th>
									</tr>
								</thead>
								<tbody>								
		                        		
			                        		<tr style="border:1px teal solid">
			                        			<td style="border:1px teal solid; background-color:rgba(52, 162, 232, 0.2)">{{ $segment_qty[$i][$j] }}</td>
			                        			<td style="border:none; background-color:rgba(52, 162, 232, 0.2)">{{ $package_segments[$i][$j]->strSegmentName }}</td>
			                        			<td style="border:1px teal solid; padding-top:0; padding-bottom:0; background-color:rgba(52, 162, 232, 0.2)"><br> <font color="gray"><b><i></i></b></font></td>
			                        			<td style="border:1px teal solid; padding-top:0; padding-bottom:0; background-color:rgba(52, 162, 232, 0.2)">{{ number_format($package_segments[$i][$j]->dblSegmentPrice, 2) }} PHP</td>
			                        			<td style="border:1px teal solid; padding-top:0; padding-bottom:0; background-color:rgba(52, 162, 232, 0.2)">{{ number_format($package_segments[$i][$j]->dblSegmentPrice + $segment_fabrics[$i][$j]->dblFabricPrice + $unit_style[$i][$j]  + $unit_style_fabric[$i][$j], 2) }} PHP</td>
			                        			<td style="border:1px teal solid; padding-top:0; padding-bottom:0; background-color:rgba(52, 162, 232, 0.2)">{{ number_format(($package_segments[$i][$j]->dblSegmentPrice + $segment_fabrics[$i][$j]->dblFabricPrice +  $unit_style[$i][$j] + $unit_style_fabric[$i][$j]) * $segment_qty[$i][$j], 2) }} PHP</td>
			                        			
			                        		</tr>
			                        		<tr style="border:1px teal solid">
			                        			<td style="border:1px teal solid"></td>
			                        			<td class="right" style="border:none; color:teal; padding-right:10%">Fabric Name</td>
			                        			<td style="border:1px teal solid">{{ $segment_fabrics[$i][$j]->strFabricName }}</td>
			                        			<td style="border:1px teal solid">{{ number_format($segment_fabrics[$i][$j]->dblFabricPrice, 2)}} PHP</td>
			                        			<td style="border:1px teal solid"></td>
			                        			<td style="border:1px teal solid"></td>		                        			
		                        			</tr>
				                        	<tr style="border:1px teal solid">
				                        		<td style="border:1px teal solid"></td>
				                        		<td class="right" style="border:none; color:teal; padding-right:10%">Style name and pattern (with custom fabric)</td>
				                        		<td style="border:1px teal solid">
				                        		<br> 
					                        			<font color="gray"><b><i></i></b></font><br>
													br> 
					                        			<font color="gray"><b><i></i></b></font><br>
														
				                        		</td>
				                        		<td style="border:1px teal solid">
				                        			
					                        			PHP<br>
													
				                        			
				                        		</td>
				                        		<td style="border:1px teal solid"></td>
				                        		<td style="border:1px teal solid"></td>		                        			
			                        		</tr>
							
									
								</tbody>
							</table>
						</div>
						
			
					<div class="col s12" style="margin-bottom:38px"></div>
					</div>


					<div class="col s12" style="margin:10px"></div>
				
						<div class="col s6">
							<h5 style="color:teal"><b>Price Quotation*</b></h5>
							<span>Determine terms of payment to get payment details</span>

							<!--Eto yung mga pinapadagdag non sa Capstone-->
							<!--Ikinoment ko muna dahil hindi naman yata pina-require sa soft eng..... ADD NOTE: Dahil tapos na ang SOFTENG!!!-->
							
							<div class="col s12 z-depth-2" style=" padding:2%; margin-top:2%">
								
								<div class="col s12">
									<div class="col s4" style="color:gray; font-size:15px"><p><b>Estimated Total Sales</b></p></div>
			      					<div class="col s8" style="color:gray;"><p><input id="estimated_total_sales" name="estimated_total_sales" type="text" class="" readonly><b></b></p></div>
								</div>

								<div class="col s12">
									<div class="col s4" style="color:gray; font-size:15px"><p><b>VAT ({{ $vat }}%)</b></p></div>
			      					<div class="col s8" style="color:gray;"><p><input id="vat_price" name="vat_price" type="text" class="" readonly><b></b></p></div>
								</div>

							</div>

							<div class="col s12"><div class="divider" style="margin:15px; height:5px"></div></div>
							
							

			      			<div class="col s4" style="color:black; font-size:15px"><p><b>Grand Total</b></p></div>
			      			<div class="col s8" style="color:black;"><p><input id="total_price" name="total_price" type="text" class="" readonly style="font-size:3em"></p></div>
							<input type="hidden" name="hidden_total_price" id="hidden_total_price">						

                        	<div class="col s4" style="color:gray; font-size:15px"><p><b>Terms of Payment</b></p></div>
                        	<div class="col s8" style="padding:18px; padding-top:30px">
	                        	<div class="col s6">
			          				<input checked name="termsOfPayment" value="Half Payment" readonly type="radio" class="filled-in payment" id="half_pay"/>
	      							<label for="half_pay">Half (50%)</label>
								</div>
								<div class="col s6">
				          			<input name="termsOfPayment" value="Full Payment" readonly type="radio" class="filled-in payment" id="full_pay" />
		      						<label for="full_pay">Full (100%)</label>
		      					</div>
								<div class="col s12 center" style="padding:18px; padding-top:20px">
				          			<input name="termsOfPayment" value="Specific Amount" type="radio" class="filled-in payment" id="specify_pay" />
		      						<label for="specify_pay">Specify Amount</label>
		      					</div>
	      					</div>

		      						
 -->
						</div>

						<div class="col s6 z-depth-1"  style="border-left:2px gray solid">
							<h5 style="color:teal"><b>Payment</b></h5>
							<span>Fill up the following information</span>
							<div class="col s12"><div class="divider" style="margin:15px"></div></div>

	                        <div style="color:black" class="col s12"> 
								<div class="col s4"><p style="color:black; margin-top:5px; font-size:15px"><b>Amount To Pay:</b></p></div>                
	                          	<div class="col s8"><b><input readonly style="padding:5px; border:3px gray solid; font-size:1.5em" id="amount-payable" name="amount-payable" type="text" class="right"></b></div>
	                        	<input type="hidden" id="hidden-amount-payable" name="hidden-amount-payable">
	                        </div>

	                        <div style="color:black" class="col s12"> 
								<div class="col s4"><p style="color:black; margin-top:5px; font-size:15px"><b>Outstanding Balance*:</b></p></div>                
	                          	<div class="col s8" style="color:black;"><b><input readonly style="padding:5px; border:3px gray solid; font-size:1.5em" id="balance" name="balance" type="text" class="right"></b></div>
	                        	<input type="hidden" name="hidden-balance" id="hidden-balance">
	                        </div>

	                        <div style="color:black" class="col s12"> 
								<div class="col s4"><p style="color:black; margin-top:5px; font-size:15px"><b>Amount Tendered:</b></p></div>                
	                          	<div class="col s8"><input style="padding:5px; border:3px gray solid; font-size:1em" name="amount-tendered" id="amount-tendered" type="number" class="right"><right></right></div>	                          
	                        </div>

	                        <div style="color:black" class="col s12"> 
								<div class="col s4"><p style="color:black; margin-top:5px; font-size:15px"><b>Change*:</b></p></div>                
	                          	<div class="col s8" style="color:black;"><input readonly style="padding:5px; border:3px gray solid; font-size:1em" name="amount-change" id="amount-change" type="text" class="right"></div>
	                        </div>


							<input type="hidden" id="transaction_date" name="transaction_date">
							<input type="hidden" id="due_date" name="due_date">

							<div class="col s12"><div class="divider" style="padding-top:10px"></div></div>								
										
						</div>


                    		<!--start of bottom button-->
                    		<div class="col s12" style="margin-top:20px">
	                    		<button type="submit" class="right btn tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click to save data and proceed to next step" style="margin-left:40px; background-color:#00695c; color:white"><b><i class="mdi-navigation-check" style="padding-right:10px"></i>Save Order</b></button> 
									
									
	            			</div>	
	        </div>

	        <div class="col s12"><div class="divider" style="height:2px; margin-bottom:20px; margin-top:30px"></div></div>
	      	
	      	<center><p><font color="gray">End of Payment Information Form</font></p></center>
	
	    </div>
	    <!-- End of Tab for Payment-->

	</div>

@stop

