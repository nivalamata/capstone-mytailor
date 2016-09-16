<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use PDF;

use App\GarmentCategory;

use App\Fabric;
use App\FabricType;
use App\FabricColor;
use App\FabricPattern;
use App\FabricThreadCount;

use App\Individual;

use App\Segment;
use App\SegmentPattern;
use App\SegmentStyle;

use App\MeasurementCategory;
use App\MeasurementDetail;
use App\StandardSizeCategory;

use App\TransactionJobOrder;
use App\TransactionJobOrderPayment;
use App\TransactionJobOrderSpecifics;
use App\TransactionJobOrderSpecificsPattern;
use App\TransactionJobOrderMeasurementProfile;
use App\TransactionJobOrderMeasurementSpecifics;
use App\TransactionJobOrderReceipt;
use App\TransactionPaymentReceipt;

class WalkInIndividualController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {   
        $values = [];
        //$quantity = [];
        $data = [];

        session(['segment_data' => $data]);
        session(['segment_values' => $values]);
        //session(['segment_quantity' => $quantity]);

        $categories = GarmentCategory::all();
        $garments = \DB::table('tblSegment AS a')
                    ->leftJoin('tblGarmentCategory AS b', 'a.strSegCategoryFK', '=', 'b.strGarmentCategoryID')
                    ->select('a.*', 'b.strGarmentCategoryName') 
                    ->orderBy('a.strSegmentID')
                    ->get();

