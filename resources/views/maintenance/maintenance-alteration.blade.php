@extends('layouts.master')

@section('content')
  <div class="main-wrapper" style="margin-top:30px">  <!-- Main Wrapper  -->   
      <!--Input Validation-->

       <!-- Errors -->
        @if ($errors->any())
           <div class="row" id="flash_message">
          <div class="col s12 m12 l12">
            <div class="card-panel red">
              <span class="black-text" style="color:black"><i class="tiny mdi-navigation-close right" onclick="$('#flash_message').hide()"></i></span>
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </div>
          </div>
        </div>
      @endif

   <!--Add Fabric Type-->
        @if(Session::has('flash_message'))
        <div class="row" id="flash_message">
          <div class="col s12 m12 l12">
            <div class="card-panel yellow accent-1">
              <span class="alert alert-success"> <i class="tiny mdi-navigation-close right" onclick="$('#flash_message').hide()"></i></span>
             <em> {!! session('flash_message') !!}</em>
            </div>
          </div>
        </div>
      @endif

     <!--Edit Alteration-->
      @if (Session::has('flash_message_update'))
        <div class="row" id="flash_message">
          <div class="col s12 m12 l12">
            <div class="card-panel blue accent-1">
              <span class="alert alert-success"><i class="tiny mdi-navigation-close right" onclick="$('#flash_message').hide()"></i></span>
              <em> {!! session('flash_message_update') !!}</em>
            </div>
          </div>
        </div>
      @endif


      <!--Delete Alteration-->
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
    

      @if (Session::has('flash_message_duplicate'))
        <div class="row" id="flash_message">
          <div class="col s12 m12 l12">
            <div class="card-panel red accent-1">
              <span class="alert alert-success"><i class="tiny mdi-navigation-close right" onclick="$('#flash_message').hide()"></i></span>
              <em> {!! session('flash_message_duplicate') !!}</em>
            </div>
          </div>
        </div>
      @endif 


       {{--  End of Flash Messages
 --}}
    <div class="row">
      <div class="col s12 m12 l12">
        <span class="page-title"><h4>Maintenance - Alteration Type</h4></span>
      </div> 
    </div>

      <div class="col s6 left">
         <a class="right waves-effect waves-light modal-trigger btn-floating tooltipped btn-large light-green accent-1" data-position="bottom" data-delay="50"  data-tooltip="CLick to add a new role to the table" href="#addFabricType" style="color:black; margin-right:35px; margin-left: 20px;"><i class="large mdi-content-add"></i></a>
      </div>
    </div>
   <!-- End of Main Wrapper  --> 



  <div class="row"> <!-- row -->

    	<div class="col s12 m12 l12">  <!-- col s12 m12 l12 -->

    		<div class="card-panel">  <!-- card-panel -->
   		    <span class="card-title"><h5 style="color:#1b5e20"><center>List of Alteration Types</center></h5></span>
   				<div class="divider"> </div>
            <div class="card-content"><!-- card-content  --> 

              <div class="col s12 m12 l12 overflow-x">

       				<table class = "table centered data-alteration" align = "center" border = "1">
                <thead>
                  <tr>
              		  <!--<th data-field="fabricID">Fabric Type ID</th>-->
                    <th data-field="alterationName">Name</th>
                    <th data-field="alterationDescription">Segment</th>
              		  <th data-field="alterationDescription">Description</th>
                    <th data-field="alteration MinDays">Min. Days of Production</th>
                    <th data-field="alterationPrice">Price</th>
                    <th data-field="Edit">Actions</th>
              	  </tr>
                </thead>
              
                <tbody>
                  @foreach($alteration as $alteration)
                    @if($alteration->boolIsActive == 1)
                  <tr>
                    <td>{{$alteration->strAlterationName}}</td>
                    <td>{{$alteration->strSegmentName}}</td>
              		  <td>{{$alteration->txtAlterationDesc}}</td>
                    <td>{{$alteration->intAlterationMinDays}}</td>
                    <td>{{"Php" . number_format($alteration->dblAlterationPrice, 2)}}</td>
              		  <td><a style="color:black" class="modal-trigger btn tooltipped btn-floating blue" data-position="bottom" data-delay="50" data-tooltip="Click to edit data of alteration name" href="#edit{{$alteration->strAlterationID}}"><i class="mdi-editor-mode-edit"></i></a>
                    <a style="color:black" class="modal-trigger btn tooltipped btn-floating red" data-position="bottom" data-delay="50" data-tooltip="Click to remove data of alteration name from the table" href="#del{{$alteration->strAlterationID}}"><i class="mdi-action-delete"></i></a></td>
              	
                    <div id="edit{{$alteration->strAlterationID}}" class="modal modal-fixed-footer"> <!-- editFabricType  --> 
                      <h5><font color = "#1b5e20"><center>EDIT FABRIC TYPE</center> </font> </h5>

                      {!! Form::open(['url' => 'maintenance/alteration/update']) !!} 
                      <div class="divider" style="height:2px"></div>
                      <div class="modal-content col s12">
                        
                        <div class="input-field">
                          <input value = "{{$alteration->strAlterationID}}" id="editAlterationNameID" name = "editAlterationNameID" type="hidden">
                        </div>

                        <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s12">
                            <input required value = "{{$alteration->strAlterationName}}" id="editAlterationName" name = "editAlterationName" type="text" class="validate" required data-position="bottom" pattern="^[a-zA-Z\-'`\s\d]{2,}${{-- ^[a-zA-Z\-'`]+(\s[a-zA-Z\-'`]+)? --}}" >
                            <label for="alteration_name">Alteration Name <span class="red-text"><b>*</b></span> </label>
                          </div>
                        </div>

                          <div class = "col s12" style="padding:15px;  border:3px solid white;"> 

                          <div class="input-field col s12">                                                   
                            <select class="browser-default editSegment" id="{{ $alteration->strAlterationID }}" name='editSegment'>
                                  @foreach($segment as $segment_1)
                                    @if($alteration->strAlterationSegmentFK == $segment_1->strSegmentID && $segment_1->boolIsActive == 1)
                                      <option selected value="{{ $segment_1->strSegmentID }}" class="{{$segment_1->strAlterationSegmentFK  }}">{{ $segment_1->strSegmentName }}</option>
                                    @elseif($segment_1->boolIsActive == 1)
                                      <option value="{{ $segment_1->strSegmentID }}" class="{{$segment_1->strAlterationSegmentFK  }}">{{ $segment_1->strSegmentName }}</option>
                                    @endif
                                  @endforeach
                            </select>    
                          </div> 
                      </div>  

                        <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s12">
                            <input  value = "{{$alteration->txtAlterationDesc}}" id="editAlterationDesc" name = "editAlterationDesc" type="text" class="validateDesc">
                            <label for="alteration_description">Alteration Desription</label>
                          </div>  
                        </div>

                         <div class = "col s12" style="padding:15px;  border:3px solid white;">
                              <div class="input-field col s6">
                                <input required value="{{ $alteration->intAlterationMinDays }}" id="editMinDays" name= "editMinDays" type="text" class="validate" pattern="^[0-9]*$" maxlength="2">
                                <label for="segment_name">Minimum Production Days:<span class="red-text"><b>*</b></span></label>
                              </div>
                          </div>

                        <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                          <div class="input-field col s12">
                            <input required value = "{{$alteration->dblAlterationPrice}}" id="editAlterationPrice" name = "editAlterationPrice" type="text" class="validate">
                            <label for="alteration_price">Alteration Price <span class="red-text"><b>*</b></span> </label>
                          </div>  
                        </div>



                      </div>

                      <div class="modal-footer col s12" style="background-color:#26a69a">
                        <button type="submit" class=" modal-action  waves-effect waves-green btn-flat">Update</button>
                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a> 
                      </div>
                     {!! Form::close() !!}
                    </div> <!-- editFabricType  -->    
                  

              <!--**********DELETE***********-->
                    <div id="del{{$alteration->strAlterationID}}" class="modal modal-fixed-footer">                     
                      <h5><font color = "#1b5e20"><center>ARE YOU SURE TO DEACTIVATE THIS ALTERATION NAME?</center> </font> </h5>                       
                          
                        {!! Form::open(['url' => 'maintenance/alteration/destroy']) !!} 
                      <div class="divider" style="height:2px"></div>
                        <div class="modal-content col s12">
                            
                          <div class="input-field">
                            <input value="{{$alteration->strAlterationID}}" id="delAlterationNameID" name="delAlterationNameID" type="hidden">
                          </div>

                          <div class = "col s12" style="padding:15px;  border:3px solid white;">
                              <div class="input-field col s12">
                                <label for="alteration_name">Alteration Name </label>
                                <input value="{{$alteration->strAlterationName}}" id="delAlterationName" name="delAlterationName" type="text" readonly>
                              </div>
                          </div>

                          <div class = "col s12" style="padding:15px;  border:3px solid white;">
                              <div class="input-field col s12">
                                <label for="alteration_desc">Alteration Desription </label>
                                <input value="{{$alteration->txtAlterationDesc}}" id="delAlterationDesc" name="delAlterationDesc" type="text" readonly>
                              </div>
                          </div>

                          <div class = "col s12" style="padding:15px;  border:3px solid white;">
                              <div class="input-field col s12">
                                <label for="alteration_price">Alteration Price</label>
                                <input value="{{$alteration->dblAlterationPrice}}" id="delAlterationPrice" name="delAlterationPrice" type="text" readonly>
                              </div>
                          </div>

                          <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s12">
                            <label for="inactive_reason"> Reason for Deactivation <span class="red-text"><b>*</b></span> </label>
                            <input required  value="{{ $alteration->strAlterationInactiveReason }}" id="delInactiveAlteration" name="delInactiveAlteration" type="text">
                          </div>
                        </div>

                          <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                                 
                          </div>
                        </div>

                        <div class="modal-footer col s12" style="background-color:#26a69a">
                          <button type="submit" class="waves-effect waves-green btn-flat">OK</button>
                          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
                        </div> 
                        {!! Form::close() !!}      
                      </div>
                    </tr>
                    @endif
                  @endforeach
                </tbody>
              </table>
              </div>

              <div class = "clearfix">

              </div>  

            <!--********ADD******-->
            <div id="addFabricType" class="modal modal-fixed-footer">                  
              <h5><font color = "#1b5e20"><center>CREATE ALTERATION NAME</center> </font> </h5> 
              
             {!! Form::open(['url' => 'maintenance/alteration', 'method' => 'post']) !!}
              <div class="divider" style="height:2px"></div>
                <div class="modal-content col s12">
                          

                  <div class="input-field">
                    <input value = "{{$newID}}" id="strAlterationID" name = "strAlterationID" type="hidden">
                  </div>

                  <div class = "col s12" style="padding:15px;  border:3px solid white;">
                      <div class="input-field col s12">
                        <input required id="strAlterationName" name = "strAlterationName" type="text" class="validate" required data-position="bottom" pattern="^[a-zA-Z\-'`\s\d]{2,}$"  placeholder="Skinny Cut">
                        <label for="alteration_name">Alteration Name <span class="red-text"><b>*</b></span></label>
                      </div>
                  </div> 

                      <div class = "col s12" style="padding:15px;  border:3px solid white;">
                <div class="input-field col s12">
                  <select class="browser-default" required id="strAlterationSegmentFK" name="strAlterationSegmentFK">
                        @foreach($segment as $segment)
                          @if($segment->boolIsActive == 1)
                            <option value="{{ $segment->strSegmentID }}" class="{{ $segment->strAlterationSegmentFK }}">{{ $segment->strSegmentName }}</option>
                          @endif
                            @endforeach
                      </select>
                    </div>  
                </div> 
   

                  <div class = "col s12" style="padding:15px;  border:3px solid white;">
                      <div class="input-field col s12">
                        <input  id="txtAlterationDesc" name = "txtAlterationDesc" type="text" class="validate" placeholder="Alteration type for modifying pants cuff.">
                        <label for="alteration_description">Alteration Description</label>
                      </div>
                  </div>

                  
                  <div class = "col s12" style="padding:15px;  border:3px solid white;">
                              <div class="input-field col s6">
                                <input required id="intAlterationMinDays" name= "intAlterationMinDays" type="text" class="validate" pattern="^[0-9]*$" maxlength="2">
                                <label for="min days">Minimum Production Days:<span class="red-text"><b>*</b></span></label>
                              </div>
                  </div>

                  <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                      <div class="input-field col s12">
                        <input required id="dblAlterationPrice" name = "dblAlterationPrice" type="text" class="validate">
                        <label for="alteration_Price">Alteration Price <span class="red-text"><b>*</b></span></label>
                      </div>
                  </div>
                </div>

                <div class="modal-footer col s12" style="background-color:#26a69a">
                  <button type="submit" id="send" name="send" class=" modal-action  waves-effect waves-green btn-flat">Create</button>
                  <button type="reset" value="Reset" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</button> 
                </div>
                  {!! Form::close() !!}
    	       </div><!-- addFabricType  -->
            </div><!-- card-content  --> 
        </div>  <!-- card-panel -->
      </div> <!-- col s12 m12 l12 --> 
  </div> 
      <!-- row --> 



@stop

@section('scripts')

    <script type="text/javascript">
      $('.validateName').on('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z\'\-]+( [a-zA-Z\'\-]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

      //Kapag Number
      $('.validateName').keyup(function() {
        var name = $(this).val();
        $(this).val(name.replace(/\d/, ''));
      });  

      //Kapag whitespace
      $('.validateName').blur('input', function() {
        var name = $(this).val();
        $(this).val(name.trim());
      });      

      $('.validateName').blur('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z\'\-]+( [a-zA-Z\'\-]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      }); 

      $('.validateDesc').on('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z0-9\'\-\.\,]+( [a-zA-Z0-9\,\'\-\.]+)*$/;
        var is_desc=re.test(input.val());
        if(is_desc){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

      //Kapag whitespace
      $('.validateDesc').blur('input', function() {
        var desc = $(this).val();
        $(this).val(desc.trim());
      }); 

      $('.validateDesc').blur('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z0-9\'\-\.\,]+( [a-zA-Z0-9\,\'\-\.]+)*$/;
        var is_desc=re.test(input.val());
        if(is_desc){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });
      </script>
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