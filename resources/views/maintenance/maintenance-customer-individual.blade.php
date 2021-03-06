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

     <!--Edit Fabric Type-->
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


      <!--Delete Fabric Type-->
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

        <!--  <Data Dependency Message> -->
       @if (Input::get('success') == 'beingUsed')
        <div class="row" id="success-message">
          <div class="col s12 m12 l12">
            <div class="card-panel red">
              <span class="black-text" style="color:black">Sorry! Customer cannot be deactivated! Customer is still affiliated in the shop.<i class="tiny mdi-navigation-close right" onclick="$('#success-message').hide()"></i></span>
            </div>
          </div>
        </div>
      @endif


      <div class="row">
        <div class="col s12 m12 l12">
          <span class="page-title"><h4>Maintenance - Customer (Individual)</h4></span>
        </div>
      </div>

        <div class="col s6 left">
          <a style="color:black; margin-right:35px; margin-left: 20px" class="right waves-effect waves-light modal-trigger btn-floating tooltipped btn-large light-green accent-1" data-position="bottom" data-delay="50" data-tooltip="Click to add a new customer to the table" href="#addCusIndi"><i class="large mdi-content-add"></i></a>
        </div>      
      </div>
       

    <div class="row">
      <div class="col s12 m12 l12">
        <div class="card-panel">
          <span class="card-title"><h5 style="color:#1b5e20"><center>List of Invidual Profiles</center></h5></span>
          <div class="divider"></div>


          <div class="card-content">

            <div class="col s12 m12 l12 overflow-x">
    
              <table class = "table centered data-custInd" align = "center" border = "1">
                <thead>
                  <tr>
                    <th data-field="fname">Customer Name</th>
                    <th data-field="address">Address</th>
                    <th data-field="email">Email Address</th>
                    <th data-field="Sex">Sex</th>
                    <th data-field="cellphone">Cellphone No.</th>
                    <th data-field="cellphone">Cellphone No. (alt) </th>
                    <th data-field="Landline">Telephone No.</th>
                    <th data-field="Edit">Actions</th>
                    

                  </tr>
                </thead>

                <tbody>           
                    @foreach($individual as $individual)
                    @if($individual->boolIsActive == 1)
                  <tr>
                    <td>{{ $individual->strIndivFName }} {{ $individual->strIndivMName }} {{ $individual->strIndivLName }}</td>
                    <td>{{ $individual->strIndivHouseNo }} {{ $individual->strIndivStreet }} {{ $individual->strIndivBarangay }} {{ $individual->strIndivCity }} {{ $individual->strIndivProvince }}  {{ $individual->strIndivZipCode }} </td>
                    <td>{{ $individual->strIndivEmailAddress}}</td>   
                    <td>
                    @if($individual->strIndivSex == 'M') Male
                    @elseif($individual->strIndivSex == 'F') Female
                    @endif
                    </td>               
                    <td>{{ $individual->strIndivCPNumber }}</td> 
                    <td>{{ $individual->strIndivCPNumberAlt }}</td> 
                    <td>{{ $individual->strIndivLandlineNumber }}</td>
                    <td><a style="color:black" class="modal-trigger btn tooltipped btn-floating blue" data-position="bottom" data-delay="50" data-tooltip="Click to edit data of customer" href="#edit{{$individual->strIndivID}}"><i class="mdi-editor-mode-edit"></i></a>      
                    <a style="color:black" class="modal-trigger btn tooltipped btn-floating red" data-position="bottom" data-delay="50" data-tooltip="Click to remove customer from table" href="#del{{$individual->strIndivID}}"><i class="mdi-action-delete"></i></a></td>


                    <div id="edit{{$individual->strIndivID}}" class="modal modal-fixed-footer">                     
                      <h5><font color = "#1b5e20"><center>UPDATE INDIVIDUAL'S CUSTOMER PROFILE</center> </font> </h5>
                          {!! Form::open(['url' => 'maintenance/individual/update']) !!}
                            <div class="divider" style="height:2px"></div>
                              <div class="modal-content col s12">


                               <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s12">                 
                                    <input value="{{$individual->strIndivID}}" id="editIndiID" name="editIndiID" type="text" class="" readonly>
                                    <label for="indi_id">Individual ID </label>
                                  </div>
                                </div>


                                <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s4">
                                    <input required id="editFName" name = "editFName" value = "{{$individual->strIndivFName}}"  type="text" class="validate" required data-position="bottom" pattern="^([A-Za-z\-'`]+ )+[A-Za-z\-'`]+$|^[A-Za-z\-'`]+$" maxlength="30" minlength="2">
                                    <label for="first_name"> First Name <span class="red-text"><b>*</b></span></label>
                                  </div>

                                  <div class="input-field col s4">
                                    <input  id="editMName" name = "editMName" value = "{{$individual->strIndivMName}}"  type="text" class="validate" data-position="bottom" pattern="^([A-Za-z\-'`]+ )+[A-Za-z\-'`]+$|^[A-Za-z\-'`]+$" maxlength="30" minlength="2">
                                    <label for="middle_name"> Middle Name </label>
                                  </div>

                                  <div class="input-field col s4">
                                    <input required id="editLName" name = "editLName" value = "{{$individual->strIndivLName}}" type="text" class="validate" required data-position="bottom" pattern="^([A-Za-z\-'`]+ )+[A-Za-z\-'`]+$|^[A-Za-z\-'`]+$" maxlength="30" minlength="2">
                                    <label for="last_name"> Last Name <span class="red-text"><b>*</b></span></label>
                                  </div>

                                    <div class="input-field col s6" style="margin-top:47px">                                
                                      <select required name='editSex'>
                                        <option disabled>Sex</option>
                                            @if($individual->strIndivSex == "M")
                                              <option selected value="{{$individual->strIndivSex}}">Male</option>
                                              <option value="F">Female</option>
                                            @else
                                              <option value="M">Male</option>
                                              <option selected value="{{$individual->strIndivSex}}">Female</option>
                                            @endif
                                      </select>    
                                      <label>Sex</label>
                                    </div>
                                </div>

                                <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s3">
                                    <input required value="{{$individual->strIndivHouseNo}}" id="editCustPrivHouseNo" name="editCustPrivHouseNo" pattern="[0-9a-zA-Z\-\s]+$" type="text" placeholder="1-A" class="validate">
                                    <label for="House No">House No. <span class="red-text"><b>*</b></label>
                                  </div>

                                  <div class="input-field col s3">
                                    <input required value="{{$individual->strIndivStreet }}" id="editCustPrivStreet" name="editCustPrivStreet" pattern="^[a-zA-Z\d\-'`.]+(\s[a-zA-Z\-'`.]+)?" type="text" placeholder="Malunggay" class="validate">
                                    <label for=" Street">Street <span class="red-text"><b>*</b></label>
                                  </div>

                                  <div class="input-field col s3">
                                    <input value="{{$individual->strIndivBarangay}}" id="editCustPrivBarangay" name="editCustPrivBarangay" pattern="^[a-zA-Z\d\-'`.]+(\s[a-zA-Z\-'`.]+)?" type="text" placeholder="Daang Bakal" class="validate">
                                    <label for=" Brgy">Barangay </label>
                                  </div>

                                  <div class="input-field col s3">
                                    <input required value="{{$individual->strIndivCity}}" id="editCustPrivCity" name="editCustPrivCity" pattern="^[a-zA-Z\d\-'`]+(\s[a-zA-Z\-'`]+)?" type="text" placeholder="Mandaluyong" class="validate">
                                    <label for=" City">City/Municipality <span class="red-text"><b>*</b></label>
                                  </div>
                                </div>

                                <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s6">
                                    <input value="{{$individual->strIndivProvince}}" id="editCustPrivProvince" name="editCustPrivProvince" pattern="^[a-zA-Z\d\-'`]+(\s[a-zA-Z\-'`]+)?" type="text" placeholder="Pampanga" class="validate">
                                    <label for=" Province">Province </label>
                                  </div>

                                  <div class="input-field col s6">
                                    <input value="{{$individual->strIndivZipCode}}" id="editCustPrivZipCode" name="editCustPrivZipCode" type="text" pattern="^[0-9]+$"  placeholder="1001" class="validate">
                                    <label for=" Zip Code">Zip Code </label>
                                  </div>
                                </div>

                                <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s12">
                                    <input id="editEmail" name = "editEmail" value = "{{$individual->strIndivEmailAddress}}" type="email" class="validate" >
                                    <label for="email"> Email Address <span class="red-text"><b>*</b></label>
                                  </div>
                                </div>

                                <div class = "col s12" style="padding:15px;  border:3px solid white;">
                                  <div class="input-field col s6">
                                    <input required id="editCel" name = "editCel" value = "{{$individual->strIndivCPNumber}}" pattern="^[0-9]{11,11}$" type="text" class="validate" placeholder="09361234567" maxlength="11">
                                    <label for="cellphone"> Cellphone Number <span class="red-text"><b>*</b></label>
                                  </div>
                      
                                  <div class="input-field col s6">
                                    <input id="editCelAlt" name = "editCelAlt" value = "{{$individual->strIndivCPNumberAlt}}" pattern="^[0-9]{11,11}$" type="text" class="validate" placeholder="09361234567" maxlength="11">
                                    <label for="cellphone"> Cellphone Number (alternate)<span class="red-text"><b>*</b></label>
                                  </div>
                                </div>

                                <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                                  <div class="input-field col s12">
                                    <input id="editPhone" name = "editPhone" value = "{{$individual->strIndivLandlineNumber}}" placeholder="5351673" pattern="^[0-9]{6,10}$" type="text" class="validate" maxlength="10">
                                    <label for="tel"> Telephone Number </label>
                                  </div>
                                </div>
                    </div>

                    <div class="modal-footer col s12" style="background-color:#26a69a">
                          <button type="submit" class="waves-effect waves-green btn-flat">Update</button>
                          <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
                    </div>   
                    {!! Form::close() !!}
                  </div>

                    <div id="del{{$individual->strIndivID}}" class="modal modal-fixed-footer">                     
                        <h5><font color:"#1b5e20"><center>ARE YOU SURE TO DEACTIVATE THIS CUSTOMER?</center> </font> </h5>                        
                          {!! Form::open(['url' => 'maintenance/individual/destroy']) !!}
                            <div class="divider" style="height:2px"></div>
                            <div class="modal-content col s12">

                        <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s12">
                            <label for="first_name">Individual ID </label>
                            <input value="{{$individual->strIndivID}}" id="delIndivID" name="delIndivID" type="text" readonly>
                          </div>
                        </div>

                        <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s4">
                            <label for="first_name">First Name </label>
                            <input value="{{$individual->strIndivFName}}" id="delIndivFName" name="delIndivFName" type="text" readonly>
                          </div>

                           <div class="input-field col s4">
                            <label for="middle_name">Middle Name </label>
                            <input value="{{$individual->strIndivMName}}" id="delIndivMName" name="delIndivMName" type="text" readonly>
                          </div>

                          <div class="input-field col s4">
                            <input value="{{$individual->strIndivLName}}" id="delIndivLName" name="delIndivLName" type="text" readonly>
                            <label for="LastName">Last Name </label>
                          </div>
                        </div>

                        <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                          <div class="input-field col s12">
                            <label for="inactive_reason">Reason for Deactivation <span class="red-text"><b>*</b></label>
                            <input required  id="delInactiveReason" name = "delInactiveReason" value = "{{$individual->strIndivInactiveReason}}" type="text">
                          </div>
                        </div>
                        </div>

                          <div class="modal-footer col s12" style="background-color:#26a69a">
                            <button type="submit" style="color:black" class="modal-action waves-effect waves-green btn-flat">OK</button>
                            <a href="#!" style="color:black" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a>
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
             

            <div id="addCusIndi" class="modal modal-fixed-footer">
              <div class = "label"><h5><font color = "#1b5e20"><center>CREATE NEW INDIVIDUAL CUSTOMER PROFILE </center> </font> </h5>
                {!! Form::open(['url' => 'maintenance/individual' , 'method' => 'post']) !!}
                  <div class="divider" style="height:2px"></div>
                  <div class="modal-content col s12">

                    <div class = "col s12" style="padding:15px;  border:3px solid white;">
                        <div class="input-field col s12">                 
                          <input value = "{{$newID}}" id="strIndivID" name="strIndivID" type="text" class="" readonly>
                          <label for="indi_id">Individual ID </label>
                        </div>
                    </div>

                    <div class = "col s12" style="padding:15px;  border:3px solid white;">
                        <div class="input-field col s4">
                          <input required id="strIndivFName" name = "strIndivFName" placeholder="Hope" type="text" class="validate" required data-position="bottom" pattern="^([A-Za-z\-'`]+ )+[A-Za-z\-'`]+$|^[A-Za-z\-'`]+$" maxlength="30" minlength="2">
                          <label for="first_name" > First Name <span class="red-text"><b>*</b></label>
                        </div>

                        <div class="input-field col s4">
                          <input id="strIndivMName" name = "strIndivMName" placeholder="Elizabeth" type="text" class="validate" data-position="bottom" pattern="^([A-Za-z\-'`]+ )+[A-Za-z\-'`]+$|^[A-Za-z\-'`]+$" maxlength="30" minlength="2">
                          <label for="middle_name"> Middle Name </label>
                        </div>

                        <div class="input-field col s4">
                          <input required id="strIndivLName" name = "strIndivLName" placeholder="Soberano" type="text" class="validate" required data-position="bottom" pattern="^([A-Za-z\-'`]+ )+[A-Za-z\-'`]+$|^[A-Za-z\-'`]+$" maxlength="30" minlength="2">
                          <label for="last_name"> Last Name <span class="red-text"><b>*</b></label>
                        </div>

                        <div class="input-field col s12" style="margin-top:47px">
                          <select value="" name='strIndivSex' id='strIndivSex' required>
                              <option value="M">Male</option>
                              <option value="F">Female</option>
                          </select>    
                          <label>Sex</label>
                        </div>
                      </div>

                     
                        <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s3">
                            <input required id="strIndivHouseNo" name="strIndivHouseNo" pattern="[0-9a-zA-Z\-\s]+$" type="text" placeholder="1-A" class="validate">
                            <label for="House No">House No. <span class="red-text"><b>*</b></label>
                        </div>

                           <div class="input-field col s3">
                            <input required id="strIndivStreet" name="strIndivStreet" pattern="^[a-zA-Z\d\-'`.]+(\s[a-zA-Z\-'`.]+)?" type="text" placeholder="Malunggay" class="validate">
                            <label for=" Street">Street <span class="red-text"><b>*</b></label>
                          </div>
                          <!-- ^[a-zA-Z\-'`]+(\s[a-zA-Z\-'`]+)? -->
                         <!--  ^[a-zA-Z0-9\'\-\.]+(\s[a-zA-Z0-9\'\-\.]+)*$ -->

                          <div class="input-field col s3">
                            <input  id="strIndivBarangay" name="strIndivBarangay" pattern="^[a-zA-Z\d\-'`.]+(\s[a-zA-Z\-'`.]+)?" type="text" placeholder="Daang Bakal" class="validate">
                            <label for=" Brgy">Barangay/Subd </label>
                          </div>

                          <div class="input-field col s3">
                            <input required id="strIndivCity" name="strIndivCity" pattern="^[a-zA-Z\d\-'`]+(\s[a-zA-Z\-'`]+)?" type="text" placeholder="Mandaluyong" class="validate">
                            <label for=" City">City/Municipality <span class="red-text"><b>*</b></label>
                          </div>
                      </div>

                      <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s6">
                            <input id="strIndivProvince" name="strIndivProvince" pattern="^[a-zA-Z\d\-'`]+(\s[a-zA-Z\-'`]+)?" type="text" placeholder="Pampanga" class="validate">
                            <label for=" Province">Province/Region </label>
                          </div>
                        {{--   ^[a-zA-Z\'\-\.]+( \s[a-zA-Z\'\-\.]+)*$ --}}

                           <div class="input-field col s6">
                            <input id="strIndivZipCode" name="strIndivZipCode" type="text" pattern="^[0-9]+$"  placeholder="1001" class="validate">
                            <label for=" Zip Code">Zip Code </label>
                          </div>
                      </div>

                      <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s12">
                            <input required id="strIndivEmailAddress" name = "strIndivEmailAddress" type="email" class="validate">
                            <label for="email"> Email Address <span class="red-text"><b>*</b></label>
                          </div>
                      </div>

                      <div class = "col s12" style="padding:15px;  border:3px solid white;">
                          <div class="input-field col s6">
                            <input required id="strIndivCPNumber" name = "strIndivCPNumber" pattern="^[0-9]{11,11}$" type="text" class="validate" placeholder="09361234567" maxlength="11">
                            <label for="cellphone"> Cellphone Number <span class="red-text"><b>*</b></label>
                          </div>

                          <div class="input-field col s6">
                            <input id="strIndivCPNumberAlt" name = "strIndivCPNumberAlt" pattern="^[0-9]{11,11}$" type="text" class="validate" placeholder="09361234567" maxlength="11">
                            <label for="cellphone"> Cellphone Number (alternate)</label>
                          </div>
                      </div>

                      <div class = "col s12" style="padding:15px;  border:3px solid white; margin-bottom:40px">
                          <div class="input-field col s12">
                            <input id="strIndivLandlineNumber" name = "strIndivLandlineNumber" placeholder="5351673" pattern="^[0-9]{6,10}$" type="text" class="validate" maxlength="10">
                            <label for="tel"> Telephone Number </label>
                          </div>
                      </div>
                </div>

              <div class="modal-footer col s12" style="background-color:#26a69a">
                <button type="submit" name="send" id="send" class="waves-effect waves-green btn-flat">Create</button> 
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
    {!! Html::script('js/customer_validation.js') !!}

          <!--DATA TABLE SCRIPT-->
    <script type="text/javascript">

      $(document).ready(function() {

          $('.data-custInd').DataTable();
           $('select').material_select();

        setTimeout(function () {
            $('#flash_message').hide();
        }, 5000);

         setTimeout(function () {
            $('#success-message').hide();
        }, 5000);

      } );

    </script>

      <!--TOOLTIP SCRIPT-->
    <script type="text/javascript">
         $(document).ready(function(){
           $('.tooltipped').tooltip({delay: 50});
          }); 
    </script>
@stop