@extends('layouts.master')

@section('content')
    <div class="main-wrapper">
                  <!--Input Validation-->
              @if (Input::get('input') == 'invalid')
                <div class="row" id="success-message">
                  <div class="col s12 m12 l12">
                    <div class="card-panel red">
                      <span class="black-text" style="color:black">Invalid input!<i class="material-icons right" onclick="$('#success-message').hide()">clear</i></span>
                    </div>
                  </div>
                </div>
              @endif
  

            <!--Add -->
        @if(Session::has('flash_message'))
        <div class="row" id="flash_message">
          <div class="col s12 m12 l12">
            <div class="card-panel yellow accent-1">
              <span class="alert alert-success"> <i class="material-icons right" onclick="$('#flash_message').hide()">clear</i></span>
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
              <span class="alert alert-success"><i class="material-icons right" onclick="$('#flash_message').hide()">clear</i></span>
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
              <span class="alert alert-success"><i class="material-icons right" onclick="$('#flash_message').hide()">clear</i></span>
               <em> {!! session('flash_message_delete') !!}</em>
            </div>
          </div>
        </div>
      @endif

                  <!--  <Duplicate Error Message>   -->
                  @if (Input::get('successHead') == 'duplicate')
                      <div class="row" id="success-message">
                        <div class="col s12 m12 l12">
                          <div class="card-panel red">
                            <span class="black-text" style="color:black">Record already exists!<i class="material-icons right" onclick="$('#success-message').hide()">clear</i></span>
                          </div>
                        </div>
                      </div>
                    @endif

                    <!--  <Duplicate Error Message>   -->
                    @if (Input::get('successPart') == 'duplicate')
                        <div class="row" id="success-message">
                          <div class="col s12 m12 l12">
                            <div class="card-panel red">
                              <span class="black-text" style="color:black">Record already exists!<i class="material-icons right" onclick="$('#success-message').hide()">clear</i></span>
                            </div>
                          </div>
                        </div>
                      @endif


                       <!--  <Data Dependency Message> -->
       @if (Input::get('success') == 'beingUsed')
        <div class="row" id="success-message">
          <div class="col s12 m12 l12">
            <div class="card-panel red">
              <span class="black-text" style="color:black">Sorry! Cannot deactivate garment category. It's still being used!<i class="material-icons right" onclick="$('#success-message').hide()">clear</i></span>
            </div>
          </div>
        </div>
      @endif
  

  <br><br><br>
 <p><h4 style="lightpink">Measurement Category</h4></p>
    <div class="row" style="padding:20px">
    

    <!--Measurement Tabs-->
<!--      <div class="col s12" id="measurements" name="measurements">
        <ul class="tabs transparent">
          <li id="detailTab" class="tab col s3" style="background-color: #00b0ff;"><a style="color:black; padding-top:5px; opacity:0.80" class="tooltipped center-text" accent data-position="bottom" data-delay="50" data-tooltip="Click to see to parts being measured" href="#tabDetails"><b>Details</b></a></li>     
          <li id="categoryTab" class="tab col s3" style="background-color: #00b0ff;"><a @if (Input::get('isCat') == 'true') class="active" @endif style="color:black; padding-top:5px; opacity:0.80" class="tooltipped center-text" accent data-position="bottom" data-delay="50" data-tooltip="Click to see measurement details about a particular garment" href="#tabCategory"><b>Category</b></a></li>
          <div class="indicator white" style="z-index:1"></div>
        </ul>
