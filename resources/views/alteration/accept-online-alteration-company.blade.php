@extends('layouts.master')

@section('content')
  <div class="main-wrapper" style="margin-top:30px"> 
   <!-- Main Wrapper  -->   

      <!--Flash Messages-->
      @if (Session::has('flash_message'))
        <div class="row" id="flash_message">
          <div class="col s12 m12 l12">
            <div class="card-panel blue accent-1">
              <span class="alert alert-success"><i class="tiny mdi-navigation-close right" onclick="$('#flash_message').hide()"></i></span>
              <em> {!! session('flash_message') !!}</em>
            </div>
          </div>
        </div>
      @endif

      <!--Flash Messages for Reject-->
      @if (Session::has('flash_message_delete'))
        <div class="row" id="flash_message">
          <div class="col s12 m12 l12">
            <div class="card-panel red accent-2">
              <span class="alert alert-success"><i class="tiny mdi-navigation-close right" onclick="$('#flash_message').hide()"></i></span>
               <em> {!! session('flash_message_delete') !!}</em>
            </div>
          </div>
        </div>
      @endif
      
    <div class="row">
        <div class="col s12 m12 l12">
          <span class="page-title"><h4>Transaction - Approval of Online Alterations - Company</h4></span>
        </div> 
    </div>
    </div>
   <!-- End of Main Wrapper  --> 



  <div class="row"> <!-- row -->

    	<div class="col s12 m12 l12">  <!-- col s12 m12 l12 -->

    		<div class="card-panel">  <!-- card-panel -->
   		    <span class="card-title"><h5 style="color:#1b5e20"><center>List of Online Alteration Orders</center></h5></span>
   				<div class="divider"> </div>
            <div class="card-content"><!-- card-content  --> 

              <div class="col s12 m12 l12 overflow-x">

       				<table class = "centered" align = "center" border = "1">
                <thead>
                  <tr>
                    <th style="color:#1b5e20">Alteration No.</th>
                    <th style="color:#1b5e20">Customer Name</th>
                    <th style="color:#1b5e20">Total Price</th>
                    <th data-field="Edit">Actions</th>
              	  </tr>
                </thead>
              
                <tbody>
                @foreach($onlineAlteration as $onlineAlteration)
                {!! Form::open(['url' => 'transaction/alteration-accept-online-order/company', 'method' => 'POST']) !!}
                        <input type="hidden" name="customerID" value="{!! $onlineAlteration->strCompanyID !!}">
                        <tr>
                          <td>{{$onlineAlteration->strNonShopAlterID}}</td>                        
                          <td>{{$onlineAlteration->strCompanyName}}</td>
                          <td>{{"Php" . $onlineAlteration->dblOrderTotalPrice}}</td>
                          <td><a class=" btn modal-trigger tooltipped btn-floating green" href="#{{$onlineAlteration->strNonShopAlterID}}" data-position="top" data-delay="50" data-tooltip="Show alteration order details."><i class="mdi-action-view-headline"></i></a>
                    		  <button type="submit" style="color:black" class="btn tooltipped btn-floating blue" data-position="bottom" data-delay="50" data-tooltip="Click to accept online order"><i class="mdi-action-done"></i></button>
                         {{--  <a style="color:black" class="modal-trigger btn tooltipped btn-floating red" data-position="bottom" data-delay="50" data-tooltip="Click to reject order." href="{{URL::to('transaction/alteration-reject-online-order')}}"><i class="mdi-action-delete"></i></a> --}}</td>
                        </tr>
              

              <!--**********Order Details Modal***********-->
                    <div id="{{$onlineAlteration->strNonShopAlterID}}" class="modal modal-fixed-footer">                     
                      <h5><font color = "#1b5e20"><center>Order Details</center> </font> </h5>                       
                          
                      <div class="divider" style="height:2px"></div>
                        <div class="modal-content col s12">
                              <div class="col s12" style="margin-bottom:50px" >
                                @foreach($specifics as $specific)
                                  @if($onlineAlteration->strNonShopAlterID == $specific->strNonShopAlterID)
                                    <div class="col s6"><p style="color:gray">Segment: <font color="red" size=+1>{{$specific->strSegmentName}}</font><p style="color:black" id=""></p></p></div>
                                    <div class="col s6"><p style="color:gray">Alteration Type: <font color="red" size=+1>{{$specific->strAlterationName}}</font><p style="color:black" id="total-price"></p></p></div>
                                    <div class="col s6"><p style="color:gray">Desc: <font color="red" size=+1>{{$specific->txtAlterationDesc}}</font><p style="color:black" id="total-price"></p></p></div>
                                  @endif
                                @endforeach 
                              </div> 
    
                          

                          <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">       
                          </div>
                        </div>

                        <div class="modal-footer col s12" style="background-color:#26a69a">
                          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Close</a>
                        </div>      
                      </div>
                  {!! Form::close() !!}
                  @endforeach
                </tbody>
              </table>
              </div>

              <div class = "clearfix">

              </div>  
            </div><!-- card-content  --> 
        </div>  <!-- card-panel -->
      </div> <!-- col s12 m12 l12 --> 
  </div> 
      <!-- row --> 



@stop

@section('scripts')

        <!--DATA TABLE SCRIPT-->
    <script type="text/javascript">

      $(document).ready(function() {

          $('.data-alteration').DataTable();
          $('select').material_select();

          setTimeout(function () {
            $('#flash_message').hide();
        }, 5000);

      } );
    </script>

@stop