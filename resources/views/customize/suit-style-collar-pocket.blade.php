@extends('layouts.masterOnline')

@section('content')

<div class="row" style="margin:40px;">

    <div class="row" style="margin-top:40px;">
      <div class="col s12">
        <div class="col s4">
          <div class="divider teal accent-4 white-text" style="margin-bottom:5px;"></div>
          <div class="divider teal accent-4 white-text"></div>
        </div>

        <div class="col s4" style="margin-top:-30px;">
          <center><span style="font-size:42px; color: #757575;">SUIT CUSTOMIZATION</span></center>
        </div>

        <div class="col s4">
          <div class="divider teal accent-4 white-text" style="margin-bottom:5px;"></div>
          <div class="divider teal accent-4 white-text"></div>
        </div>
      </div>
    </div>

    <div class="container" style="width:100%;">
      <div class="row" style="margin:40px;">
        <ul class="col s12 breadcrumb">
          <li><a style="padding-left:100px; padding-top:20px; padding-bottom:20px; padding-right:20px;"><b>Select Fabric</b></a></li>
          <li><a class="active"  style="padding-left:140px; padding-top:20px; padding-bottom:20px; padding-right:20px;"><b>Step 2: Choose Style</b></a></li>
          <li><a style="padding-left:140px; padding-top:20px; padding-bottom:20px; padding-right:20px;"><b>Measurement</b></a></li>
          <li><a style="padding-left:140px; padding-top:20px; padding-bottom:20px; padding-right:20px;"><b>Check Out</b></a></li>
        </ul>

        <ul class="tabs transparent" style="float:left; margin-top:40px;">
          <li style="background:#00b0ff; border-top-left-radius: 20px; border-top-right-radius: 40px;" class="tab black-text">Jacket Style</li>
          <li style="background:#00b0ff; border-top-left-radius: 20px; border-top-right-radius: 40px;" class="tab active"><a style="color:black" href="#tabCollarPocket">Jacket Collar & Pockets</a></li>
          <li style="background:#00b0ff; border-top-left-radius: 20px; border-top-right-radius: 40px;" class="tab black-text">Pants Style</li>
          <li style="background:#00b0ff; border-top-left-radius: 20px; border-top-right-radius: 40px;" class="tab black-text">Monogram</li>
          <div class="indicator light-blue" style="z-index:1"></div>
        </ul>

        <!--COLLAR POCKET TAB-->
        <div id="tabCollarPocket" class="col s12 white" style="padding:20px; border: 2px teal accent-4;">

      {!! Form::open(['url' => 'customize-suit-style-pants', 'method' => 'post']) !!}
          <div class="col s12">
            <div><button class="right btn-flat teal accent-4 white-text" type="submit">Continue</button></div>
            <div><a class="left btn-flat teal accent-4 white-text" href="{{URL::to('/customize-suit-style-jacket')}}">Previous step</a></div>
          </div>
          <div class="col s12 divider" style="height:4px; margin-top:10px;"></div>

          <div class="col s12">
            <ul class="collapsible" data-collapsible="accordion" style="border:none;">
              <li>
                <div class="collapsible-header" style="background-color:#00838f; color:white; height:30px; padding-top:10px; padding-bottom:50px; font-size:18px">Jacket Collar</div>
                <div class="collapsible-body row overflow-x" style="padding:20px;">
                  @foreach($collarSegment as $collar)
                  <div class="col s12">
                    @foreach($patterns as $pattern)
                    <div class="col s2" @if($pattern->strSegPStyleCategoryFK != $collar->strSegStyleCatID) hidden @endif>
                      <img class="materialboxed responsive-img" src="{{URL::asset($pattern->strSegPImage)}}">
                      <p>
                        <input name="rdb_pattern{{ $collar->strSegStyleCatID }}" type="radio" class="filled-in" value = "{{ $pattern->strSegPatternID }}" id="{{ $pattern->strSegPatternID }}" />
                        <label for="{{ $pattern->strSegPatternID }}"><font size="+1"><b>{{$pattern->strSegPName}}</b></font></label>
                      </p>
                    </div>
                    @endforeach
                  </div>
                  @endforeach
                </div>
              </li>

              <li>
                <div class="collapsible-header" style="background-color:#00838f; color:white; height:30px; padding-top:10px; padding-bottom:50px; font-size:18px">Chest Pocket</div>
                <div class="collapsible-body row overflow-x" style="padding:20px;">
                  @foreach($chestSegment as $chest)
                  <div class="col s12">
                    @foreach($patterns as $pattern)
                    <div class="col s2" @if($pattern->strSegPStyleCategoryFK != $chest->strSegStyleCatID) hidden @endif>
                      <img class="materialboxed responsive-img" src="{{URL::asset($pattern->strSegPImage)}}">
                      <p>
                        <input name="rdb_pattern{{ $chest->strSegStyleCatID }}" type="radio" class="filled-in" value = "{{ $pattern->strSegPatternID }}" id="{{ $pattern->strSegPatternID }}" />
                        <label for="{{ $pattern->strSegPatternID }}"><font size="+1"><b>{{$pattern->strSegPName}}</b></font></label>
                      </p>
                    </div>
                    @endforeach
                  </div>
                  @endforeach
                </div>
              </li>

              <li>
                <div class="collapsible-header" style="background-color:#00838f; color:white; height:30px; padding-top:10px; padding-bottom:50px; font-size:18px">Jacket Pockets</div>
                <div class="collapsible-body row overflow-x" style="padding:20px;">
                  @foreach($jackpotSegment as $jackpot)
                  <div class="col s12">
                    @foreach($patterns as $pattern)
                    <div class="col s2" @if($pattern->strSegPStyleCategoryFK != $jackpot->strSegStyleCatID) hidden @endif>
                      <img class="materialboxed responsive-img" src="{{URL::asset($pattern->strSegPImage)}}">
                      <p>
                        <input name="rdb_pattern{{ $jackpot->strSegStyleCatID }}" type="radio" class="filled-in" value = "{{ $pattern->strSegPatternID }}" id="{{ $pattern->strSegPatternID }}" />
                        <label for="{{ $pattern->strSegPatternID }}"><font size="+1"><b>{{$pattern->strSegPName}}</b></font></label>
                      </p>
                    </div>
                    @endforeach
                  </div>
                  @endforeach
                </div>
              </li>
            </ul>
          </div>

          <div class="col s12" style="margin-top:20px;">
            
            <div class="col s3">

              <h5><b>Functional Buttonhole on Sleeves</b></h5>
              <img class="materialboxed responsive-img" src="imgDesignPatterns/buttonholesonsleeve.jpg">
              <div class="col s6">
                <p>
                  <input class="with-gap" name="yes" type="radio" id="yes" />
                  <label for="small"><font size="+1"><b>yes</b></font></label>
                </p>
              </div>
              <div class="col s6">
                <p>
                  <input class="with-gap" name="no" type="radio" id="no" />
                  <label for="small"><font size="+1"><b>No</b></font></label>
                </p>
              </div>

            </div>

            <div class="col s3">

              <h5><b>Functional Buttonniere</b></h5><br>
              <img class="materialboxed responsive-img" src="imgDesignPatterns/buttonniere.jpg">
              <div class="col s6">
                <p>
                  <input class="with-gap" name="yes" type="radio" id="yes" />
                  <label for="small"><font size="+1"><b>yes</b></font></label>
                </p>
              </div>
              <div class="col s6">
                <p>
                  <input class="with-gap" name="no" type="radio" id="no" />
                  <label for="small"><font size="+1"><b>No</b></font></label>
                </p>
              </div>

            </div>

            <div class="col s3" style="padding-top:50px;">
              <h5><b>Thread Color</b></h5>
              <p>Would you like coloured button threads?</p>
              <div class="input-field" style="margin-top:20px;">
                <select class="browser-default">
                  <option value="" disabled selected>Choose your option</option>
                  @foreach($threads as $thread)
                  <option value="{{$thread->intThreadID}}">{{$thread->strThreadColor}}</option>
                  @endforeach
                </select>
              </div>
              <h5><b>Buttonhole Color</b></h5>
              <p>Would you like buttonhole color? (cuffs only)</p>
              <div class="input-field" style="margin-top:20px;">
                <select class="browser-default">
                  <option value="" disabled selected>Choose your option</option>
                  @foreach($threads as $thread)
                  <option value="{{$thread->intThreadID}}">{{$thread->strThreadColor}}</option>
                  @endforeach
                </select>
              </div>                              
            </div>         

          </div>

          <div class="col s12">

            <div class="col s3">

              <h5><b>Need Pants</b></h5>
              <div class="col s6">
                <p>
                  <input class="with-gap" name="yes" type="radio" id="yes" />
                  <label for="small"><font size="+1"><b>yes</b></font></label>
                </p>
              </div>
              <div class="col s6">
                <p>
                  <input class="with-gap" name="no" type="radio" id="no" />
                  <label for="small"><font size="+1"><b>No</b></font></label>
                </p>
              </div>
            </div>
          </div>          

          <div class="col s12 divider" style="height:4px; margin-bottom:10px;"></div>
          <div class="col s12">
            <div><button class="right btn-flat teal accent-4 white-text" typ="submit">Continue</button></div>
            <div><a class="left btn-flat teal accent-4 white-text" href="{{URL::to('/customize-suit-style-jacket')}}">Previous step</a></div>
          </div>

        </div>
      {!! Form::close() !!}
        <!--END OF COLLAR POCKET TAB-->


      </div>
    </div>
</div>
@stop

@section('scripts')

  <script>
    
    $(document).ready(function(){
      $('.modal-trigger').leanModal();
    });

    $(document).ready(function(){
      $('ul.tabs').tabs('select_tab', 'tab_id');
    });

    $(document).ready(function() {
      $('select').material_select();
    });

    $(document).ready(function() {
      Materialize.updateTextFields();
    });

  </script>
