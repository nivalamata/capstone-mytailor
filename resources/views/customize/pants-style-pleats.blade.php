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
          <center><span style="font-size:42px; color: #757575;">PANTS CUSTOMIZATION</span></center>
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
          <li style="background:#00b0ff; border-top-left-radius: 20px; border-top-right-radius: 40px;" class="tab active"><a style="color:black" href="#tabPleats">Pleats</a></li>
          <li style="background:#00b0ff; border-top-left-radius: 20px; border-top-right-radius: 40px;" class="tab black-text">Pockets</li>
          <li style="background:#00b0ff; border-top-left-radius: 20px; border-top-right-radius: 40px;" class="tab black-text">Bottom</li>
          <div class="indicator teal accent-4" style="z-index:1"></div>
        </ul>

        <!--PLEATS TAB-->
          {!! Form::open(['url' => 'customize-pants-style-pockets', 'method' => 'POST']) !!}
        <div id="tabPleats" class="col s12 white" style="padding:20px; border: 2px teal accent-4;">
          
          <div class="col s12"><button class="btn-flat right teal accent-4 white-text" type="submit">Next step</button></div>
          <div class="col s12 divider" style="height:4px; margin-top:10px;"></div>
          
          <div class="col s12" style="margin-top:10px;">
            <label class="col s2"><font size="+1"><b>Selected Fabric</b></font></label>
            <label class="col s5"><a class="btn teal accent-4 white-text" href="{{URL::to('/customize-pants-fabric')}}"><font size="+1">Edit / Change Fabric</font></a></label>
          </div>
          
          @foreach($fabrics as $fabric)
          <div class="col s12">
            <div class="col s2">
              <img class="responsive-img" src="{{ URL::asset($fabric->strFabricImage) }}">
            </div>
            <div class="col s5" style="background-color:#eeeeee;">
                <p>Fabric Name: {{ $fabric->strFabricName }}</p>
                <p>Swatch Code: {{ $fabric->strFabricCode }}</p>
                <p>Price:       {{ number_format($fabric->dblFabricPrice, 2) }} PHP</p>
            </div>
          </div>
          @endforeach


          @foreach($segments as $i => $segment)
          @foreach($styles as $j => $style)
          @if($style->boolIsActive == 1)
          <div class="col s12" style="margin-top:20px;">
            <ul class="collapsible" data-collapsible="accordion" style="border:none;" @if($segment->strSegmentID != $style->strSegmentFK) hidden @endif>
              <li>
                <div class="collapsible-header" style="background-color:#00838f; color:white; height:30px; padding-top:10px; padding-bottom:50px; font-size:18px">{{ $style->strSegStyleName }}</div>
                <div class="collapsible-body row overflow-x" style="padding:20px;">  
                  <div class="col s12">
                    @foreach($patterns as $k => $pattern)
                    <div class="col s2" @if($pattern->strSegPStyleCategoryFK != $style->strSegStyleCatID) hidden @endif>
                      <img class="materialboxed responsive-img" src="{{URL::asset($pattern->strSegPImage)}}">
                      <p>
                        <input name="ppleats" value = "{{$pattern->strSegPatternID}}" type="radio" class="filled-in" id="{{$pattern->strSegPatternID}}{{ $i+1 }}{{ $j+1 }}{{ $k+1 }}" />
                        <label for="{{$pattern->strSegPatternID}}{{ $i+1 }}{{ $j+1 }}{{ $k+1 }}">{{$pattern->strSegPName}} {{ number_format($pattern->dblPatternPrice, 2) }} PHP</label>
                      </p>
                    </div>
                    @endforeach
                  </div>                 
                </div>
              </li>
            </ul>
          </div>
          @endif
          @endforeach
          @endforeach

          <div class="col s12 divider" style="height:4px; margin-bottom:10px;"></div>
          <div class="col s12"><button class="right btn-flat teal accent-4 white-text" type="submit">Next step</button></div>

          {!! Form::close() !!}

        </div>
        <!--END OF PLEATS TAB-->


      </div>
    </div>
</div>
@stop

@section('scripts')

  <script>

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
