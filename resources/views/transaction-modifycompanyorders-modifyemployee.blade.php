@extends('layouts.master')

@section('content')

<div class="main-wrapper"  style="margin-top:30px">

	<div class="row">
	    <div class="col s12 m12 l12">
	    	<div class="card-panel">
		        <span class="card-title"><h5 style="color:#1b5e20"><center>Modify Employee Details</center></h5></span>
		        <div class="divider" style="margin-bottom:30px;"></div>

		        <div class="row">

					<table style="margin-bottom:10px;">
					    <table class = "table centered order-summary" border = "1">
		       				<thead style="color:gray">
			          			<tr>
				                  	<th class="col s3">Employee Name</th>
				                  	<th class="col s2">Sex</th>
				                  	<th class="col s1">Package</th>
				                  	<th class="col s4">Order Details</th>
				                  	<th class="col s1"></th>
				                  	<th class="col s1"></th>
				              	</tr>
			              	</thead>
					    </table>
					</table>
					<div class="row">
				        <div>
					        <div style="background-color:#ffebee;">
								<div class="row">
									<div style="color:black" class="input-field col s3">
			                            <input value="Klare Desteen T. Montefalco" id="empname" type="text">		           
			                        </div>
			                        <div style="color:black" class="input-field col s2">
										<select>
										    <option value="1">Female</option>
										    <option value="2">Male</option>
										</select>
									</div>
									<div style="color:black" class="input-field col s1">
										<select>
										    <option value="1">A</option>
										    <option value="2">B</option>
										    <option value="3">None</option>
										</select>
									</div>
			                        <div style="color:black" class="input-field col s3">
			                            <input class="left" value="Package A for Female" id="orderdetails" type="text">		           
			                        </div>
			
									<div style="color:black" class="col s1">
										<a style="margin-top:20px" class="btn btn-floating modal-trigger tooltipped" href="#measurementmodal" data-position=bottom data-delay="50" data-tooltip="Edit measurements"><i class="mdi-av-playlist-add"></i></a>
									</div>
									<div style="color:black" class="col s1">
										<a style="margin-top:20px" class=" btn modal-trigger tooltipped btn-floating purple accent-1" href="{{URL::to('transaction-modifycompanyorders-modifyemployeeorder')}}" data-position="top" data-delay="50" data-tooltip="Edit/Modify Package"><i class="mdi-editor-border-color"></i></a>
									</div>
									<div style="color:black" class="col s1">
										<a style="color:black; margin-top:20px" class="modal-trigger btn tooltipped btn-floating red" data-position="bottom" data-delay="50" data-tooltip="Click to remove data of employee from list" href="#removeOrder"><i class="mdi-action-delete"></i></a>
									</div>
								</div>
							</div>
					        <div style="background-color:#e1f5fe;">
								<div class="row">
									<div style="color:black" class="input-field col s3">
			                            <input value="Elijah Riley V. Montefalco" id="empname" type="text">		           
			                        </div>
			                        <div style="color:black" class="input-field col s2">
										<select>
										    <option value="1">Female</option>
										    <option value="2">Male</option>
										</select>
									</div>
									<div style="color:black" class="input-field col s1">
										<select>
										    <option value="1">A</option>
										    <option value="2">B</option>
										    <option value="3">None</option>
										</select>
									</div>
			                        <div style="color:black" class="input-field col s3">
			                            <input value="1 pc pants, 2 pc polo" id="orderdetails" type="text">		           
			                        </div>

									<div style="color:black" class="col s1">
										<a style="margin-top:20px" class="btn btn-floating modal-trigger tooltipped" href="#measurementmodal" data-position=bottom data-delay="50" data-tooltip="Edit measurements"><i class="mdi-av-playlist-add"></i></a>
									</div>
									<div style="color:black" class="col s1">
										<a style="margin-top:20px" class=" btn modal-trigger tooltipped btn-floating purple accent-1" href="{{URL::to('transaction-modifycompanyorders-modifyemployeeorder')}}" data-position="top" data-delay="50" data-tooltip="Edit/Modify Package"><i class="mdi-editor-border-color"></i></a>
									</div>
									<div style="color:black" class="col s1">
										<a style="color:black; margin-top:20px" class="modal-trigger btn tooltipped btn-floating red" data-position="bottom" data-delay="50" data-tooltip="Click to remove data of employee from list" href="#removeOrder"><i class="mdi-action-delete"></i></a>
									</div>
								</div>
							</div>
				        </div>
				    </div>

				    <div class="col s12" style="margin-top:40px;">
	    				<div><a class="btn red left" style="border-radius:180px;">CANCEL</a></div>
	    				<div><a class="btn red right modal-trigger" style="border-radius:180px;" href="#savemodal">SAVE</a></div>
			        </div>
		        </div>

	        </div>
	    </div>
	</div>


