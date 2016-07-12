@extends('layouts.masterOnline')

@section('content')


  <div class="row section white container" style="margin-top:40px; padding:40px;">

    <div class="row" style="margin-top:40px;">
      <div class="col s12">
        <div class="col s4">
          <div class="divider grey" style="margin-bottom:5px;"></div>
          <div class="divider grey"></div>
        </div>

        <div class="col s4" style="margin-top:-30px;">
          <center><span style="font-size:40px; color: #757575; font-family:'Playfair Display','Times';">Alteration Order</span></center>
        </div>

        <div class="col s4">
          <div class="divider grey" style="margin-bottom:5px;"></div>
          <div class="divider grey"></div>
        </div>
      </div>
    </div>

      <div class="col s12">
        <label style="margin-left:10px;"><font size="+2" color="teal">Your Order:</font></label>
        <div style="margin-right:20px; margin-top:-30px;"><a class="red accent-2 btn-flat modal-trigger right tooltipped white-text" href="#create-order" data-position="bottom" data-delay="50" data-tooltip="Click to create a new order">CREATE ORDER</a></div>
      </div>

      <div style="padding:20px;">
        <table class="centered">
          <thead>
            <tr>
                <th>Segment</th>
                <th>Alteration Type</th>
                <th>Price</th>
                <th>Description</th>
                <th></th>
            </tr>
          </thead>

          <tbody>
            <tr>
              <td>Skirt</td>
              <td>zipper</td>
              <td>$0.87</td>
              <td>sira yung zipper bes</td>
              <td><a class="btn modal-trigger circle red" href="#removeOrder" style="border-radius:180px;"><i class="mdi-content-clear"></i></a></td>
            </tr>
          </tbody>
        </table>
      </div>


      <div class="row" style="padding:20px;">                              
        <a href="#resetOrder" class="btn modal-trigger left tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click to cancel transaction and go back to homepage" style="padding:10px; padding-bottom:45px; background-color:teal; color:white">RESET ORDER</a>
        <a href="#summary-of-order" class="btn modal-trigger right tooltipped" data-position="bottom" data-delay="50" data-tooltip="Click to save data and proceed to next step" style="padding:10px; padding-left:19px; padding-right:19px; padding-bottom:45px; background-color:teal; color:white">CHECKOUT</a>  
      </div>

  </div>

<!--MODALS-->

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
          <p><font size="+1">Are you sure you want to remove this order?</font></p>
        </div>
      </div>
    </div>
    <div class="modal-footer col s12" style="background-color:red; opacity:0.85">
      <button type="submit" class="waves-effect waves-green btn-flat" href="#!"><font color="black">Yes</font></button>
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat"><font color="black">No</font></a>
    </div>
  </div>

  <!--Reset Order Modal-->
  <div id="resetOrder" class="modal modal-fixed-footer" style="height:250px; width:500px; margin-top:150px">
    <h5><font color="red"><center><b>Warning!</b></center></font></h5>
    <div class="divider" style="height:2px"></div>
    <div class="modal-content">
      <div class="row">
        <div class="col s3">
          <i class="mdi-alert-warning" style="font-size:50px; color:red"></i>
        </div>
        <div class="col s9">
          <p><font size="+1">Are you sure you want to reset your order?</font></p>
        </div>
      </div>
    </div>
    <div class="modal-footer col s12" style="background-color:red; opacity:0.85">
      <button type="submit" class="waves-effect waves-green btn-flat" href="{{URL::to('/online-alterationtransaction-newcustomer')}}"><font color="black">Yes</font></button>
      <a href="" class="modal-action modal-close waves-effect waves-green btn-flat"><font color="black">No</font></a>
    </div>
  </div> 

    <!--PROCEED TO CHECKOUT-->
    <div id="summary-of-order" class="modal modal-fixed-footer" style="height:500px; width:800px; margin-top:30px">
      <h5><font color="teal"><center><b>Summary of Orders</b></center></font></h5>
        
          {!! Form::open() !!}
          <div class="divider" style="height:2px"></div>
          <div class="modal-content col s12">
            <label>This is a summary of orders:</label>
            <div class="container">
                          <table class = "table centered order-summary" border = "1">
                    <thead style="color:gray">
                        <tr>      
                            <th data-field="segment">Segment</th>
                            <th data-field="alterationtype">Alteration Type</th>
                            <th data-field="price">Unit Price</th>
                            <!--<th data-field="price">Total Price</th>-->
                          </tr>
                        </thead>
                        <tbody>
                           {{--  @foreach($alterations as $alteration_1) --}}
                        <tr>
                           <td><i id = selectedSegment></i></td>
                            <td><i id = selectedType></i></td>                           {{-- <td> {{ number_format($alteration_1->dblAlterationPrice, 2) }} PHP</td> --}}
                           <!--<td> </td>-->
                        </tr>
                      {{--     @endforeach --}}
                        </tbody>
                </table>
                </div>

                <div class="divider"></div>
                <div class="divider"></div>

                <div class="col s12" style="margin-bottom:50px" >
              <div class="col s6"><p style="color:gray">Estimated time to finish all orders:<p style="color:black" id="total-time"></p></p></div>
              <div class="col s6"><p style="color:gray">Total Amount to Pay:<p style="color:black" id="total-price"></p></p></div>
            </div>
          </div>

          <div class="modal-footer col s12">
            <p class="left" style="margin-left:10px; color:gray;">Continue to payment?</p>
            <a class="waves-effect waves-green btn-flat" href="{{URL::to('/online-check-out')}}"><font color="black">Yes</font></a>
            <a class="modal-action modal-close waves-effect waves-green btn-flat" href=""><font color="black">No</font></a>
          </div>
        {!! Form::close() !!}
    </div>

    <!--CREATE ORDER-->
    <div id="create-order" class="modal modal-fixed-footer" style="width:800px;">
      <div class="modal-content" style="padding:20px;">
        <h5><font color="teal"><center><b>New Order</b></center></font></h5>
        <div class="divider container" style="margin-bottom:20px;"></div>
        
        {!! Form::open() !!}
        <div class="input-field col s12" style="padding:20px;">
          <select>
            <option value="" disabled selected>All</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
          </select>
          <label><font size="3">Choose a garment category:</font></label>
        </div>
         <div class="input-field col s12" style="padding:20px;">
          <select>
            <option value="" disabled selected>All</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
          </select>
          <label><font size="3">Choose a segment:</font></label>
        </div>
         <div class="input-field col s12" style="padding:20px;">
          <select>
            <option value="" disabled selected>All</option>
            <option value="1">Option 1</option>
            <option value="2">Option 2</option>
            <option value="3">Option 3</option>
          </select>
          <label><font size="3">Choose an alteration type:</font></label>
        </div>
        <div class="col s12">
          <h4 style="color:#1b5e20" class="center">Note</h4>
          <div class="divider container" style="margin-bottom:20px;"></div>
          <div class="input-field col s12">
            <textarea id="textarea" class="textarea"></textarea>
            <label for="textarea"></label>
          </div>
        </div>
        {!! Form::close() !!}
      </div>

      <div class="modal-footer col s12 teal">
        <a type="submit" class="waves-effect waves-green btn-flat white-text" href="{{URL::to('/online-alterationtransaction-newcustomer')}}">Save</a>
        <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat left white-text">Cancel</a>
      </div>
    </div>


@stop

 @section('scripts')

    <script>

      $(document).ready(function() {
        $('select').material_select();
      });

    </script>

    <script>

      $(document).ready(function(){
        $('.modal-trigger').leanModal();
      });
          
    </script>
 @stop