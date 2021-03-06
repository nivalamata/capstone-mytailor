@extends('layouts.master')


@section('content')
  <div class="main-wrapper" style="margin-top:30px">
      <!--Input Validation-->
      @if (Input::get('input') == 'invalid')
        <div class="row" id="success-message">
          <div class="col s12 m12 l12">
            <div class="card-panel red">
              <span class="black-text" style="color:black">Invalid input!<i class="tiny mdi-navigation-close right" onclick="$('#success-message').hide()"></i></span>
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
       
      <!--Add -->
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

     <!--Edit -->
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


      <!--Delete -->
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


       <!--Reactivate Segment segmentStyle-->
      @if (Input::get('successRec') == 'true')
        <div class="row" id="success-message">
          <div class="col s12 m12 l12">
            <div class="card-panel yellow">
              <span class="black-text" style="color:black">Successfully added back segment style!<i class="tiny mdi-navigation-close right" onclick="$('#success-message').hide()"></i></span>
            </div>
          </div>
        </div>
        @endif

        <!--  <Duplicate Error Message>   -->
    @if (Input::get('success') == 'duplicate')
        <div class="row" id="success-message">
          <div class="col s12 m12 l12">
            <div class="card-panel red">
              <span class="black-text" style="color:black">Record already exists!<i class="tiny mdi-navigation-close right" onclick="$('#success-message').hide()"></i></span>
            </div>
          </div>
        </div>
      @endif


    <div class="row">
      <div class="col s12 m12 l12">
        <span class="page-title"><h4>Maintenance - Charge Detail</h4></span>
      </div>
    </div>

      <div class="col s6 left">
         <a class="right waves-effect waves-light modal-trigger btn-floating tooltipped btn-large light-green accent-1" data-position="bottom" data-delay="50" data-tooltip="Click to add a new segment segment style to the table" href="#addDesign" style="color:black; margin-right:35px; margin-left: 20px;"><i class="large mdi-content-add"></i></a>
      </div>
    </div>
  


  <div class="row">
    <div class="col s12 m12 l12">
    	<div class="card-panel">
        <span class="card-title"><h5 style="color:#1b5e20"><center>List of Charge Details</center></h5></span>
        <div class="divider"></div>

    		<div class="card-content"> 
            <div class="col s12 m12 l12 overflow-x">
      			<table class = "table centered data-segmentsegmentStyle" align = "center" border = "1">
       				<thead>
          			<tr>
                  <!--<th data-field= "Catalog ID">Segment segmentStyle ID</th>-->
              		<th data-field="Charge Category">Charge Category</th>
             		  <th data-field="Segment">Segment</th>
                  <th data-field="Fee">Fee</th>
                  <th data-field="Desc">Descriptionn</th> 
                  <th data-field="Edit">Actions</th>
              	</tr>
              </thead>

              <tbody>
                @foreach($chargeDetail as $chargeDetail)
                @if($chargeDetail->boolIsActive == 1)
                <tr>
             		   
                  <td>{{ $chargeDetail->strChargeCatName }}</td> 
                  <td>{{ $chargeDetail->strSegmentName }}</td>
              		<td>{{ number_format($chargeDetail->dblChargeDetPrice, 2) . ' PHP' }}</td>
                  <td>{{ $chargeDetail->txtChargeDetDesc }}</td>
              		<td><a style="color:black" class="modal-trigger btn tooltipped btn-floating blue" data-position="bottom" data-delay="50" data-tooltip="Click to update charge detail data" href="#edit{{ $chargeDetail->strChargeDetailID }}"><i class="mdi-editor-mode-edit"></i></a>
                  <a style="color:black" class="modal-trigger btn tooltipped btn-floating red" data-position="bottom" data-delay="50" data-tooltip="CLick to remove segment style data from the table" href="#del{{ $chargeDetail->strChargeDetailID }}"><i class="mdi-action-delete"></i></a></td>
                      
                    <div id="edit{{ $chargeDetail->strChargeDetailID }}" class="modal modal-fixed-footer">                     
                        <h5><font color = "#1b5e20"><center>UPDATE SEGMENT STYLE</center> </font> </h5>                        

                      {!! Form::open(['url' => 'maintenance/charges-detail/update', 'files' => true]) !!}
                        <div class="divider" style="height:2px"></div>
                        <div class="modal-content col s12">
                          
                          <div class="input-field">
                            <input value= "{{ $chargeDetail->strChargeDetailID }}" id="editChargeDetID" name= "editChargeDetID" type="hidden">
                          </div>

                      <div class = "col s12" style="padding:15px;  border:3px solid white;"> 
                          <div class="input-field col s12">                                                   
                            <select class="browser-default editChargeCatFK" id="{{ $chargeDetail->strChargeDetailID }}" name='editChargeCatFK'>
                             <option value="" disabled selected><font size="3" color="Red">Choose a charge category:</font></option>
                                  @foreach($chargeCat as $chargeCat_1)
                                    @if($chargeDetail->strChargeCatFK == $chargeCat_1->strChargeCatID && $chargeCat_1->boolIsActive == 1)
                                      <option selected value="{{ $chargeCat_1->strChargeCatID }}" class="{{$chargeCat_1->strChargeCatFK}}">{{ $chargeCat_1->strChargeCatName }}</option>
                                    @elseif($chargeCat_1->boolIsActive == 1)
                                      <option value="{{ $chargeCat_1->strChargeCatID }}" class="{{$chargeCat_1->strChargeCatFK}}">{{ $chargeCat_1->strChargeCatName }}</option>
                                    @endif
                                  @endforeach
                            </select>    
                          </div> 
                      </div>   


                      <div class = "col s12" style="padding:15px;  border:3px solid white;"> 
                          <div class="input-field col s12">                                                   
                            <select class="browser-default editChargeDetSegFK" id="{{ $chargeDetail->strChargeDetailID }}" name='editChargeDetSegFK'>
                               <option value="" disabled selected><font size="3" color="Red">Choose a segment:</font></option>
                                  @foreach($segment as $segment_1)
                                    @if($chargeDetail->strChargeDetSegFK == $segment_1->strSegmentID && $segment_1->boolIsActive == 1)
                                      <option selected value="{{ $segment_1->strSegmentID }}" class="{{$segment_1->strChargeDetSegFK}}">{{ $segment_1->strSegmentName }}</option>
                                    @elseif($segment_1->boolIsActive == 1)
                                      <option value="{{ $segment_1->strSegmentID }}" class="{{$segment_1->strChargeDetSegFK}}">{{ $segment_1->strSegmentName }}</option>
                                    @endif
                                  @endforeach
                            </select>    
                          </div> 
                      </div>   

                      <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s12">
                            <input required value = "{{ $chargeDetail->dblChargeDetPrice }}" id="editChargeDetPrice" name= "editChargeDetPrice" type="text" class="validate"  data-position="bottom" pattern="^[a-zA-Z\-'`\d]+(\s[a-zA-Z\-'`]+)?">
                            <label for="Price"><span class="red-text"><b>*</b></span>Price</label>
                          </div>
                      </div>

                      <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                            <div class="input-field col s12">
                                  <input  value="{{ $chargeDetail->txtChargeDetDesc }}" id="editChargeDetDesc" name = "editChargeDetDesc" type="text" class="validate">
                               <label for="Description">Description</label>
                            </div>
                      </div>
                  </div>

                        <div class="modal-footer col s12" style="background-color:#26a69a">
                            <button type="submit" class=" modal-action  waves-effect waves-green btn-flat">Update</button>
                            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a> 
                        </div>
                      {!! Form::close() !!}
              </div>  
                

                <div id="del{{ $chargeDetail->strChargeDetailID }}" class="modal modal-fixed-footer">
                      <h5><font color = "#1b5e20"><center>ARE YOU SURE TO DEACTIVATE THIS SEGMENT STYLE?</center> </font> </h5>
                        
                      {!! Form::open(['url' => 'maintenance/charges-detail/destroy']) !!}
                        <div class="divider" style="height:2px"></div>
                        <div class="modal-content col s12">

                                <div class="input-field">
                                      <input value= "{{ $chargeDetail->strChargeDetailID }}" id="delChargeDetID" name= "delChargeDetID" type="hidden">
                                </div>

                     <div class = "col s12" style="padding:15px;  border:3px solid white;">
                              <div class="input-field col s6">                                                    
                                    <input type="text" value="{{$chargeDetail->strChargeCatName}}" readonly>
                                    <label>Charge Category</label>
                              </div>  
                      </div> 

                    <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s6">                                                    
                                <input type="text" value="{{$chargeDetail->strSegmentName}}" readonly>
                                <label>Segment</label>
                          </div>  
                    </div> 
  
                    <div class = "col s12" style="padding:15px;  border:3px solid white;">
                        <div class="input-field col s12">
                          <input value = "{{ $chargeDetail->dblChargeDetPrice }}" type="text" class="validate" readonly>
                          <label for="Price">Price:</label>
                        </div>
                    </div>

                    <div class = "col s12" style="padding:15px;  border:3px solid white;">
                        <div class="input-field col s12">
                            <input value = "{{$chargeDetail->txtChargeDetDesc }}" type="text" class="validate" readonly>
                            <label for="Description">Description: </label>
                        </div>
                    </div>

                     <div class="input-field col s12">
                            <label for="inactive_reason"> Reason for Deactivation <span class="red-text"><b>*</b></span> </label>
                            <input required id="delInactiveChargeDet" name = "delInactiveChargeDet" value = "{{$chargeDetail->strChargeDetInactiveReason}}" type="text">
                     </div> 

                    <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">        
                    </div>
                </div>              

                      <div class="modal-footer col s12" style="background-color:#26a69a">
                        <button type="submit" class=" modal-action  waves-effect waves-green btn-flat">OK</button>
                        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a> 
                      </div>
                    {!! Form::close() !!}              
                    </div>
                  </td>
                </tr>   
                @endif
                @endforeach               
              </tbody>
            </table>

            </div>
            <div class = "clearfix">
          </div>
           

            <div id="addDesign" class="modal modal-fixed-footer">
              <h5><font color = "#1b5e20"><center>CREATE CHARGE DETAIL</center> </font> </h5> 
                
              {!! Form::open(['url' => 'maintenance/charges-detail', 'method' => 'post']) !!}
                <div class="divider" style="height:2px"></div>
                <div class="modal-content col s12">


                
                <div class="input-field">
                    <input value="{{ $newID }}" id="strChargeDetailID" name="strChargeDetailID" type="hidden">
                </div>

            <div class = "col s12" style="padding:15px;  border:3px solid white;">
                <div class="input-field col s12">
                  <select class="browser-default" required id="strChargeCatFK" name="strChargeCatFK">
                     <option value="" disabled selected><font size="3" color="Red">Choose a charge category:</font></option>
                        @foreach($chargeCat as $chargeCat)
                          @if($chargeCat->boolIsActive == 1)
                            <option value="{{ $chargeCat->strChargeCatID }}" class="{{ $chargeCat->strChargeCatFK }}">{{ $chargeCat->strChargeCatName }}</option>
                          @endif
                        @endforeach
                  </select>
                </div>  
            </div> 

              <div class = "col s12" style="padding:15px;  border:3px solid white;">
                <div class="input-field col s12">
                  <select class="browser-default" required id="strChargeDetSegFK" name="strChargeDetSegFK">
                    <option value="" disabled selected><font size="3" color="Red">Choose a segment:</font></option>
                        @foreach($segment as $segment)
                          @if($segment->boolIsActive == 1)
                            <option value="{{ $segment->strSegmentID }}" class="{{ $segment->strChargeDetSegFK }}">{{ $segment->strSegmentName }}</option>
                          @endif
                        @endforeach
                  </select>
                </div>  
            </div>  

            <div class = "col s12" style="padding:15px;  border:3px solid white;">
                <div class="input-field col s12">
                  <input required id="dblChargeDetPrice" name= "dblChargeDetPrice" type="text" class="validate"  data-position="bottom" pattern="^[a-zA-Z\-'`\d]+(\s[a-zA-Z\-'`]+)?" placeholder="Php 200.00">
                  <label for="Price">Price<span class="red-text"><b>*</b></span></label>
                </div>
            </div>


             <div class = "col s12" style="padding:15px;  border:3px solid white;">
                  <div class="input-field col s12">
                        <input id="txtChargeDetDesc" name="txtChargeDetDesc" type="text" class="validate" placeholder="Extra Php 200 for coats.">
                        <label for="Desc">Description <span class="red-text"><b>*</b></span></label>
                  </div>
             </div>
          </div>

          <div class="modal-footer col s12" style="background-color:#26a69a">
                <button type="submit" id="send" name"send" class=" modal-action  waves-effect waves-green btn-flat">Create</button>
                <button type="reset" value="Reset" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</button> 
          </div>

              {!! Form::close() !!}
            </div>	
        </div>
      </div>
    </div>
  </div>



