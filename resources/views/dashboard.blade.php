@extends('layouts.master')

@section('content')
                        <div id="card-stats"  >
                        <div class="row" style="margin-top:30px">
                            <div class="col s12 m6 l3">
                                <div class="card" >
                                    @foreach($totalCustIndiv as $totalCustIndiv)
                                    <div class="card-content  green lighten-2 white-text" style="height:138px">
                                        <p class="card-stats-title" style="font-size:18px"><i class="mdi-social-group-add"></i> Total Registered Individual Customer</p>
                                        <h4 class="card-stats-number">{{$totalCustIndiv->ctr}}</h4>
                                        {{-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 15% <span class="green-text text-lighten-5">from yesterday</span>
                                        </p> --}}
                                    </div>
                                    <div class="card-action  green " style="height:40px">
                                        <div id="clients-bar"><canvas width="220" height="25" style="display: inline-block; width: 220px; height: 25px; vertical-align: top;"></canvas></div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    @foreach($totalCustComp as $totalCustComp)
                                    <div class="card-content cyan darken-1 white-text" style="height:138px">
                                        <p class="card-stats-title" style="font-size:18px"><i class="mdi-editor-attach-money"></i>Total Registered Companies</p>
                                        <h4 class="card-stats-number">{{$totalCustComp->totalCompanies}}</h4>
                                        {{-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 70% <span class="purple-text text-lighten-5">last month</span>
                                        </p> --}}
                                    </div>
                                    @endforeach
                                    <div class="card-action  cyan darken-2"  style="height:40px">
                                        <div id="sales-compositebar"><canvas width="220" height="25" style="display: inline-block; width: 220px; height: 25px; vertical-align: top;"></canvas></div>

                                    </div>
                                </div>
                            </div>                            
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content blue-grey white-text">
                                        <p class="card-stats-title" style="font-size:20px"><i class="mdi-action-trending-up"></i> Today Sales </p>
                                        <h4 class="card-stats-number">Php.806.52</h4>
                                        {{-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-up"></i> 80% <span class="blue-grey-text text-lighten-5">from yesterday</span>
                                        </p> --}}
                                    </div>
                                    <div class="card-action blue-grey darken-2" style="height:40px">
                                        <div id="profit-tristate"><canvas width="220" height="25" style="display: inline-block; width: 220px; height: 25px; vertical-align: top;"></canvas></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col s12 m6 l3">
                                <div class="card">
                                    <div class="card-content deep-purple accent-1 white-text">
                                        <p class="card-stats-title" style="font-size:20px"><i class="mdi-editor-insert-drive-file"></i> New Invoice</p>
                                        <h4 class="card-stats-number">1806</h4>
                                        {{-- <p class="card-stats-compare"><i class="mdi-hardware-keyboard-arrow-down"></i> 3% <span class="deep-purple-text text-lighten-5">from last month</span>
                                        </p> --}}
                                    </div>
                                    <div class="card-action  deep-purple lighten-2" style="height:40px">
                                        <div id="invoice-line"><canvas width="223" height="25" style="display: inline-block; width: 223px; height: 25px; vertical-align: top;"></canvas></div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

    <div id="card-stats" style="padding:20px;">
        <div class="row">
            <div class="col s12 m6 l4" style="margin-top:-12px;">
                <div class="card z-depth-3" style="background-image:url('img/1.jpg');">
                    <div class="card-header blue-grey">
                        <div class="card-title">
                            <h3 class="card-title white-text" style="font-size:40px; padding-left:10px;">My Tailor</h3>
                            <p style="padding-left:10px;" class="flight-card-date white-text"><div id="Date"></div><div id= "clock"></div></p>
                        </div>
                    </div>
                    <div class="white-text">
                        <div class="card-content" style="height:400px;">
                            <div class="right" style="margin-top:-20px;">
                                <a href="{{URL::to('/online-home')}}" style="font-family:cursive; font-size:30px; font-color:teal accent-4;">Go to shop<i class="mdi-maps-local-mall"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="card-reveal">
                        <span class="card-title grey-text text-darken-4">Card Title<i class="material-icons right">close</i></span>
                        <p>Here is some more information about this product that is only revealed once clicked on.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l4">
                <div class="col s12">
                    <ul id="task-card" class="collection with-header z-depth-3" style="border:0;  height:550px">
                        <li class="collection-header green">
                            <h3 class="task-card-title white-text">On Going Orders</h3>
                        </li>
                        @foreach($joborderongoing as $joborderongoing)
                            @if($joborderongoing->strCompanyName == null)
                                <li class="collection-item dismissable" style="padding:20px;">
                                     <a href= "{{URL::to('transaction/orderProgress')}}" class="waves-effect waves-teal btn-flat"> {{$joborderongoing->dtOrderExpectedToBeDone}} {{$joborderongoing->strCompanyName}}{{$joborderongoing->strIndivFName}} {{$joborderongoing->strIndivLName}}</a>
                                </li>
                            @else
                                <li class="collection-item dismissable" style="padding:20px;">
                                     <a href= "{{URL::to('transaction/orderProgress')}}" class="waves-effect waves-teal btn-flat"> {{$joborderongoing->dtOrderExpectedToBeDone}} {{$joborderongoing->strCompanyName}}{{$joborderongoing->strIndivFName}} {{$joborderongoing->strIndivLName}}</a>
                                </li>
                            @endif        
                        @endforeach    
                    </ul>
                </div>
            </div>

            <div class="col s12 m6 l4">
                <div class="col s12">
                    <ul id="task-card" class="collection with-header z-depth-3" style="border:0; height:550px">
                        <li class="collection-header cyan">
                            <h3 class="task-card-title white-text">Pending Orders</h3>
                        </li>
                        @foreach($joborder as $joborder)
                            @if($joborder->strCompanyName == null)
                                <li class="collection-item dismissable" style="padding:20px;">
                                     <a href="{{URL::to('transaction/online-customer-individual')}}" class="waves-effect waves-teal btn-flat"> {{$joborder->dtOrderExpectedToBeDone}} {{$joborder->strCompanyName}}{{$joborder->strIndivFName}} {{$joborder->strIndivLName}}</a>
                                </li>
                            @else
                                <li class="collection-item dismissable" style="padding:20px;">
                                     <a href="{{URL::to('transaction/online-customer-company')}}" class="waves-effect waves-teal btn-flat"> {{$joborder->dtOrderExpectedToBeDone}} {{$joborder->strCompanyName}}{{$joborder->strIndivFName}} {{$joborder->strIndivLName}}</a>
                                </li>
                            @endif        
                        @endforeach    
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col s12 m12 l6">
                <ul id="projects-collection" class="collection z-depth-3" style="height:550px">
                    <li class="collection-item avatar">
                        <i class="mdi-file-folder circle light-blue darken-2"></i>
                        <span class="collection-header"><font size="+1">CUSTOMER NEAR DUE DATE</font></span>
                        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                    </li>
                    @foreach($neardue as $neardue)
                        <li class="collection-item">
                            <div class="row">
                                <div class="col s6">
                                    <a href="{{URL::to('transaction/billing-collection')}}">
                                        <p class="collections-title">{{$neardue->strJobOrderID}}</p>
                                        <p class="collections-content">{{$neardue->strCompanyName}}{{$neardue->strIndivFName}} {{$neardue->strIndivLName}}</p>
                                    </a>
                                </div>
                               <div class="col s6">
                                    <p>{{$neardue->dtOrderExpectedToBeDone}}</p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col s12 m12 l6">
                <ul id="issues-collection" class="collection z-depth-3" style="height:550px">
                    <li class="collection-item avatar">
                        <i class="mdi-action-bug-report circle red darken-2"></i>
                        <span class="collection-header"><font size="+1">JOB ORDERS IN PROGRESS</font></span>
                        <a href="#" class="secondary-content"><i class="mdi-action-grade"></i></a>
                    </li>

                    @foreach($joborderprog as $joborderprog)
                        <li class="collection-item">
                            <div class="row">
                                <div class="col s7">
                                    <p class="collections-title">{{$joborderprog->strJobOrderID}}</p>
                                    <p class="collections-content">Date Order: {{$joborderprog->dtOrderDate}}</p>
                                    <p class="collections-content">Date to be Finished: {{$joborderprog->dtOrderExpectedToBeDone}}</p>
                                </div>
                                <div class="col s2">
                                    <span class="task-cat pink accent-2">P1</span>
                                </div>
                                <div class="col s3">
                                    <div class="progress">
                                         <div class="determinate" style="width: 70%"></div>   
                                    </div>                                                
                                </div>
                            </div>
                        </li>
                    @endforeach    
                    
                </ul>
            </div>
        </div>
    </div>

@stop

@section('scripts')

    <script type="text/javascript">
        var monthNames = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
        var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

        var newDate = new Date();
        newDate.setDate(newDate.getDate());    
        $('#Date').html(dayNames[newDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
    
    </script>

    <script type="text/javascript">
        function updateClock ( )
            {
            var currentTime = new Date ( );
            var currentHours = currentTime.getHours ( );
            var currentMinutes = currentTime.getMinutes ( );
            var currentSeconds = currentTime.getSeconds ( );

            // Pad the minutes and seconds with leading zeros, if required
            currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
            currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

            // Choose either "AM" or "PM" as appropriate
            var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

            // Convert the hours component to 12-hour format if needed
            currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

            // Convert an hours component of "0" to "12"
            currentHours = ( currentHours == 0 ) ? 12 : currentHours;

            // Compose the string for display
            var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
            
            
            $("#clock").html(currentTimeString);
                
         }

        $(document).ready(function()
        {
           setInterval('updateClock()', 1000);
        });
    </script>

@stop    
