@extends('layouts.master')

@section('content')

<div class="main-wrapper"  style="margin-top:30px">

  	<div class="row">
      <div class="col s12 m12 l12">
        <span class="page-title"><h4>Online Alteration Customers</h4></span>
      </div>
    </div>

    <div class="row">
        <div class="col s12 m12 l12">
        	<div class="card-panel">

                <span class="card-title"><h5 style="color:#1b5e20"><center>Orders</center></h5></span>
                <div class="divider" style="margin-bottom:50px;"></div>

   		        <div class="row">
		        	<div class="col s7">
		        		<table class="table centered data-onlinelateration ">
		        			<thead>
						    	<tr>
						        	<th style="color:#1b5e20">Alteration No.</th>
						            <th style="color:#1b5e20">Customer Name</th>
						            <th style="color:#1b5e20">Total Price</th>
						            <th> Actions </th>
						        </tr>
						    </thead>
						</table>
		        	</div>
		        </div>


		        <ul class="collapsible z-depth-0" data-collapsible="accordion" style="border:none;">
			    
			    <!--Order#1-->
			    <li style="margin-bottom:10px;">
			        <div class="collapsible-header" style="background-color:#f3e5f5">
						<div class="row">
							<div class="col s7">
								<table class="centered">
								    <tbody>
								    @foreach($onlineAlteration as $onlineAlteration)
								    	 {{-- @if($onlineAlteration->boolisOnline == 1) --}}
								        <tr>
								        	<td>{{$onlineAlteration->strNonShopAlterID}}</td>                        
					                        <td>{{$onlineAlteration->strCompanyName}}{{$onlineAlteration->strIndivFName}} {{$onlineAlteration->strIndivMName}} {{$onlineAlteration->strIndivLName}}</td>
					                        <td>{{$onlineAlteration->dblOrderTotalPrice}}</td>
								        </tr>
								        	{{-- @endif --}}
								         @endforeach
								    </tbody>
								</table>
							</div>
							<div class="col s5 center">
								<table class="centered">
								    <tbody>
								        <tr>
								        	<td><a class="btn modal-trigger" href="{{URL::to('/alteration-acceptorder')}}"><i class="mdi-action-done"></i>Accept</a></td>
								        	<td><a class="btn modal-trigger" href="#rejectmodal"><i class="mdi-content-clear"></i>Reject</a></td>
								        </tr>
								    </tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="collapsible-body" style="border:3px solid #f3e5f5;">
						<h5 style="color:#1b5e20; margin-left:20px;">Order Specification</h5>
						
						<div class = "row">
						    <div class="col s12 m12 l12 overflow-x">
						    	<table class = "centered striped">
						    		<thead>
						    			<tr>
						    				<th>Segment Type</th>
						    				<th>Alteration Type</th>
						    				<th>Description</th>
						    				<th></th>
						    			</tr>
						    		</thead>
						    		<tbody>
						    			<tr>
						    				<td>Pants</td>
						    				<td>Hem</td>
						    				<td>Decrease by 1 cm</td>
						    				<td><a class=" btn modal-trigger tooltipped" href="#measurementmodal" data-position="top" data-delay="50" data-tooltip="View measurements"><i class="mdi-action-view-headline"></i></a></td>
						    			</tr>
						    		</tbody>
						    	</table>
						    </div>
				                  
				            <div class = "clearfix"></div>
				        </div>


					</div>
				</li>
				</ul>

            </div>
        </div>
    </div>

</div>

	<!--Measurement button Modal-->
	<div id="measurementmodal" class="modal modal-fixed-footer">
		<div class="modal-content">
			<h4 style="color:#1b5e20" class="center">Measurements</h4>
			<div class="divider container" style="margin-bottom:20px;"></div>
			<div class="row">
				<div class="col s6">
					<div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Measurement</label>
	                </div>
	                <div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Measurement</label>
	                </div>
	                <div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Measurement</label>
	                </div>
				</div>
				<div class="col s6">
					<div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Measurement</label>
	                </div>
	                <div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Measurement</label>
	                </div>
	                <div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Measurement</label>
	                </div>
				</div>
			</div>

			<h4 style="color:#1b5e20" class="center">Note</h4>
			<div class="divider container" style="margin-bottom:20px;"></div>
			    <div class="input-field col s12">
		          	<textarea id="textarea" class="textarea"></textarea>
		          	<label for="textarea"></label>
		        </div>

		</div>

		<div class="modal-footer" style="background-color:#26a69a">
			<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
			<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a>
		</div>
	</div>
	

@stop

@section('scripts')

	<script type="text/javascript">
	  
	  $(document).ready(function() {
		    $('select').material_select();
		  });
	

      $(document).ready(function() {

          $('.data-onlinealteration').DataTable();

      setTimeout(function () {
            $('#flash_message').hide();
        }, 5000);

      setTimeout(function () {
            $('#success-message').hide();
        }, 5000);


      } );
      </script>

@stop