@stop 

@section('scripts')
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>
    
    <script>
    $(document).ready(function () {
        // Get jQuery object for element with ID as 'category' (first select element)
        var categoryElements = $('.editCategory');

        // Get jQuery object for element with ID as 'types' (second select element)
        var typesElement = $('.editSegment');

        var typeOptions = {};

        typesElement.each(function (typeElem, elem) {
          var elem = $(elem);
          typeOptions[elem.attr('id')] = { element: elem, children: elem.children() };
        });

        console.log(typeOptions);

        // Get children elements of typesElement
        // var typeOptions = typesElement.children();

        categoryElements.each(function (index, categoryElement) {
          var elem = $(categoryElement);

          // Invoke updateValue() once with initial category value for initial page load
          updateValue(elem);

          // Listen for changes on the categoryElement
          elem.on('change', function () {
            // Invoke updateValue() with currently selected category as parameter

            updateValue(elem);
          });
        });


        // Define default current type
        var defaultType = '';

        // updateValue function definition
        function updateValue(categoryElement) {
          var typeOption = typeOptions[categoryElement.attr('id')];
          var category = categoryElement.val();

          // On update, show everything first
          typeOption.children.show();
          
          // Set default type to empty string for All
          defaultType = '';

          // If the selected category is all, do not hide anything
          if (category == 'All') return;

          // Iterate over options (children elements of typesElement)
          for (var i = 0; i < typeOption.children.length; i++) {
            // Return each child as jQuery object
            var optionElement = $(typeOption.children[i]);

            // Check class of optionElement, hide it if it's not equal to the current selected category
            if (!optionElement.hasClass(category)) optionElement.hide();

            // Check class of optionElement if it matches currently selected category AND if defaultType is an empty string,
            // if the evaluation is true, set defaultType to optionElement value. We do this to set the default value
            // when we pick another category
            if (optionElement.hasClass(category) && defaultType == '') defaultType = optionElement.attr('value');
          }

          // If defaultType is not empty string, set it as typesElement value
          if (defaultType != '') typeOption.element.val(defaultType);
        }
      });
    </script>
  

     <script>
      $(document).ready(function(){
      $('select').material_select();
      });
    </script>

    <script>
      $(document).ready(function(){
    $('.materialboxed').materialbox();
     });
    </script>

    
   <!--  <script>
      function clearData(){
        document.getElementById('addsegmentStyleName').value = "";
        document.getElementById('addImage').value = "";
      }
    </script> -->

    <script type="text/javascript">
      $('.validatesegmentStyleName').on('input', function() {
        var input=$(this);
        $regex = "/^[a-zA-Z\'\-]+( [a-zA-Z\'\-]+)*$/";
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

      //Kapag Number
      $('.validatesegmentStyleName').keyup(function() {
        var name = $(this).val();
        $(this).val(name.replace(/\d/, ''));
      });     

      //Kapag whitespace
      $('.validatesegmentStyleName').blur('input', function() {
        var desc = $(this).val();
        $(this).val(desc.trim());
      }); 

      $('.validatesegmentStyleName').blur('input', function() {
        var input=$(this);
        $regex = "/^[a-zA-Z\'\-]+( [a-zA-Z\'\-]+)*$/";
        var is_name=re.test(input.val())  ;
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      }); 
    </script>
         <!--DATA TABLE SCRIPT-->
    <script type="text/javascript">

      $(document).ready(function() {

          $('.data-segmentsegmentStyle').DataTable();
          $('select').material_select();

          setTimeout(function () {
            $('#flash_message').hide();
        }, 5000);

      } );
    </script>

@stop
