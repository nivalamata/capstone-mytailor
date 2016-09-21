<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Package;

use App\Fabric;
use App\FabricType;
use App\FabricColor;
use App\FabricPattern;
use App\FabricThreadCount;

use App\Segment;
use App\SegmentPattern;
use App\SegmentStyle;

use App\Company;
use App\CompanyEmployee;

use App\MeasurementCategory;
use App\MeasurementDetail;

use App\TransactionJobOrder;
use App\TransactionJobOrderPayment;
use App\TransactionJobOrderSpecifics;
use App\TransactionJobOrderSpecificsPattern;
use App\TransactionJobOrderMeasurementProfile;
use App\TransactionJobOrderMeasurementSpecifics;
use App\TransactionJobOrderReceipt;
use App\TransactionPaymentReceipt;

class WalkInCompanyController extends Controller
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
        $data = [];
        $values = [];
        $quantity = [];

        session(['package_data' => $data]);
        session(['package_values' => $values]);
        session(['package_quantity' => (int)$quantity]);
        session(['package_segment_pattern' => $data]);
        session(['employee_fname' => $data]);
        session(['employee_lname' => $data]);
        session(['employee_mname' => $data]);
        session(['employee_set' => $data]);
        session(['employee_sex' => $data]);

        $packages = Package::all();

        return view('transaction-walkin-company')
        ->with('packages', $packages)
        ->with('values', $values)
        ->with('quantity', $quantity);
    }

    public function showPackages()
    {       

        if(session()->get('package_data') != null ){
            $values = session()->get('package_data');
            $quantity = session()->get('package_quantity');
            //$quantity = session()->get('segment_quantity');
        }else{
            $data = [];
            $values = [];
            $quantity = [];

            session(['package_data' => $data]);
            session(['package_values' => $values]);
            session(['package_quantity' => (int)$quantity]);
        }

        $packages = Package::all();

        return view('transaction-walkin-company')
        ->with('packages', $packages)
        ->with('values', $values)
        ->with('quantity', $quantity);
    }

    public function showOrder()
    {   
        $values = \DB::table('tblPackages')
        ->select('strPackageID', 'strPackageName', 'strPackageSex', 'strPackageSeg1FK', 
            'strPackageSeg2FK', 'strPackageSeg3FK', 'dblPackagePrice', 'strPackageImage', 
            'intPackageMinDays', 'strPackageDesc', 'boolIsActive')
        ->whereIn('strPackageID', session()->get('package_data'))
        ->get();
        $j = 0;
        for($i = 0; $i < count($values); $i++){
            $segment1 = \DB::table('tblPackages AS a')
            ->leftJoin('tblSegment AS b', 'a.strPackageSeg1FK', '=', 'b.strSegmentID')
            ->leftJoin('tblGarmentCategory AS c', 'b.strSegCategoryFK', '=', 'c.strGarmentCategoryID')
            ->select('a.strPackageID', 'b.*', 'c.strGarmentCategoryName')
            ->where('a.strPackageID', $values[$i]->strPackageID)
            ->first();

            $segment2 = \DB::table('tblPackages AS a')
            ->leftJoin('tblSegment AS b', 'a.strPackageSeg2FK', '=', 'b.strSegmentID')
            ->leftJoin('tblGarmentCategory AS c', 'b.strSegCategoryFK', '=', 'c.strGarmentCategoryID')
            ->select('a.strPackageID', 'b.*', 'c.strGarmentCategoryName')
            ->where('a.strPackageID', $values[$i]->strPackageID)
            ->first();

            $segment3 = \DB::table('tblPackages AS a')
            ->leftJoin('tblSegment AS b', 'a.strPackageSeg3FK', '=', 'b.strSegmentID')
            ->leftJoin('tblGarmentCategory AS c', 'b.strSegCategoryFK', '=', 'c.strGarmentCategoryID')
            ->select('a.strPackageID', 'b.*', 'c.strGarmentCategoryName')
            ->where('a.strPackageID', $values[$i]->strPackageID)
            ->first();    
            
            $segments[$i] = [$segment1, $segment2, $segment3];
        }

        //$segments = [$segment1, $segment2, $segment3];

        session(['package_segments' => $segments]);
        session(['package_values' => $values]);
        return view('walkin-company-customize-order')
        ->with('values', $values);
    }//page before customization

    public function listOfOrders(Request $request)
    {   
        $data_segment = $request->input('cbx-package-name');
        $data_quantity = $request->input('int-package-qty');

        session(['package_data' => $data_segment]);
        session(['package_quantity' => $data_quantity]);

        $order = session()->get('package_data');
        $quantity = session()->get('package_quantity');
        $orderPackages = [];
        $k = 0;

        for($i = 0; $i < count($quantity); $i++){
            for($j = 0; $j < $quantity[$i]; $j++){
                $orderPackages[$k] = $order[$i];
                $k++;
            }
        }

        session(['package_ordered' => $orderPackages]);

        return redirect('transaction/walkin-company-show-order');
    }

    public function showCustomizeOrder()
    {   
        $to_be_customized = session()->get('package_customize');

        $segment1 = \DB::table('tblPackages AS a')
        ->leftJoin('tblSegment AS b', 'a.strPackageSeg1FK', '=', 'b.strSegmentID')
        ->leftJoin('tblGarmentCategory AS c', 'b.strSegCategoryFK', '=', 'c.strGarmentCategoryID')
        ->select('b.*', 'c.strGarmentCategoryName')
        ->where('a.strPackageID', $to_be_customized)
        ->get();

        $segment2 = \DB::table('tblPackages AS a')
        ->leftJoin('tblSegment AS b', 'a.strPackageSeg2FK', '=', 'b.strSegmentID')
        ->leftJoin('tblGarmentCategory AS c', 'b.strSegCategoryFK', '=', 'c.strGarmentCategoryID')
        ->select('b.*', 'c.strGarmentCategoryName')
        ->where('a.strPackageID', $to_be_customized)
        ->get();

        $segment3 = \DB::table('tblPackages AS a')
        ->leftJoin('tblSegment AS b', 'a.strPackageSeg3FK', '=', 'b.strSegmentID')
        ->leftJoin('tblGarmentCategory AS c', 'b.strSegCategoryFK', '=', 'c.strGarmentCategoryID')
        ->select('b.*', 'c.strGarmentCategoryName')
        ->where('a.strPackageID', $to_be_customized)
        ->get();

        $segments = [$segment1[0], $segment2[0], $segment3[0]];

        session(['package_segments_customize' => $segments]);

        $fabrics = Fabric::all();
        $fabricThreadCounts = FabricThreadCount::all();
        $fabricColors = FabricColor::all();
        $fabricTypes = FabricType::all();
        $fabricPatterns = FabricPattern::all();

        $segmentPatterns = SegmentPattern::all();
        $segmentStyles = SegmentStyle::all();

        $package = \DB::table('tblPackages')
        ->select('*')
        ->where('strPackageID', $to_be_customized)
        ->get();
        //dd(session()->get('package_customize_index'));
        return view('walkin-company-customize-order-package')
        ->with('customized_index', session()->get('package_customize_index'))
        ->with('segments', $segments)
        ->with('package', $package)
        ->with('fabrics', $fabrics)
        ->with('fabricThreadCounts', $fabricThreadCounts)
        ->with('fabricColors', $fabricColors)
        ->with('fabricTypes', $fabricTypes)
        ->with('fabricPatterns', $fabricPatterns)
        ->with('patterns', $segmentPatterns)
        ->with('styles', $segmentStyles);
    }//mismong customize na.

    public function customize(Request $request)
    {   
        $to_be_customized = $request->input('hidden-package-id');
        $customized_index = $request->input('hidden-package-index');
        session(['package_customize' => $to_be_customized]);
        session(['package_customize_index' => $customized_index]);
        //dd($customized_index);
        return redirect('transaction/walkin-company-show-customize');
    }

    public function saveDesign(Request $request)
    {   
        $values = session()->get('package_segments_customize');
        $to_be_customized = session()->get('package_customize');
        $segmentStyles = SegmentStyle::all();
        $segmentFabrics = Fabric::all();
        $k = 0;

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
            ->first();
        }
        for($i = 0; $i < count($values); $i++)
        {   
            $tempFabrics[$i] = $request->input('fabrics' . ($i+1));
        }

        $sqlFabric = \DB::table('tblFabric')
            ->select('strFabricID', 'strFabricName', 'dblFabricPrice')
            ->whereIn('strFabricID', $tempFabrics)
            ->get();
            
        $fabrics;

        for($i = 0; $i < count($values); $i++){
            for($j = 0; $j < count($sqlFabric); $j++){
                if($tempFabrics[$i] == $sqlFabric[$j]->strFabricID){
                    $fabrics[$i] = $sqlFabric[$j];
                }
            }
        }  