        return view('transaction-walkin-individual')
                    ->with('garments', $garments)
                    ->with('categories', $categories)
                    ->with('values', $data);
                    //->with('quantity', $quantity);
    }

    public function showItems()
    {
        if(session()->get('segment_data') != null ){
            $values = session()->get('segment_values');
            $data = session()->get('segment_data');
            //$quantity = session()->get('segment_quantity');
        }else{
            $values = [];
            //$quantity = [];
            $data = [];

            session(['segment_data' => $data]);
            session(['segment_values' => $values]);
           // session(['segment_quantity' => $quantity]);
        }

        $categories = GarmentCategory::all();
        $garments = \DB::table('tblSegment AS a')
                    ->leftJoin('tblGarmentCategory AS b', 'a.strSegCategoryFK', '=', 'b.strGarmentCategoryID')
                    ->select('a.*', 'b.strGarmentCategoryName') 
                    ->orderBy('a.strSegmentID')
                    ->get();

        return view('transaction-walkin-individual')
                    ->with('garments', $garments)
                    ->with('categories', $categories)
                    ->with('values', $data);
                    //->with('quantity', $quantity);
    }

    public function customizeOrder(Request $request)
    {   
        $data_segment = $request->input('cbx-segment-name');
        $values = [];

        if(!$data_segment == null){
            //$data_quantity = array_slice(array_filter($request->input('int-segment-qty')), 0);

            $segments =  \DB::table('tblSegment AS a')
                        ->leftJoin('tblGarmentCategory AS b', 'a.strSegCategoryFK', '=', 'b.strGarmentCategoryID')
                        ->select('a.*', 'b.strGarmentCategoryName') 
                        ->whereIn('a.strSegmentID', $data_segment)
                        ->orderBy('a.strSegmentID')
                        ->get();        

            $segments = json_decode(json_encode($segments), true);

            for($i = 0; $i < count($data_segment); $i++){
                    $values[] = $segments[$i];
                
            }

            session(['segment_data' => $data_segment]);
            //session(['segment_quantity' => $data_quantity]);
        }
        
        session(['segment_values' => $values]);     

        return redirect('transaction/walkin-individual-show-customize-orders');
    }

    public function showCustomizeOrder()
    {   
        $values = session()->get('segment_values');

        $fabrics = Fabric::all();
        $fabricThreadCounts = FabricThreadCount::all();
        $fabricColors = FabricColor::all();
        $fabricTypes = FabricType::all();
        $fabricPatterns = FabricPattern::all();

        $segmentPatterns = SegmentPattern::all();
        $segmentStyles = SegmentStyle::all();

        return view('walkin-individual-customize-order')
                ->with('segments', $values)
                ->with('fabrics', $fabrics)
                ->with('fabricThreadCounts', $fabricThreadCounts)
                ->with('fabricColors', $fabricColors)
                ->with('fabricTypes', $fabricTypes)
                ->with('fabricPatterns', $fabricPatterns)
                ->with('patterns', $segmentPatterns)
                ->with('styles', $segmentStyles); 
    }

    public function addDesign(Request $request)
    {   
        return redirect('transaction/walkin-individual-show-customize-orders');
    }

    public function catalogueDesign()
    {
        return view('walkin-individual-catalogue-design');
    }

    public function customerInformation(Request $request)
    {   
        $values = session()->get('segment_values');
        $segmentStyles = SegmentStyle::all();
        $patterns = [];
        $i = 0;
        $k = 0;

        for($i = 0; $i < count($values); $i++){
            $segmentFabric[$i] = $request->input('fabrics' . ($i+1));
        }

        for($i = 0; $i < count($values); $i++){
            for($j = 0; $j < count($segmentStyles); $j++){
                $tempPatterns = $request->input('rdb_pattern' . $segmentStyles[$j]->strSegStyleCatID . ($i+1));       
                if($tempPatterns != null){
                    $patterns[$i][$k] = $tempPatterns;
                    $k++;
                } 
            }
            $k = 0;
        }
        
        for($i = 0; $i < count($values); $i++){
            $sqlStyles[$i] = \DB::table('tblSegmentPattern AS a')
                    ->leftJoin('tblSegmentStyleCategory AS b', 'a.strSegPStyleCategoryFK', '=', 'b.strSegStyleCatID')
                    ->leftJoin('tblSegment AS c', 'b.strSegmentFK', '=', 'strSegmentID')
                    ->select('c.strSegmentID', 'a.strSegPStyleCategoryFK', 'a.strSegPatternID', 
                             'a.strSegPName', 'b.strSegStyleName', 'a.dblPatternPrice')
                    ->whereIn('a.strSegPatternID', $patterns[$i])
                    ->get();
        }

        $sqlFabric = \DB::table('tblFabric')
                ->select('strFabricID', 'strFabricName', 'dblFabricPrice')
                ->whereIn('strFabricID', $segmentFabric)
                ->get();

        $fabrics;

        for($i = 0; $i < count($values); $i++){
            for($j = 0; $j < count($sqlFabric); $j++){
                if($segmentFabric[$i] == $sqlFabric[$j]->strFabricID){
                    $fabrics[$i] = $sqlFabric[$j];
                }
            }
        }  
        session(['segment_fabric' => $fabrics]); 

        for($i = 0; $i < count($values); $i++){
            $values[$i]['strFabricID'] = $fabrics[$i]->strFabricID;
            $values[$i]['strFabricName'] = $fabrics[$i]->strFabricName;
            $values[$i]['dblFabricPrice'] = $fabrics[$i]->dblFabricPrice;
        }

        session()->forget('segment_values');
        session(['segment_values' => $values]);

        session(['segment_design' => $sqlStyles]);

        $joID = \DB::table('tblJobOrder')
            ->select('strJobOrderID')
            ->orderBy('created_at', 'desc')
            ->orderBy('strJobOrderID', 'desc')
            ->take(1)
            ->get();

        if($joID == null){
            $newID = $this->smartCounter("JOB000"); 
        }else{
            $ID = $joID["0"]->strJobOrderID;
            $newID = $this->smartCounter($ID);  
        }

        //get all the individuals
        $ids = \DB::table('tblCustIndividual')
            ->select('strIndivID')
            ->orderBy('created_at', 'desc')
            ->orderBy('strIndivID', 'desc')
            ->take(1)
            ->get();

        if($ids == null){
            $custID = $this->smartCounter("CUSTP000"); 
        }else{
            $ID = $ids["0"]->strIndivID;
            $custID = $this->smartCounter($ID);  
        }             

        session(['custID' => $custID]);
        session(['joID' => $newID]);

        return view('walkin-individual-checkout-info')
                    ->with('custID', $custID)
                    ->with('joID', $newID);
    }

    //if a customer already has an existing profile with the shop
    public function customerCheck(){

        return view('walkin-individual-customer-check');
    }

    public function addCustomer(Request $request)
    {   
        $individual = Individual::create(array(
                    'strIndivID' => $request->input('addIndiID'),
                    'strIndivFName' => trim($request->input('addIndiFirstName')),     
                    'strIndivMName' => trim($request->input('addIndiMiddleName')),
                    'strIndivLName' => trim($request->input('addIndiLastName')),
                    'strIndivHouseNo' => trim($request->input('addCustPrivHouseNo')), 
                    'strIndivStreet' => trim($request->input('addCustPrivStreet')),
                    'strIndivBarangay' => trim($request->input('addCustPrivBarangay')),   
                    'strIndivCity' => trim($request->input('addCustPrivCity')),   
                    'strIndivProvince' => trim($request->input('addCustPrivProvince')),
                    'strIndivZipCode' => trim($request->input('addCustPrivZipCode')),
                    'strIndivLandlineNumber' => trim($request->input('addPhone')),
                    'strIndivCPNumber' => trim($request->input('addCel')), 
                    'strIndivCPNumberAlt' => trim($request->input('addCelAlt')),
                    'strIndivEmailAddress' => trim($request->input('addEmail')),
                    'boolIsActive' => 1
                    ));

                $individual->save();
                
        return redirect('transaction/walkin-individual-show-measurement-view');
    }

    public function showMeasurementView()
    {
        $values = session()->get('segment_values');
        $data = session()->get('segment_data');

        $measurementCategory = MeasurementCategory::all();
        $standardSizeCategory = StandardSizeCategory::all();

        $measurements = \DB::table('tblMeasurementCategory AS a')
                    ->leftJoin('tblMeasurementDetail AS b', 'a.strMeasurementCategoryID', '=', 'b.strMeasCategoryFK')
                    ->leftJoin('tblSegment AS c', 'b.strMeasDetSegmentFK', '=', 'c.strSegmentID')
                    ->select('b.*')
                    ->whereIn('b.strMeasDetSegmentFK', $data)
                    ->get();

        return view('walkin-individual-checkout-measure')
                ->with('segments', $values)
                ->with('measurements', $measurements)
                ->with('categories', $measurementCategory)
                ->with('standard_categories', $standardSizeCategory);
    }

    public function saveMeasurements(Request $request)
    {   
        $measDet = MeasurementDetail::get();
        $segments = session()->get('segment_values'); //tblJobSpecs
        
        $measurementDetails = [];
        $measurementName = [];
        $measurementProfile = [];

        foreach($segments as $i => $segment){
            foreach($measDet as $j => $detail){
                if($detail->strMeasDetSegmentFK == $segment['strSegmentID']){
                    $measurementName[$i][$j] = $request->input('detailName' . ($i+1) . ($j+1));
                    $measurementDetails[$i][$j] = $request->input($detail->strMeasurementDetailID . ($i+1));
                    $measurementDetails[$i][$j+1] = "cm";
                    // $measurementDetails[$i][$j+1] = $request->input('uom' . ($i+1));
                }
                $j++;
            }
                $measurementProfile[$i][0] =  $request->input('profile_name' . ($i+1));
                $measurementProfile[$i][1] =  $request->input('profile_sex' . ($i+1));
                $i++;
        }

        $jobOrderID = session()->get('joID'); //tblJobOrder
        $customerID = session()->get('custID'); //tblJobOrder

        //tblJobSpecs
        $segments = session()->get('segment_values'); //tblJobSpecs
        $designs = session()->get('segment_design'); //tblJOSpecs_Design

        session(['measurement_profile' => $measurementProfile]);
        session(['measurement_detail' => $measurementDetails]);
        session(['measurement_name' => $measurementName]);

        return redirect('transaction/walkin-individual-payment-information');
    }

    public function showPayment()
    {           
        $values = session()->get('segment_values');
        $styles = session()->get('segment_design');
        $fabrics = session()->get('segment_fabric');
        $joID = session()->get('joID');
        $style_count = count(session()->get('segment_values'));

        return view('walkin-individual-checkout-pay')
                    ->with('values', $values)
                    ->with('styles', $styles)
                    ->with('joID', $joID)
                    ->with('style_count', $style_count);
    }

    public function saveOrder(Request $request)
    {
        //tblJobOrder
        $tempQuantity = session()->get('segment_quantity');
        $totalQuantity = 0;

        session(['termsOfPayment' => $request->input('termsOfPayment')]);
        session(['totalPrice' => $request->input('total_price')]);
        session(['amountToPay' => $request->input('amount-payable')]);
        session(['outstandingBal' => $request->input('balance')]);
        session(['amountTendered' => $request->input('amount-tendered')]);
        session(['amountChange' => $request->input('amount-change')]);
        session(['transaction_date' => $request->input('transaction_date')]);
        session(['dueDate' => $request->input('due_date')]);

        foreach($tempQuantity as $quantity)
            $totalQuantity += $quantity; //tblJobOrder

        $jobOrderID = session()->get('joID'); //tblJobOrder
        $customerID = session()->get('custID'); //tblJobOrder
        $termsOfPayment = session()->get('termsOfPayment'); //tblJobOrder
        $modeOfPayment = "Cash"; //tblJobOrder
        $totalPrice = (double)session()->get('totalPrice'); //tblJobOrder
        $amtTendered = (double)session()->get('amountTendered');
        $amtChange = (double)session()->get('amountChange');
        $orderDate = session()->get('transaction_date'); //tblJobOrder

        $jobOrder = TransactionJobOrder::create(array(
                'strJobOrderID' => $jobOrderID,
                'strJO_CustomerFK' => $customerID,
                'strTermsOfPayment' => $termsOfPayment,
                'strModeOfPayment' => $modeOfPayment,
                'intJO_OrderQuantity' => $totalQuantity,
                'dblOrderTotalPrice' => $totalPrice,
                'dtOrderDate' => $orderDate,
                'boolIsActive' => 1
        ));

        $jobOrder->save();

        $ids = \DB::table('tblJOPayment')
                ->select('strPaymentID')
                ->orderBy('created_at', 'desc')
                ->orderBy('strPaymentID', 'desc')
                ->take(1)
                ->get();

            if($ids == null){
                $jobPaymentID = $this->smartCounter("JOPY000"); 
            }else{
                $ID = $ids["0"]->strPaymentID;
                $jobPaymentID = $this->smartCounter($ID);  

            }

        $payment = TransactionJobOrderPayment::create(array(
                'strPaymentID' => $jobPaymentID,
                'strTransactionFK' => session()->get('joID'), //tblJobOrder
                'dblAmountToPay' => $request->input('amount-payable'), 
                'dblOutstandingBal' => $request->input('balance'),
                'dblAmountTendered' => $amtTendered,
                'dblAmountChange' => $amtChange,
                'strReceivedByEmployeeNameFK' => 'EMPL001' ,
                'dtPaymentDate' => $request->input('transaction_date'),
                'dtPaymentDueDate' => session()->get('dueDate'),
                'strPaymentStatus' => 'Pending',
                'boolIsActive' => 1

        ));
        session(['payment_id' => $jobPaymentID]);

        $payment->save();

        //tblJobSpecs
        $segments = session()->get('segment_values'); //tblJobSpecs
        $designs = session()->get('segment_design'); //tblJOSpecs_Design

        $measurementProfile = session()->get('measurement_profile');
        $measurementDetails = session()->get('measurement_detail');
        $measurementName = session()->get('measurement_name');

        for($i = 0; $i < count($segments); $i++){

            $ids = \DB::table('tblJOSpecific')
                ->select('strJOSpecificID')
                ->orderBy('created_at', 'desc')
                ->orderBy('strJOSpecificID', 'desc')
                ->take(1)
                ->get();

            if($ids == null){
                $jobSpecsID = $this->smartCounter("JOS000"); 
            }else{
                $ID = $ids["0"]->strJOSpecificID;
                $jobSpecsID = $this->smartCounter($ID);  
            }

            $jobOrderSpecifics = TransactionJobOrderSpecifics::create(array(
                    'strJOSpecificID' => $jobSpecsID,
                    'strJobOrderFK' => $jobOrderID,
                    'strJOSegmentFK' => $segments[$i]['strSegmentID'],
                    'strJOFabricFK' => $segments[$i]['strFabricID'],
                    'intQuantity' => 1,
                    'dblUnitPrice' => $segments[$i]['dblSegmentPrice'],
                    'intEstimatedDaysToFinish' => $segments[$i]['intMinDays'],
                    'strEmployeeNameFK' => "EMPL001",
                    'boolIsActive' => 1
            ));

            $jobOrderSpecifics->save();

            for($j = 0; $j < count($designs); $j++){
                $jobOrderSpecificsPattern = TransactionJobOrderSpecificsPattern::create(array(
                        'strJobOrderSpecificFK' => $jobSpecsID,
                        'strSegmentPatternFK' => $designs[$i][$j]->strSegPatternID
                ));

                $jobOrderSpecificsPattern->save(); 
            }

            //measurement profile
            $ids = \DB::table('tblJO_MeasureProfile')
                    ->select('strJOMeasureProfileID')
                    ->orderBy('created_at', 'desc')
                    ->orderBy('strJOMeasureProfileID', 'desc')
                    ->take(1)
                    ->get();

                if($ids == null){
                    $joMeasProfileID = $this->smartCounter("JOMP000"); 
                }else{
                    $ID = $ids["0"]->strJOMeasureProfileID;
                    $joMeasProfileID = $this->smartCounter($ID);  
                }

            $joMeasurementProfile = TransactionJobOrderMeasurementProfile::create(array(
                    'strJOMeasureProfileID' => $joMeasProfileID,
                    'strMeasProfCustIndivFK' => $customerID,
                    'strProfileName' => $measurementProfile[$i][0],
                    'strSex' => $measurementProfile[$i][1],
                    'boolIsActive' => 1
            ));

            $joMeasurementProfile->save();

            // for($j = 0; $j < count($measurementName[$i]); $j++){
            //     //measurement specs
            //     $ids = \DB::table('tblJOMeasureSpecific')
            //             ->select('strJOMeasureSpecificID')
            //             ->orderBy('created_at', 'desc')
            //             ->orderBy('strJOMeasureSpecificID', 'desc')
            //             ->take(1)
            //             ->get();

            //         if($ids == null){
            //             $joMeasSpecificID = $this->smartCounter("JOMP000"); 
            //         }else{
            //             $ID = $ids["0"]->strJOMeasureSpecificID;
            //             $joMeasSpecificID = $this->smartCounter($ID);  
            //         }

            //         $joMeasurementProfile = TransactionJobOrderMeasurementSpecifics::create(array(
            //                 'strJOMeasureSpecificID' => $joMeasSpecificID,
            //                 'strJobOrderSpecificFK' => $jobSpecsID,
            //                 'strMeasureProfileFK' => $joMeasProfileID,
            //                 'strMeasureDetailFK' => $measurementName[$i][$j],
            //                 'dblMeasureValue' => $measurementDetails[$i][$j],
            //                 'strUnitOfMeasurement' => $measurementDetails[$i][count($measurementName[$i])],
            //                 'boolIsActive' => 1
            //         ));

            //          dd($joMeasurementProfile);

            //         $joMeasurementProfile->save();
            // }//end of loop for meas specs
        }//end of save loop for JO Specs

        $paymentid = session()->get('payment_id');

        //Job Order Receipt
        $jorId = \DB::table('tblJobOrderReceipt')
                ->select('strOrderReceiptID')
                ->orderBy('created_at', 'desc')
                ->orderBy('strOrderReceiptID', 'desc')
                ->take(1)
                ->get();

            if($jorId == null){
                $joReceiptID = $this->smartCounter("OR000"); 
            }else{
                $ID = $jorId["0"]->strOrderReceiptID;
                $joReceiptID = $this->smartCounter($ID);  
            }

        $jobOrderReceipt = TransactionJobOrderReceipt::create(array(
                'strOrderReceiptID' => $joReceiptID,
                'strJobOrderFK' => session()->get('joID'), //tblJobOrder
                'strIssuedByEmpNameFK' => "EMPL001", 
                'boolIsActive' => 1

        ));

        session(['jorReceiptId' => $joReceiptID]);

        $jobOrderReceipt->save();

        //Payment Receipt
        $prId = \DB::table('tblPaymentReceipt')
                ->select('strPaymentReceiptID')
                ->orderBy('created_at', 'desc')
                ->orderBy('strPaymentReceiptID', 'desc')
                ->take(1)
                ->get();

            if($prId == null){
                $payReceiptID = $this->smartCounter("PYR000"); 
            }else{
                $ID = $prId["0"]->strPaymentReceiptID;
                $payReceiptID = $this->smartCounter($ID);  
            }
        
        $paymentReceipt = TransactionPaymentReceipt::create(array(
                'strPaymentReceiptID' => $payReceiptID,
                'strPaymentFK' => session()->get('payment_id'), //tblJobOrder
                'strIssuedByEmpNameFK' => "EMPL001", 
                'boolIsActive' => 1
        ));

        session(['pyrReceiptId' => $payReceiptID]);

        $paymentReceipt->save();


        return view('for-printing');

    }


    public function submit(Request $request)
    {
        $request->session()->flash('success-message', 'Order successfully sent!');  
        $this->clearValues();

        return redirect('transaction/walkin-individual');
    }


    public function generateReceipt()
    {

        // var_dump(session()->get('segment_data'));
        $values = 'null';
        $patterns = [];
        $i = 0;
        $k = 0;
        $termsOfPayment = 'null';
        $paymentid = 'null';

        $data = [
            'orders' => [
                [
                  'job_order_id' => 'JOB001',
                  'segment_data'  => 'Name 1',
                  'segment_quantity' => 1,
                  'segment_fabric' => 'Cotton',
                  'segment_design' => 'Design 1',
                  'totalPrice' => 52.00,
                  'amountToPay' => 60.00,
                  'outstandingBal' => 70.00,
                ]
            ]
        ];

        $custId = session()->get('custID');
        $custname = \DB::table('tblCustIndividual')
                    ->select('strIndivID', \DB::raw('CONCAT(strIndivFName, " ", strIndivMName, " ", strIndivLName) AS fullname'))
                    ->where('strIndivID', '=', $custId)
                    ->first();

        $empname = \DB::table('tblEmployee')
                    ->select('strEmployeeID', \DB::raw('CONCAT(strEmpFName, " ", strEmpMName, " ", strEmpLName) AS employeename'))
                    ->where('strEmployeeID', '=', 'EMPL001')//Temporary, since naka-hardcode pa yung pagset ng employee sa naunang process.
                    ->first();

        $data_segment = session()->get('segment_data');
        $segments = \DB::table('tblSegment AS a')
                        ->leftJoin('tblGarmentCategory AS b', 'a.strSegCategoryFK', '=', 'b.strGarmentCategoryID')
                        ->select('a.*', 'b.strGarmentCategoryName') 
                        ->whereIn('a.strSegmentID', $data_segment)
                        ->orderBy('a.strSegmentID')
                        ->get();

        $values = session()->get('segment_values');
        $styles = session()->get('segment_design');
        $fabric = session()->get('segment_fabric');
        $style_count = count(session()->get('segment_values'));

        // var_dump($segments, $values);
        // dd("");
        $termsOfPayment = session()->get('termsOfPayment');
        $paymentid = session()->get('payment_id');
        $order_receipt = session()->get('jorReceiptId');
        $payment_receipt = session()->get('pyrReceiptId');
        $amtTendered = (double)session()->get('amountTendered');
        $amtChange = (double)session()->get('amountChange');

        $pdf = PDF::loadView('pdf/payment-receipt', 
                    compact('data', 'custname', 'empname', 'segments',
                        'values', 'styles', 'termsOfPayment', 'paymentid',
                        'order_receipt', 'payment_receipt', 'fabric', 
                        'amtTendered', 'amtChange', 'style_count'))
        ->setPaper('Letter')->setOrientation('portrait');

        return $pdf->stream();
        // $jobId = session()->get('joID');
        // $paymentid = \DB::table('tblJOPayment')
        //             ->select('strPaymentID', 'strTransactionFK')
        //             ->where('strTransactionFK', '=', $jobId)
        //             ->first();
 

        // for($i=0; $i<count($data); $i++){
        //     for($j=0; $j<$i+1; $j++){
        //         array_push($data['orders'[$i+1]], [
        //         'segment_data' => 'Name[$j+1]',
        //         'segment_quantity' => $j+1,
        //         'price' => $j+1
        //     ]);
        //     }
        // }
                
    }

    public function removeItem(Request $request)
    {   
        dd($request->input('delete-item-id'));
        $to_be_deleted = ((int)$request->input('delete-item-id') - 1);
        $values = session()->get('segment_values');

        unset($values[$to_be_deleted]);
        $values = array_slice($values, 0);
        
        session()->forget('segment_values');
        session(['segment_values' => $values]);

        return redirect('transaction/walkin-individual-show-customize-orders');
    }

    public function clearOrder(Request $request)
    {   
        $this->clearValues();

        return redirect('transaction/walkin-individual');
    }

    public function clearValues()
    {
        session()->forget('joID');
        session()->forget('custID');
        session()->forget('segment_values'); 
        session()->forget('segment_design');
        session()->forget('segment_fabric');
        session()->forget('segment_quantity');
        session()->forget('segment_data');
        session()->forget('termsOfPayment');
        session()->forget('totalPrice');
        session()->forget('amountToPay');
        session()->forget('outstandingBal');
        session()->forget('transaction_date');
        session()->forget('dueDate');
        session()->forget('jorReceiptId');
        session()->forget('pyrReceiptId');
        session()->forget('payment_id');

    }




    public function bulkOrder()
    {
        return view('walkin-individual-bulk-order');
    }

    public function bulkOrderCustomize()
    {
        return view('walkin-individual-bulk-order-customize');
    }

    public function bulkOrderCustomizePerPiece()
    {
        return view('walkin-individual-bulk-order-customize-per-piece');
    }

    public function bulkOrderCustomerInfo()
    {
        return view('walkin-individual-bulk-order-checkout-info');
    }

    public function bulkOrderPayment()
    {
        return view('walkin-individual-bulk-order-checkout-pay');
    }

    public function bulkOrderMeasure()
    {
        return view('walkin-individual-bulk-order-checkout-measure');
    }

    public function bulkOrderMeasureNow()
    {
        return view('walkin-individual-bulk-order-checkout-measure-now');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function smartCounter($id)
    {   

        $lastID = str_split($id);

        $ctr = 0;
        $tempID = "";
        $tempNew = [];
        $newID = "";
        $add = TRUE;

        for($ctr = count($lastID)-1; $ctr >= 0; $ctr--){

            $tempID = $lastID[$ctr];

            if($add){
                if(is_numeric($tempID) || $tempID == '0'){
                    if($tempID == '9'){
                        $tempID = '0';
                        $tempNew[$ctr] = $tempID;

                    }else{
                        $tempID = $tempID + 1;
                        $tempNew[$ctr] = $tempID;
                        $add = FALSE;
                    }
                }else{
                    $tempNew[$ctr] = $tempID;
                }           
            }
            $tempNew[$ctr] = $tempID;   
        }

        
        for($ctr = 0; $ctr < count($lastID); $ctr++){
            $newID = $newID . $tempNew[$ctr];
        }

        return $newID;
    }

}