-->    
    <!--Tab Contents-->
    <!--Measurement Category-->
        <div class="col s1 left">
             <a class="right waves-effect waves-light modal-trigger btn-floating tooltipped btn-large light-green accent-1" data-position="bottom" data-delay="50"  data-tooltip="Click to add a new measurement information to the table" href="#addMeasurementInfo" style="color:black; margin-right:35px; margin-left: 20px;"><i class="large mdi-content-add"></i></a>
          </div>
        </div> 
    </div> <!--DIV CLASS MAIN WRAPPER-->       
 
          <div class="row">
            <div class="col s12 m12 l12">
              <div class="card-panel">
                <span class="card-title"><h5><center>Measurement Category</center></h5></span>
                <div class="divider"></div>
                <div class="card-content">

                  <div class="col s12 m12 l12 overflow-x">
                    <table class = "table centered data-measHead" align = "center" border = "1">
                      <thead>
                        <tr>
                          <th data-field="Garmentcategory">Garment Category</th>
                          <th data-field="Garmentcategory">Segment</th>
                          <th data-field="MeasurementName">Action</th>
                          
                        </tr>
                      </thead>

                      <tbody>
                            @foreach($head as $head) 
                            @if($head->boolIsActive == 1) 
                        <tr>   
                          <td>{{ $head->strGarmentCategoryName }}</td>
                          <td>{{ $head->strSegmentName }}</td>
                          <td><a style = "color:black" class="modal-trigger btn tooltipped btn-floating blue" data-position="bottom" data-delay="50" data-tooltip="Click to edit measurement information" href="#{{$head->strMeasCatID}}{{$head->strMeasSegmentFK}}"><i class="mdi-editor-mode-edit"></i></a>                         
                        
                          <div id="{{$head->strMeasCatID}}{{$head->strMeasSegmentFK}}" class="modal modal-fixed-footer">
                            <h5><font color = "#1b5e20"><center>EDIT MEASUREMENT INFORMATION</center> </font> </h5>
                            
                              <div class="divider" style="height:2px"></div>
                              <div class="modal-content col s12">
                                  <table class = "table centered" align = "center" border = "1">
                                    <thead>
                                      <tr>
                                        <th data-field="MeasurementName">Measurement Name</th>
                                        <th data-field="MeasurementName">Action</th>
                                      </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                          <td>{{ $head->strMeasurementDetailName }}</td> 
                                          <td>
                                            <a style = "color:black" class="modal-trigger btn tooltipped btn-floating red" data-position="bottom" data-delay="50" data-tooltip="Click to edit measurement information" href="#del{{$head->strMeasCatID}}"><i class="mdi-action-delete"></i></a>
                                          </td>
                                        </tr>
                                    </tbody>
                                  </table>
                              </div>
                              
                              <div class="modal-footer col s12" style="background-color:#26a69a">
                                <button type="button" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</button>  
                              </div>

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

                  <div id="addMeasurementInfo" class="modal modal-fixed-footer">
                    <h5><font color = "#1b5e20"><center>ADD NEW MEASUREMENT INFORMATION</center> </font> </h5> 
                      
                      {!! Form::open(['url' => 'maintenance/measurement-category', 'method' => 'post']) !!}
                        <div class="divider" style="height:2px"></div>
                        <div class="modal-content col s12">

                          <input type="hidden" name="_token" value="{!! csrf_token() !!}" />
                          <input value="{{ $newID }}" id="addMeasurementID" name="addMeasurementID" type="text" hidden>
                          

                      <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s6">                                                    
                              <select class="browser-default" required id="addCategory" name="addCategory">                                      
                                  @foreach($category as $category_1)
                                    @if($category_1->boolIsActive == 1)  
                                      <option value="{{ $category_1->strGarmentCategoryID }}">{{ $category_1->strGarmentCategoryName }}</option>
                                    @endif
                                  @endforeach
                              </select>    
                          </div>        
                
                          <div class="input-field col s6">                                                    
                            <select class="browser-default" required id="addSegment" name="addSegment">
                                @foreach($segment as $segment_1)
                                  @if($segment_1->boolIsActive == 1)
                                    <option value="{{ $segment_1->strSegmentID }}" class="{{ $segment_1->strSegCategoryFK }}">{{ $segment_1->strSegmentName }}</option>
                                  @endif
                                @endforeach                          
                            </select>    
                          </div>   
                      </div>  

                      <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                          <div class="input-field col s12">                                                                                 
                            <select class="browser-default" name="addDetail" id="addDetail" required>
                                @foreach($detailList as $detail_1)
                                  @if($detail_1->boolIsActive == 1)
                                    <option value="{{ $detail_1->strMeasurementDetailID }}" class="">{{ $detail_1->strMeasurementDetailName }}</option>
                                  @endif
                                @endforeach                               
                            </select>
                          </div>
                      </div>                       
                      </div>

                      <div class="modal-footer col s12" style="background-color:#26a69a">
                        <button type="submit" class=" modal-action  waves-effect waves-green btn-flat">Add</button>
                        <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>  
                      </div>
                    {!! Form::close() !!}
                  </div> 
                  
                </div> 
              </div>
            </div>
          </div>
      
        <!--END OF MEASUREMENT CATEGORY-->



  @stop