/*        $tempPattern[(int)$request->input('hidden-package-index')] = $sqlStyles;
            $tempFabric[(int)$request->input('hidden-package-index')] = $fabrics;*/
            $tempPattern = session()->get('package_segment_pattern');
            $tempPattern[(int)$request->input('hidden-package-index')] = $sqlStyles;
            $tempFabric = session()->get('package_segment_fabric');
            $tempFabric[(int)$request->input('hidden-package-index')] = $fabrics;
            session(['package_segment_pattern' => $tempPattern]);
            session(['package_segment_fabric' => $tempFabric]);
            
        return redirect('transaction/walkin-company-show-order');
    }


    public function addEmployees()
    {   
        $order = session()->get('package_data');
        $segments = session()->get('package_segments');
        $packages = session()->get('package_values');
        $quantity = session()->get('package_quantity');
        $totalQuantity = 0  ;
        $k = 0;

        for($i = 0; $i < count($quantity); $i++)
            $totalQuantity = $totalQuantity + $quantity[$i];

        return view('walkin-company-add-employee')
        ->with('total_quantity', $totalQuantity)
        ->with('orderPackages', session()->get('package_ordered'))
        ->with('packages', $packages)
        ->with('orders', $order)
        ->with('segments', $segments);
    }//specifications ng employee

    public function saveEmployees(Request $request)
    {
        $employeeFirstName = $request->input('empFirstName');
        $employeeLastName = $request->input('empLastName');
        $employeeMiddleName = $request->input('empMiddleName');
        $employeeSex = $request->input('empSex');
        $employeeSet = $request->input('empSet');

        $quantity = session()->get('package_quantity');
        $totalQuantity = 0;

        for($i = 0; $i < count($quantity); $i++)
            $totalQuantity = $totalQuantity + $quantity[$i];

        for($i = 0; $i < $totalQuantity; $i++) $tempQuantity[$i] = array_map('intval', $request->input('segment-qty' . $i));

        $j = 0;
        
        for($i = 0; $i < $totalQuantity; $i++)
        {   
            if($i == 0)
            {
                $employeeSegmentQuantity[$employeeSet[$i]][$j] = $tempQuantity[$i];
                continue;
            }

            if($employeeSet[$i] == $employeeSet[($i-1)])
            {
                $j += 1;  
                $employeeSegmentQuantity[$employeeSet[$i]][$j] = $tempQuantity[$i];  
            }
            else
            {
                $j = 0;
                $employeeSegmentQuantity[$employeeSet[$i]][$j] = $tempQuantity[$i]; 
            }
        }
        $data = session()->get('package_data');
        $l = 0;

        for($i = 0; $i < count($employeeSegmentQuantity); $i++)
        {
            for($j = 0; $j < count($employeeSegmentQuantity[$data[$i]]); $j++)
            {
                for($k = 0; $k < count($employeeSegmentQuantity[$data[$i]][$j]); $k++)
                {
                    if($j == 0)
                    {
                        $employeeSegmentTotal[$i][$k] = $employeeSegmentQuantity[$data[$i]][$j][$k];                    
                    }else{
                        $employeeSegmentTotal[$i][$k] += $employeeSegmentQuantity[$data[$i]][$j][$k];
                    }
                }
            }
        }

        session(['employee_fname' => $employeeFirstName]);
        session(['employee_lname' => $employeeLastName]);
        session(['employee_mname' => $employeeMiddleName]);
        session(['employee_sex'   => $employeeSex]);
        session(['employee_set'   => $employeeSet]);
        session(['employee_segment_qty' => $employeeSegmentQuantity]);
        session(['employee_segment_total' => $employeeSegmentTotal]);

        return redirect('transaction/walkin-company-show-order');
    }//save employee specs

    public function retailProduct()
    {
        return view('walkin-company-retail-product');
    }

    public function catalogueDesign()
    {
        return view('walkin-company-catalogue-design');
    }

    //if a customer already has an existing profile with the shop
    public function customerCheck()
    {
        $company = Company::all();

        $quantity = session()->get('package_quantity');
        $packages = session()->get('package_values');
        $prices = [];
        
        for($i = 0; $i < count($packages); $i++) $prices[$i] = $packages[$i]->dblPackagePrice * $quantity[$i]; 

            return view('walkin-company-customer-check')
        ->with('company', $company)
        ->with('quantity', $quantity)
        ->with('packages', $packages)
        ->with('prices', $prices);;
    }

    public function companyInformation()
    {
        $quantity = session()->get('package_quantity');
        $packages = session()->get('package_values');
        $prices = [];

        for($i = 0; $i < count($packages); $i++) $prices[$i] = $packages[$i]->dblPackagePrice * $quantity[$i]; 

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
        $ids = \DB::table('tblCustCompany')
            ->select('strCompanyID')
            ->orderBy('created_at', 'desc')
            ->orderBy('strCompanyID', 'desc')
            ->take(1)
            ->get();

        if($ids == null){
            $custID = $this->smartCounter("CUSTC000"); 
        }else{
            $ID = $ids["0"]->strCompanyID;
            $custID = $this->smartCounter($ID);  
        }             

        session(['compID' => $custID]);
        session(['compJOID' => $newID]);

        return view('walkin-company-checkout-info')
        ->with('quantity', $quantity)
        ->with('packages', $packages)
        ->with('prices', $prices)
        ->with('custID', $custID)
        ->with('joID', $newID);
    }

    public function existingCompanyInformation(Request $request)
    {
        $custID = $request->input('custID');

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

        session(['compID' => $custID]);
        session(['compJOID' => $newID]);

        $this->saveCompanyEmployees($custID);

        return view('walkin-company-checkout-measure');
    }

    public function saveNewCompany(Request $request)
    {
        //dd($request->input('compID'));
        $company = Company::create(array(
            'strCompanyID' => $request->input('compID'),
            'strCompanyName' => trim($request->input('company_name')),     
            'strCompanyBuildingNo' => trim($request->input('comp_house_no')),   
            'strCompanyStreet' => trim($request->input('comp_street')),
            'strCompanyBarangay' => trim($request->input('comp_barangay')), 
            'strCompanyCity' => trim($request->input('comp_city')), 
            'strCompanyProvince' => trim($request->input('comp_province')),
            'strCompanyZipCode' => trim($request->input('strCompanyZipCode')),
            'strContactPerson' => trim($request->input('contact_person')),
            'strCompanyEmailAddress' => trim($request->input('comp_email')),         
            'strCompanyCPNumber' => trim($request->input('comp_cell')), 
            'strCompanyCPNumberAlt' => trim($request->input('comp_cell_alt')), 
            'strCompanyTelNumber' => trim($request->input('comp_tel')),
            'strCompanyFaxNumber' => trim($request->input('comp_fax')),
            'boolIsActive' => 1
            ));

    $company->save();

    $this->saveCompanyEmployees($request->input('compID'));
    return view('walkin-company-checkout-measure');
    }

    public function saveCompanyEmployees($companyID)
    {   
        $compEmployeeID = [];
        for($i = 0; $i < count(session()->get('employee_set')); $i++)
        {
            $compEmpID = \DB::table('tblCustCompEmployee')
                ->select('strCustCompEmployeeID')
                ->orderBy('created_at', 'desc')
                ->orderBy('strCustCompEmployeeID', 'desc')
                ->take(1)
                ->get();

            if($compEmpID == null){
                $newID = $this->smartCounter("CUSTCE000"); 
            }else{
                $ID = $compEmpID["0"]->strCustCompEmployeeID;
                $newID = $this->smartCounter($ID);  
            }

            $companyEmployees = CompanyEmployee::create(array(
                'strCustCompEmployeeID' => $newID,
                'strCustCompanyFK' => $companyID,
                'strCustCompEmpFirstName' => session()->get('employee_fname')[$i],
                'strCustCompEmpLastName' => session()->get('employee_lname')[$i],
                'strCustCompEmpMiddleName' => session()->get('employee_mname')[$i],
                'strCustCompEmpSex' => session()->get('employee_sex')[$i],
                'boolIsActive' => 1
                ));

            $companyEmployees->save();
            $compEmployeeID[$i] = $newID;
        }

        session(["employee_id" => $compEmployeeID]);
    }

    public function payment()
    {   
        $quantity = session()->get('package_quantity');
        $totalQuantity = 0;

        for($i = 0; $i < count($quantity); $i++)
            $totalQuantity = $totalQuantity + $quantity[$i];
            //dd(session()->get('package_segment_pattern'));
        $tempStyleTotal = 0;
        $tempFabricTotal = 0;
        $tempSegmentTotal = 0;
        
        for($i = 0; $i < count(session()->get('package_values')); $i++)
        {
            for($j = 0; $j < count(session()->get('package_segments')); $j++)
            {
                for($k = 0; $k < count(session()->get('package_segments')[$j]); $k++)
                {
                    if(session()->get('package_values')[$i]->strPackageID == session()->get('package_segments')[$j][$k]->strPackageID)
                    {
                        for($l = 0; $l < count(session()->get('package_segment_pattern')[$j][$k]); $l++)
                        {
                            $tempStyleTotal += session()->get('package_segment_pattern')[$j][$k]->dblPatternPrice * session()->get('employee_segment_total')[$i][$k];
                        }   
                        $tempFabricTotal += session()->get('package_segment_fabric')[$j][$k]->dblFabricPrice * session()->get('employee_segment_total')[$i][$k];
                        $tempSegmentTotal += session()->get('package_segments')[$j][$k]->dblSegmentPrice * session()->get('employee_segment_total')[$i][$k];

                        $styleTotal[$j] = $tempStyleTotal;
                        $fabricTotal[$j] = $tempFabricTotal;
                        $segmentTotal[$j] = $tempSegmentTotal;
                    }
                }
                $tempStyleTotal = 0;
                $tempFabricTotal = 0;
                $tempSegmentTotal = 0;
            }
        }

            //dd("");
            //dd(session()->get('employee_segment_total'));
        return view('walkin-company-checkout-pay')
        ->with('joID', session()->get('compJOID'))
        ->with('package_values', session()->get('package_values'))
        ->with('package_segments', session()->get('package_segments'))
        ->with('segment_patterns', session()->get('package_segment_pattern'))
        ->with('segment_fabrics', session()->get('package_segment_fabric'))
        ->with('segment_qty', session()->get('employee_segment_total'))
        ->with('style_total', $styleTotal)
        ->with('fabric_total', $fabricTotal)
        ->with('segment_total', $segmentTotal)
        ->with('total_quantity', $totalQuantity);

    }

    /*For adding measurement profile*/
    public function measureProfile()
    {
        $quantity = session()->get('package_quantity');
        $totalQuantity = 0;

        for($i = 0; $i < count($quantity); $i++)
            $totalQuantity = $totalQuantity + $quantity[$i];

        $measurementCategory = MeasurementCategory::all()->take(2);
        $measurementDetail = \DB::table('tblMeasurementDetail')
            ->select('*')
            ->where('strMeasCategoryFK', 'MEASCAT002')
            ->get();

        return view('walkin-company-add-measurement')
            ->with('total_quantity', $totalQuantity)
            ->with('package_ordered', session()->get('package_ordered'))
            ->with('package_segments', session()->get('package_segments'))
            ->with('package_values', session()->get('package_values'))
            ->with('employee_fname', session()->get('employee_fname'))
            ->with('employee_lname', session()->get('employee_lname'))
            ->with('employee_mname', session()->get('employee_mname'))
            ->with('measurement_category', $measurementCategory)
            ->with('measurement_detail', $measurementDetail);
    }

    public function saveMeasurements(Request $request)
    {
        $quantity = session()->get('package_quantity');
        $totalQuantity = 0;

        for($i = 0; $i < count($quantity); $i++)
            $totalQuantity = $totalQuantity + $quantity[$i];

        $measurementDetail = \DB::table('tblMeasurementDetail')
        ->select('*')
        ->where('strMeasCategoryFK', 'MEASCAT002')
        ->get();

        //dd($totalQuantity);
        for($i = 0; $i < $totalQuantity; $i++)
        {   
            $measurement_value[] = $request->input($i);
            $measurement_id[] = $request->input('measID' . $i);    
        }
        
        session(['measurement_value' => $measurement_value]);
        session(['measurement_id'    => $measurement_id]);

        return redirect('transaction/walkin-company-payment-measure-detail');
    }

    public function measurement()
    {
        return view('walkin-company-checkout-measure');
    }

    public function saveOrder(Request $request)
    {  
        $jobOrderID = session()->get('compJOID'); //tblJobOrder
        $companyID = session()->get('compID'); //tblJobOrder
        $termsOfPayment = $request->input('termsOfPayment'); //tblJobOrder
        $modeOfPayment = "Cash"; //tblJobOrder
        $totalPrice = (double)$request->get('hidden_total_price'); //tblJobOrder   
        $amountTendered = (double)$request->get('amount-tendered');
        $amountChange = (double)$request->get('amount-change');
        $orderDate = $request->get('transaction_date'); //tblJobOrder
        
        if($termsOfPayment == 'Full Payment'){
            $payTerms = 'Paid';
        } elseif ($termsOfPayment == 'Half Payment' || $termsOfPayment == 'Specific Amount') {
            $payTerms = 'Pending';
        }
        
        $jobOrder = TransactionJobOrder::create(array(
                'strJobOrderID' => $jobOrderID,
                'strJO_CustomerCompanyFK' => $companyID,
                'strTermsOfPayment' => $termsOfPayment,
                'strModeOfPayment' => $modeOfPayment,
                'intJO_OrderQuantity' => count(session()->get('package_ordered')),
                'dblOrderTotalPrice' => $totalPrice,
                'boolIsOrderAccepted' => 1,
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

/*        $empEmail = \Auth::user()->email; //dd($empEmail);
        $emp = \DB::table('tblEmployee')
                ->select('tblEmployee.strEmployeeID')
                ->where('tblEmployee.strEmailAdd', 'LIKE', $empEmail)
                ->get(); //dd($emp);

        for($i = 0; $i < count($emp); $i++){
            $empId = $emp[$i]->strEmployeeID;
        } */

        if($termsOfPayment == 'Full Payment'){
            $payTerms = 'Paid';
        } elseif ($termsOfPayment == 'Half Payment' || $termsOfPayment == 'Specific Amount') {
            $payTerms = 'Pending';
        }
  
        $payment = TransactionJobOrderPayment::create(array(
                'strPaymentID' => $jobPaymentID,
                'strTransactionFK' => $jobOrderID, //tblJobOrder
                'dblAmountToPay' => (double)$request->input('hidden-amount-payable'), 
                'dblOutstandingBal' => (double)$request->input('hidden-balance'),
                'dblAmountTendered' => $amountTendered,
                'dblAmountChange' => $amountChange,
                'strReceivedByEmployeeNameFK' => 'EMPL001',
                'dtPaymentDate' => '2016-07-23',
                'dtPaymentDueDate' => '2016-07-23',
                'strPaymentStatus' => $payTerms,
                'boolIsActive' => 1

        ));
        session(['payment_id' => $jobPaymentID]);

        $payment->save();

        //tblJobSpecs
        $segments = session()->get('package_segments'); //tblJobSpecs
        $fabrics = session()->get('package_segment_fabric'); //tblJOSpecs_Design
        $patterns = session()->get('package_segment_pattern');
        $quantity = session()->get('employee_segment_total');

        for($i = 0; $i < count(session()->get('employee_set')); $i++)
        {
            if(session()->get('employee_mname')[$i] != "")
            {
                $measurementProfile[$i] = session()->get('employee_fname')[$i] . " " . session()->get('employee_mname')[$i] . " " . session()->get('employee_lname')[$i];    
            }else{
                $measurementProfile[$i] = session()->get('employee_fname')[$i] . " " . session()->get('employee_lname')[$i];
            }
        }

        $measurementProfileID = session()->get('employee_id');
        $measurementProfileSex = session()->get('employee_sex');
        $measurementValue = session()->get('measurement_value');
        $measurementID = session()->get('measurement_id');
        
        $m = 0;

        for($i = 0; $i < count(session()->get('package_ordered')); $i++){
            if(session()->get('package_data')[$m] != session()->get('package_ordered')[$i]) $m++;
            for($j = 0; $j < count($segments[$m]); $j++){
                
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
                        'strJOSegmentFK' => $segments[$m][$j]->strSegmentID,
                        'strJOFabricFK' => $fabrics[$m][$j]->strFabricID,
                        'intQuantity' => $quantity[$m][$j],
                        'dblUnitPrice' => $segments[$m][$j]->dblSegmentPrice,
                        'intEstimatedDaysToFinish' => $segments[$m][$j]->intMinDays,
                        'strEmployeeNameFK' => 'EMPL001',
                        'boolIsActive' => 1
                    ));
                $jobOrderSpecifics->save();

                for($k = 0; $k < count($patterns[$m]); $k++){ //dd($designs);
                    $jobOrderSpecificsPattern = TransactionJobOrderSpecificsPattern::create(array(
                        'strJobOrderSpecificFK' => $jobSpecsID,
                        'strSegmentPatternFK' => $patterns[$m][$k]->strSegPatternID
                        ));  //dd($jobOrderSpecificsPattern);

                    $jobOrderSpecificsPattern->save();
                }

                for($k = 0; $k < count($measurementProfile); $k++){
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
                            'strMeasProfCustCompanyFK' => $measurementProfileID[$k],
                            'strProfileName' => $measurementProfile[$k],
                            'strSex' => $measurementProfileSex[$k],
                            'boolIsActive' => 1
                        ));

                    $joMeasurementProfile->save();

                    for($l = 0; $l < count($measurementValue[$k]); $l++){ 
                             //measurement specs 
                        $ids = \DB::table('tblJOMeasureSpecific')
                            ->select('strJOMeasureSpecificID')
                            ->orderBy('created_at', 'desc')
                            ->orderBy('strJOMeasureSpecificID', 'desc')
                            ->take(1)
                            ->get();

                        if($ids == null){
                            $joMeasSpecificID = $this->smartCounter("JOMS000"); 
                        }else{
                            $ID = $ids["0"]->strJOMeasureSpecificID;
                            $joMeasSpecificID = $this->smartCounter($ID);  
                        }
                                 //dd($tempQuantity[$i]);
                        $joMeasurementSpecific = TransactionJobOrderMeasurementSpecifics::create(array(
                            'strJOMeasureSpecificID' => $joMeasSpecificID,
                            'strJobOrderSpecificFK' => $jobSpecsID,
                            'strMeasureProfileFK' => $joMeasProfileID,
                            'strMeasureDetailFK' => $measurementID[$k][$l],
                            'dblMeasureValue' => $measurementValue[$k][$l],
                            'boolIsActive' => 1
                        ));

                        //dd($joMeasurementProfile);

                        $joMeasurementSpecific->save();
                    }//end of loop for meas specs
                }//end of loop for measurement profile
            }//end of save loop for JO Specs
        }//end of loop for package quantity
        dd("The end. Bow.");
//        $paymentid = session()->get('payment_id');
/*
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
*/
/*
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
        $jobOrder = TransactionJobOrder::create(array(
                'strJobOrderID' => ,


                ));*/
        //dd(session()->get('package_segments'));

    }//end of job order

    /*For downloadable forms*/
    public function downloadForms()
    {
        return view('walkin-company-downloadable-forms');
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
        //
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