</div>

	<!--Save Modal-->
	<div id="savemodal" class="modal modal-fixed-footer" style="height:250px; width:500px; margin-top:150px">
		<h5><font color="green"><center><b>Save Changes?</b></center></font></h5>
		<div class="divider" style="height:2px"></div>
		<div class="modal-content">
			<div class="row">
				<div class="col s3">
					<i class="mdi-alert-warning" style="font-size:50px; color:yellow"></i>
				</div>
				<div class="col s9">
					<p><font size="+1">Are you sure you want to save the changes made?</font></p>
				</div>
			</div>
		</div>
		<div class="modal-footer col s12" style="background-color:green; opacity:0.85">
			<a class="modal-action modal-close waves-effect waves-green btn-flat" href="#!"><font color="black">Cancel</font></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" href="{{URL::to('transaction/modifyCompany')}}"><font color="black">No</font></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" href="{{URL::to('transaction/modifyCompany')}}"><font color="black">Yes</font></a>
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
	                  	<label for="measurement">Hem</label>
	                </div>
	                <div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Slim</label>
	                </div>
	                <div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Sleeves</label>
	                </div>
				</div>
				<div class="col s6">
					<div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Hips</label>
	                </div>
	                <div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Circumference</label>
	                </div>
	                <div class="input-field">
	                  	<input id ="measurement" type="text" class="validate">
	                  	<label for="measurement">Slit</label>
	                </div>
				</div>
			</div>

		</div>

		<div class="modal-footer" style="background-color:#26a69a">
			<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
			<a href="" class="modal-action modal-close waves-effect waves-green btn-flat">Save</a>
		</div>
	</div>

	<!--Remove Order Modal-->
	<div id="removeOrder" class="modal modal-fixed-footer" style="height:250px; width:500px; margin-top:150px">
		<h5><font color="red"><center><b>Warning!</b></center></font></h5>
		<div class="divider" style="height:2px"></div>
		<div class="modal-content">
			<div class="row">
				<div class="col s3">
					<i class="mdi-alert-warning" style="font-size:50px; color:yellow"></i>
				</div>
				<div class="col s9">
					<p><font size="+1">Are you sure you want to delete this employee?</font></p>
				</div>
			</div>
		</div>
		<div class="modal-footer col s12" style="background-color:red; opacity:0.85">
            <button type="submit" class="waves-effect waves-green btn-flat" href="#!"><font color="black">Yes</font></button>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><font color="black">No</font></a>
        </div>
	</div>

@stop

@section('scripts')

	<script>
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
		$('.tooltipped').tooltip({delay: 50});
	 });
	</script>

	<script>
		$(document).ready(function(){
		    $('.collapsible').collapsible({
		    	accordion : true // A setting that changes the collapsible behavior to expandable instead of the default accordion style
		    });
		});
	</script>

	<script>
	 $(document).ready(function(){
	    $('.materialboxed').materialbox();
	  });
	 </script>

@stop


