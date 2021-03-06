@extends('layouts.master')

@section('content')
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
  
 <!--Add Fabric-->
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

     <!--Edit Fabric-->
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


      <!--Delete Fabric-->
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


      <!-- Update Duplicate -->
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

      <!--Reactivate Garment Category-->
      @if (Input::get('successRec') == 'true')
        <div class="row" id="success-message">
          <div class="col s12 m12 l12">
            <div class="card-panel yellow">
              <span class="black-text" style="color:black">Successfully reactivated material!<i class="tiny mdi-navigation-close right" onclick="$('#success-message').hide()"></i></span>
            </div>
          </div>
        </div>
      @endif

    <!--  <Data Dependency Message> -->
       @if (Input::get('success') == 'beingUsed')
        <div class="row" id="success-message">
          <div class="col s12 m12 l12">
            <div class="card-panel red">
              <span class="black-text" style="color:black">Sorry! Cannot deactivate the material. It's still being used!<i class="tiny mdi-navigation-close right" onclick="$('#success-message').hide()"></i></span>
            </div>
          </div>
        </div>
      @endif

	<div class="main-wrapper"  style="margin-top:30px">

    <div class="row">
        <div class="col s12 m12 l12">
        <span class="page-title"><h4>Materials Maintenance - Hook and Eye</h4></span>
        </div>
    </div>

       <div class="row">
        <div class="col s12 m12 l12">
            <a class="right waves-effect waves-light modal-trigger btn-floating tooltipped btn-large light-green accent-1" data-position="left" data-delay="50" data-tooltip="Click to add a new hook and eye detail to the table" href="#addHookEye" style="color:black; margin-right:35px; margin-left: 20px;"><i class="large mdi-content-add"></i></a>
        </div>
      </div> 


        <div class="row">
          <div class="col s12">
            <div class="card">
              <div class="card-content">
                <div class = "col s12 m12 l12 overflow-x">
                  <h5><font color = "#1b5e20"><center>List of Hook & Eyes and Velcros</center> </font> </h5>
                  <table class = "table centered data-hook" border = "1">

                    <thead>
                      <tr>
                        <!--<th date-field="Hook and Eye ID">Hook and Eye ID</th>-->
                        <th data-field="Hook and Eye Name"> Hook Brand</th>
                        <th data-field="Hook and Eyes"> Size </th>
                        <th data-field="Hook and Eye Color"> Hook Color</th>
                        <th data-field="Hook and Eye Desc">Description</th>
                        <th data-field="Image">Image</th>
                        <th data-field="Hook and Eye Desc">Edit</th>
                        <th data-field="Image">Deactivate</th>
                      </tr>
                    </thead>

                    <tbody>
                      @foreach($hooks as $hook)
                      @if($hook->boolIsActive == 1)
                      <tr>
                       <!-- <td>{{$hook->intHookID}}</td>-->
                        <td>{{$hook->strHookBrand}}</td>
                        <td>{{$hook->strHookSize}}</td>
                        <td>{{$hook->strHookColor}}</td>
                        <td>{{$hook->textHookDesc}}</td>
                        <td><img class="materialboxed" width="650" src="{{URL::asset($hook->strHookImage)}}"></td>

                        <td><a style="color:black" class="modal-trigger btn tooltipped btn-floating blue" data-position="bottom" data-delay="50" data-tooltip="Click to edit hook and eye detail" href="#edit{{$hook->intHookID}}"><i class="mdi-editor-mode-edit"></i></a></td>
                        <td><a style="color:black" class="modal-trigger btn tooltipped btn-floating red" data-position="bottom" data-delay="50" data-tooltip="Click to remove data of hook and eye detail from the table" href="#del{{$hook->intHookID}}"><i class="mdi-action-delete"></i></a></td>

                            
                          <div id="edit{{$hook->intHookID}}" class="modal modal-fixed-footer">
                            <h5><font color = "#1b5e20"><center>EDIT HOOK AND EYE</center> </font> </h5>
                              
                            {!! Form::open(['url' => 'maintenance/material-hookandeye/update' , 'files' => 'true']) !!}
                              <div class="divider" style="height:2px"></div>
                              <div class="modal-content col s12"> 
                                                         
                                <div class="input-field">
                                  <input id="editHookID" name = "editHookID" value = "{{$hook->intHookID}}" type="hidden">
                                </div>
                          
                            <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                <div class="input-field col s12">
                                  <input id="editHookBrand" name = "editHookBrand" value = "{{$hook->strHookBrand}}" type="text" class="validate" required data-position="bottom" pattern="^[a-zA-Z\-'`]+(\s[a-zA-Z\-'`]+)?" >
                                  <label for="HookEye_Name"> Hook and Eye Brand <span class="red-text"><b>*</b></span></label>
                                </div>
                            </div>

                            <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                <div class="input-field col s6">
                                  <input id="editHookSize" name = "editHookSize" value = "{{$hook->strHookSize}}" type="text" class="validate" required data-position="bottom" pattern="^[a-zA-Z\-'`]+(\s[a-zA-Z\-'`]+)?" >
                                  <label for="HookEye_s"> Hook and Eye Size<span class="red-text"><b>*</b></span></label>
                                </div>

                                <div class="input-field col s6">
                                  <input id="editHookColor" name = "editHookColor" value = "{{$hook->strHookColor}}" type="text" class="validate" required data-position="bottom" pattern="^[a-zA-Z\-'`]+(\s[a-zA-Z\-'`]+)?" >
                                  <label for="Hookeye_Color"> Hook and Eye Color <span class="red-text"><b>*</b></span></label>
                                </div>
                            </div>

                            <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                <div class="input-field col s12">
                                  <input id="editHookDesc" name = "editHookDesc" value = "{{$hook->textHookDesc}}" type="text" class="validate">
                                  <label for="Hookeye_Desc">Description </label>
                                </div>
                            </div>

                            <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                                <div class="file-field input-field col s12">
                                  <div style="color:black" class="btn tooltipped btn-small center-text light-green lighten-2" data-position="bottom" data-delay="50" data-tooltip="May upload jpg, png, gif, bmp, tif, tiff files">
                                    <span>Upload Image</span>
                                    <input type="file" id="editImg" name="editImg" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*">
                                  </div>
                                  <div class="file-path-wrapper">
                                    <input value="{{$hook->strHookImage}}" id="editHookImage" name="editHookImage" class="file-path validate" type="text">
                                  </div>
                                </div> 
                            </div>
                            </div>    

                            <div class="modal-footer col s12" style="background-color:#26a69a">
                                <button type="submit" class="modal-action  waves-effect waves-green btn-flat">Update</button>
                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>   
                            </div>
                            {!! Form::close() !!}
                          </div>
                        

                          <div id="del{{$hook->intHookID}}" class="modal modal-fixed-footer">
                            <h5><font color = "#1b5e20"><center>ARE YOU SURE TO DEACTIVATE THIS HOOK AND EYE?</center> </font> </h5>
                              
                            {!! Form::open(['url' => 'maintenance/material-hookandeye/destroy']) !!}
                              <div class="divider" style="height:2px"></div>
                              <div class="modal-content col s12">
                                

                                 <div class="input-field">
                                    <input value="{{$hook->intHookID}}" id="delHookID" name="delHookID" type="hidden">
                                  </div>

                              <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s12">
                                    <label for="Hook_Name">Hook and Eye Name </label>
                                    <input value="{{$hook->strHookBrand}}" id="delHookName" name="delHookName" type="text" readonly>
                                  </div>
                              </div>

                              <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s6">
                                    <label for="Hook_s">Hook and Eye Size </label>
                                    <input value="{{$hook->strHookSize}}" id="delHooks" name="delHooks" type="text" readonly>
                                  </div>

                                  <div class="input-field col s6">
                                    <label for="Hook_Color">Hook and Eye Color </label>
                                    <input value="{{$hook->strHookColor}}" id="delHookColor" name="delHookColor" type="text" readonly>
                                  </div>
                              </div>

                              <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s12">
                                    <label for="Hook_Desc">Description </label>
                                    <input value="{{$hook->textHookDesc}}" id="delHookDesc" name="delHookDesc" type="text" readonly>
                                  </div>
                              </div>

                              <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s12">
                                    <label fo="inactive_reason"> Reason for Deactivation <span class="red-text"><b>*</b></span></label>
                                    <input value="{{$hook->strHookInactiveReason}}" required id="delInactiveHook" name="delInactiveHook" type="text">
                                  </div>
                                </div>

                              <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                                  <!--<div class="input-field col s12">
                                    <input id="delInactiveReason" name = "delInactiveReason" value="{{$hook->strHookInactiveReason}}" type="text" class="validate" required>
                                    <label for="Thread_Color"> *Reason for Deactivation </label>-->
                                  </div>
                              </div>
                              

                              <div class="modal-footer col s12" style="background-color:#26a69a">
                                <button type="submit" class="waves-effect waves-green btn-flat">OK</button>
                                <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a> 
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
                <div class = "clearfix"></div>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>


	</div>

	  <!--MODAL: CREATE HookEye-->
  <div id="addHookEye" class="modal modal-fixed-footer">
    <h5><font color = "#1b5e20"><center>CREATE NEW HOOK AND EYE</center> </font> </h5>
      
    {!! Form::open(['url' => 'maintenance/material-hookandeye', 'method' => 'post', 'files' => 'true']) !!}
      <div class="divider" style="height:2px"></div>
      <div class="modal-content col s12">
    
        <div class="input-field">
          <input id="intHookID" name = "intHookID" value = "{{$newHookID}}" type="hidden">
        </div>
          
      <div class = "col s12" style="padding:15px;  border:3px solid white;">          
        <div class="input-field col s12">
          <input required id="strHookBrand" name = "strHookBrand" type="text" class="validate" required data-position="bottom" pattern="^[a-zA-Z\-'`]+(\s[a-zA-Z\-'`]+)?" >
          <label for="HookEye_Name"> Hook and Eye Brand <span class="red-text"><b>*</b></span></label>
        </div>
      </div>

      <div class = "col s12" style="padding:15px;  border:3px solid white;">
        <div class="input-field col s6">
          <input required id="strHookSize" name = "strHookSize" type="text" class="validate" required data-position="bottom" pattern="^[a-zA-Z\-'`]+(\s[a-zA-Z\-'`]+)?" >
          <label for="HookEye_s"> Hook and Eye Size <span class="red-text"><b>*</b></span></label>
        </div>

        <div class="input-field col s6">
          <input required id="strHookColor" name = "strHookColor" type="text" class="validate" required data-position="bottom" pattern="^[a-zA-Z\-'`]+(\s[a-zA-Z\-'`]+)?" >
          <label for="Hookeye_Color"> Hook and Eye Color <span class="red-text"><b>*</b></span></label>
        </div>
      </div>

      <div class = "col s12" style="padding:15px;  border:3px solid white;">
         <div class="input-field col s12">
          <input id="textHookDesc" name = "textHookDesc" type="text" class="validate">
          <label for="Hookeye_Desc"> Description </label>
        </div>
      </div>

      <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
        <div class="file-field input-field col s12">
          <div style="color:black" class="btn tooltipped btn-small center-text light-green lighten-2" data-position="bottom" data-delay="50" data-tooltip="May upload jpg, png, gif, bmp, tif, tiff files">
            <span>Upload Image</span>
            <input type="file" id="addImg" name="addImg" accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|images/*">
          </div>
          <div class="file-path-wrapper">
            <input class="file-path validate" id="addImage" name="addImage" type="text">
          </div>
        </div>
      </div>
     </div>
    
      <!--MODAL FOOTER-->
      <div class="modal-footer col s12" style="background-color:#26a69a">
        <button type="submit" class=" modal-action  waves-effect waves-green btn-flat">Add</button>
        <button type="button" type="reset" value="Reset" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</button> 
      </div>
      
    {!! Form::close() !!}
  </div>
@stop


@section('scripts')
  <script type="text/javascript">
  
      $('.validateName').on('input', function() {
          var input=$(this);
          var re = /^[a-zA-Z0-9\'\-]+( [a-zA-Z0-9\'\-]+)*$/;
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
        var re = /^[a-zA-Z0-9\'\-]+( [a-zA-Z0-9\'\-]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      }); 

      $('.validates').on('input', function() {
          var input=$(this);
          var $re = /^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$/;
          var is_name=re.test(input.val());
          if(is_name){input.removeClass("invalid").addClass("valid");}
          else{input.removeClass("valid").addClass("invalid");}
        });

      //Kapag whitespace
      $('.validates').blur('input', function() {
        var name = $(this).val();
        $(this).val(name.trim());
      });

      $('.validates').blur('input', function() {
        var input=$(this);
        var re = /^[a-zA-Z0-9]+( [a-zA-Z0-9]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      }); 

      $('.validateColor').on('input', function() {
          var input=$(this);
          var $re = /^[a-zA-Z\,]+( [a-zA-Z\,]+)*$/;
          var is_name=re.test(input.val());
          if(is_name){input.removeClass("invalid").addClass("valid");}
          else{input.removeClass("valid").addClass("invalid");}
        });

      //Kapag Number
      $('.validateColor').keyup(function() {
        var name = $(this).val();
        $(this).val(name.replace(/\d/, ''));
      });     

      //Kapag whitespace
      $('.validateColor').blur('input', function() {
        var name = $(this).val();
        $(this).val(name.trim());
      });

      $('.validateColor').blur('input', function() {
        var input=$(this);
        var re = /^[a-zA-Z\,]+( [a-zA-Z\,]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      }); 

      $('.validateDesc').blur('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z0-9\'\-\.\,]+( [a-zA-Z0-9\,\'\-\.]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      }); 
    
      //Kapag whitespace
      $('.validateDesc').blur('input', function() {
        var name = $(this).val();
        $(this).val(name.trim());
      });

      $('.validateDesc').on('input', function() {
        var input=$(this);
        var re=/^[a-zA-Z0-9\'\-\.\,]+( [a-zA-Z0-9\,\'\-\.]+)*$/;
        var is_name=re.test(input.val());
        if(is_name){input.removeClass("invalid").addClass("valid");}
        else{input.removeClass("valid").addClass("invalid");}
      }); 

  </script>
          <!--DATA TABLE SCRIPT-->
    <script type="text/javascript">
      $(document).ready(function() {
          $('.data-hook').DataTable();
          $('select').material_select();
          
          setTimeout(function () {
            $('#flash_message').hide();
        }, 5000);
      } );
    </script>

@stop

  