@section('scripts')
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="js/jquery-migrate-1.2.1.min.js"></script>

    <script>
      // $(document).ready() executes this script AFTER the whole page loads
      $(document).ready(function () {
        // Get jQuery object for element with ID as 'category' (first select element)
        var categoryElement = $('#addCategory');

        // Get jQuery object for element with ID as 'types' (second select element)
        var typesElement = $('#addSegment');

        // Get children elements of typesElement
        var typeOptions = typesElement.children();

        // Invoke updateValue() once with initial category value for initial page load
        updateValue(categoryElement.val());

        // Listen for changes on the categoryElement
        categoryElement.on('change', function () {
          // Invoke updateValue() with currently selected category as parameter
          updateValue(categoryElement.val());
        });

        // Define default current type
        var defaultType = '';

        // updateValue function definition
        function updateValue(category) {
          // On update, show everything first
          typeOptions.show();

          // Set default type to empty string for All
          defaultType = '';

          // If the selected category is all, do not hide anything
          if (category == 'All') return;

          // Iterate over options (children elements of typesElement)
          for (var i = 0; i < typeOptions.length; i++) {
            // Return each child as jQuery object
            var optionElement = $(typeOptions[i]);

            // Check class of optionElement, hide it if it's not equal to the current selected category
            if (!optionElement.hasClass(category)) optionElement.hide();

            // Check class of optionElement if it matches currently selected category AND if defaultType is an empty string,
            // if the evaluation is true, set defaultType to optionElement value. We do this to set the default value
            // when we pick another category
            if (optionElement.hasClass(category) && defaultType == '') defaultType = optionElement.attr('value');
          }

          // If defaultType is not empty string, set it as typesElement value
          if (defaultType != '') typesElement.val(defaultType);
        }
      });
    </script>

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
        $('ul.tabs').tabs();
        });
    </script>
    
    <script>
      $(document).ready(function(){
      $('select').material_select();
      });
    </script>
    
    <script>
      function clearData(){
          document.getElementById('addDetailDesc').value = "";
          document.getElementById('addDetailName').value = "";
      }
    </script>

    <script type="text/javascript">
      $('.validateDetailName').on('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z\'\-]+( [a-zA-Z\'\-]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });
      //Kapag Number
      $('.validateDetailName').keyup(function() {
        var name = $(this).val();
        $(this).val(name.replace(/\d/, ''));
      });

      $('.validateDetailName').blur('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z\'\-]+( [a-zA-Z\'\-]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      }); 

      //Kapag whitespace
      $('.validateDetailName').blur('input', function() {
        var desc = $(this).val();
        $(this).val(desc.trim());
      }); 

      $('.validateDetailDesc').on('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z0-9\'\-\.\,]+( [a-zA-Z0-9\,\'\-\.]+)*$/;
        var is_desc=re.test(input.val());
        if(is_desc){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });
      $('.validateDetailDesc').blur('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z0-9\'\-\.\,]+( [a-zA-Z0-9\,\'\-\.]+)*$/;
        var is_desc=re.test(input.val());
        if(is_desc){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      });

            //Kapag whitespace
      $('.validateDetailDesc').blur('input', function() {
        var desc = $(this).val();
        $(this).val(desc.trim());
      }); 

    </script>
         <!--DATA TABLE SCRIPT-->
    <script type="text/javascript">
      $(document).ready(function() {
          $('.data-measDet').DataTable();
          $('.data-measHead').DataTable();
          $('select').material_select();
          
          setTimeout(function () {
            $('#flash_message').hide();
        }, 5000);
      } );
    </script>


@stop