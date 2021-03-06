@extends('layouts.master')

@section('content')


	<div class="row">
      <div class="col s12 m12 l12">
        <span class="page-title"><center><h3><b>Welcome to <font color="white">MyTailor</font></b></h3></center></span>
        <center><h5>Walk-in Company</h5></center>
      </div>
    </div>

    <div class="row" style="padding:5%; padding-bottom:5%">	
		<div id="payment-info" class = "hue col s12 active" style="background-color: white; border:2px outset">
	        <div class="row">
		        <div class="col s12 m12 l12">
                	<span class="page-title" style="margin:15px; color:teal"><center><h5><b>Choose the type of customer</b></h5></center></span>
              		<div class="divider" style="height:1px; background-color:#80d8ff"></div>
              		<div class="divider" style="height:1px; background-color:#80d8ff"></div>
              	</div>
	       	</div>

	       	<div class="row" style="background-color:white; ">
            	<div class="col s12">
					
					<!--If the customer is new-->
					<div class="col s6">
					{!! Form::open(['url' => 'transaction/walkin-company-payment-customer-information', 'method' => 'GET']) !!}
						<div class="center col s12" style="padding-top:5%">
							<button type="submit" class="center teal lighten-2" style="padding:10%;">
								<center><i class="mdi-social-person-add" style="font-size:80px"></i></center>
								<p align="center" style="font-size:40px; color:teal;"><center><font class="hidden" color="#4db6ac">Ad</font><b><font size="4em">New Customer</font></b><font class="hidden" color="#4db6ac">Ad</font></center></p>
							</button >
						</div>
					{!! Form::close() !!}
					</div>

					<!--if the customer is existing-->
					<div class="col s6">
						<div class="center col s12" style="padding-top:5%">
							<button class="center teal lighten-3" style="padding:10%;" id="button" onclick="showform()">
								<center><i class="mdi-social-person" style="font-size:80px"></i></center>
								<p align="center" style="font-size:40px; color:teal"><center><b><font size="4em">Existing Customer</font></b></center></p>
							</button >
						</div>
					</div>

					
					<!--this will appear once the user chose the button for existing customer-->
					<div class="customer-form col s12" id="custname" style="display:none; padding:5%">
					<div class="col s12"><div class="divider" style="height:2px; background-color:teal; margin-top:3%"></div></div>
					{!! Form::open(['url' => 'transaction/walkin-company-payment-customer-information', 'method' => 'POST', 'id' => 'companyForm']) !!}
						<div class="container">
							<div class="col s5" style="padding-top:3%"><center><b><font size="+1.5">Enter Company Name</font></b></center></div>
							<div class="col s7">
								<div class="input-field col s12">
									<input type="hidden" id="custID" name="custID">
					          		<input id="companyName" type="text" class="validate">
					          	</div>
							</div>					  
					    </div>
					<br><br>
					<div class="col s12"><div class="divider" style="height:2px; background-color:teal; margin-bottom:1%"></div></div>
					<right><button type="button" id="checkCompany" class="right btn" style="background-color:teal; color:white; margin-bottom:3%">Done!</button></right>

					{!! Form::close() !!}
					</div>

            	</div> <!-- end of col s12 -->
            </div> <!-- end of row -->

          
	    </div> <!-- end of payment info -->
			</div> <!-- end of col s12 -->

    </div> <!-- end of row -->

@stop

@section('scripts')

	<script>
		$('#checkCompany').click(function(){

			var comp = {!! json_encode($company) !!};
			//var companyID = "";
			var check = 0;

			for(var i = 0; i < comp.length; i++){

				if((comp[i].strCompanyName).toLowerCase().trim() == $('#companyName').val().toLowerCase().trim())
				{
					/*companyID = comp[i].strCompanyID;*/
					check = 1;
					$('#custID').val(comp[i].strCompanyID);
					$('#companyForm').submit();
					break;
				}	

			}
			if(check == 0){
				alert("That company does not exist!");	
				$('#companyForm').preventDefault();
			}

		});

		$(document).ready(function(){
			  $(window).keydown(function(event){
				    if(event.keyCode == 13) {
				      event.preventDefault();
				      return false;
				    }
				  });
		})

	</script>

	<script>
		$(document).ready(function() {
		
			var a = {!! json_encode($packages) !!};
			var b = {!! json_encode($prices) !!};
			var c = {!! json_encode($quantity) !!};
			var totalTime = 0, totalPrice = 0.0;

			for(var i = 0; i < a.length; i++)
			{
				totalTime = totalTime + (a[i].intPackageMinDays * c[i]);
				totalPrice = totalPrice + b[i];
			}

			$('#totalTime').text(totalTime + " days");
			//$('#totalPrice').text((totalPrice.toFixed(2)) + " PHP");

	  	});
	</script>	

	<script type="text/javascript">

		function showform() 
		{
			document.getElementById('custname').style.display = "block";
		}
		// $('#button').on('click', function() {
		// 	$('#custId').show();
		// 	$('#custId').style.display = "block";
		// });
	</script>

@stop