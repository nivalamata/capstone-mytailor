<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use PDF;

use App\Company;
use App\TransactionJobOrder;
use App\TransactionJobOrderPayment;
use App\TransactionPaymentReceipt;

use App\Employee;

class PaymentCompanyController extends Controller
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

    
    public function index(Request $request)
    {
        $search_custname = $request->input('cust_name');
        session(['search_name' => $search_custname]);


        return view('transaction-billingpayment-company-home')
            ->with('search_name', $search_custname);
    }

    public function companyInfo(Request $request)
    {

        $search_custname = $request->input('cust_name');
        session(['name' => $search_custname]);

        $customer_info = \DB::table('tblCustCompany AS a')
                ->leftJoin('tblJobOrder AS b', 'a.strCompanyID', '=', 'b.strJO_CustomerCompanyFK')
                ->leftJoin('tblJOPayment AS c', 'b.strJobOrderID', '=', 'c.strTransactionFK')
                ->select('a.strCompanyID', 'a.strCompanyName', 'b.*', 'c.*')
                ->where('a.strCompanyName', '=', $search_custname)
                ->first();

        $customer_orders = \DB::table('tblCustCompany AS a')
                ->leftJoin('tblJobOrder AS b', 'a.strCompanyID', '=', 'b.strJO_CustomerCompanyFK')
                 ->leftJoin('tblJOSpecific AS c', 'b.strJobOrderID', '=', 'c.strJobOrderFK')
                ->leftJoin('tblSegment AS d', 'c.strJOSegmentFK', '=', 'd.strSegmentID')
                ->leftJoin('tblGarmentCategory as e', 'd.strSegCategoryFK', '=', 'e.strGarmentCategoryID')
                ->select('a.strCompanyID', 'a.strCompanyName','b.*', 'c.*', 'd.*', 'e.*')
                ->where('a.strCompanyName', '=', $search_custname)
                ->orderBy('b.strJobOrderID')
                ->get();

        $payments = \DB::table('tblJobOrder AS a')
                ->leftJoin('tblJOPayment AS b', 'a.strJobOrderID', '=', 'b.strTransactionFK')
                ->leftJoin('tblCustCompany AS c', 'c.strCompanyID', '=', 'a.strJO_CustomerCompanyFK')
                ->leftJoin('tblJOSpecific AS d', 'a.strJobOrderID', '=', 'd.strJobOrderFK')
                ->leftJoin('tblSegment AS e', 'd.strJOSegmentFK', '=', 'e.strSegmentID')
                ->leftJoin('tblPackages AS f', 'f.strPackageSeg1FK', '=', 'e.strSegmentID')
                ->leftJoin('tblGarmentCategory as g', 'e.strSegCategoryFK', '=', 'g.strGarmentCategoryID')
                ->leftJoin('tblFabric AS h', 'd.strJOFabricFK', '=', 'h.strFabricID')
                ->leftJoin('tblJOSpecificSegmentPattern AS i', 'd.strJOSpecificID', '=', 'i.strJobOrderSpecificFK')
                ->leftJoin('tblSegmentPattern AS j', 'i.strSegmentPatternFK', '=', 'j.strSegPatternID')
                ->leftJoin('tblSegmentStyleCategory AS k', 'j.strSegPStyleCategoryFK', '=', 'k.strSegStyleCatID')
                ->select('a.*', 'b.*', 'c.strCompanyID', 'd.*', 'e.*', 'f.*', 'g.*', 'h.*', 'i.*', 'j.*', 'k.*')
                ->orderBy('a.strJobOrderID')
                ->get();


        //dd($payments);
        $empEmail = \Auth::user()->email; //dd($empEmail);

        $emp = \DB::table('tblEmployee')
                ->select('tblEmployee.strEmployeeID')
                ->where('tblEmployee.strEmailAdd', 'LIKE', $empEmail)
                ->get(); //dd($emp);
        $empId;
        for($i = 0; $i < count($emp); $i++){
            $empId = $emp[$i]->strEmployeeID;
        } //dd($empId);

        $empname = \DB::table('tblEmployee')
                    ->select('strEmployeeID', \DB::raw('CONCAT(strEmpFName, " ", strEmpMName, " ", strEmpLName) AS employeename'))
                    ->where('strEmployeeID', '=', $empId)//Temporary, since naka-hardcode pa yung pagset ng employee sa naunang process.
                    ->first(); 

        session(['employee' => $empname]);


        return view('transaction-billingpayment-company')
                ->with('search_custname', $search_custname)
                ->with('customer_info', $customer_info)
                ->with('customer_orders', $customer_orders)
                ->with('payments', $payments)
                ->with('empname', $empname);
    }

    public function savePayment(Request $request)
    {
        $name = session()->get('name');

        //session(['termsOfPayment' => $request->input('termsOfPayment')]);
        //session(['totalPrice' => $request->input('total_price')]);
        session(['amountToPay' => $request->input('amt-to-pay')]);
        session(['outstandingBal' => $request->input('outstanding-bal')]);
        session(['amountTendered' => $request->input('amount-tendered')]);
        session(['amountChange' => $request->input('amount-change')]);
        session(['transaction_date' => $request->input('transaction_date')]);
        session(['dueDate' => $request->input('due_date')]);

        //dd(session()->get('amountToPay'));
        $custId = \DB::table('tblCustCompany AS a')
                ->leftJoin('tblJobOrder AS b', 'a.strCompanyID', '=', 'b.strJO_CustomerCompanyFK')
                ->leftJoin('tblJOPayment AS c', 'b.strJobOrderID', '=', 'c.strTransactionFK')
                ->select('a.strCompanyID', 'a.strCompanyName', 'b.*', 'c.*')
                ->where('a.strCompanyName', '=', $name)
                ->get();

            

        for($i = 0; $i < count($custId); $i++){
            $customerID = $custId[$i]->strIndivID;
        }

        for($i = 0; $i < count($custId); $i++){
            
                $joID = $custId[$i]->strJobOrderID;
        
        }

        session(['cust_id' => $customerID]);
        session(['jo_ID' => $joID]);

        $modeOfPayment = "Cash";
        $amtTendered = (double)session()->get('amountTendered');
        $amtChange = (double)session()->get('amountChange');
        $orderDate = session()->get('transaction_date'); //tblJobOrder

        $ids = \DB::table('tblJOPayment')
                ->select('strPaymentID')
                ->orderBy('created_at', 'asc')
                ->orderBy('strPaymentID', 'asc')
                ->take(1)
                ->get();

            if($ids == null){
                $jobPaymentID = $this->smartCounter("JOPY000"); 
            }else{
                $ID = $ids["0"]->strPaymentID;
                $jobPaymentID = $this->smartCounter($ID);  

            }
        session(['payment_id' => $jobPaymentID]);

        $payment = TransactionJobOrderPayment::create(array(
                'strPaymentID' => $jobPaymentID,
                'strTransactionFK' => session()->get('jo_ID'),//tblJobOrder
                'dblAmountToPay' => session()->get('amountToPay'), 
                'dblOutstandingBal' => 0.00,
                'dblAmountTendered' => $amtTendered,
                'dblAmountChange' => $amtChange,
                'strReceivedByEmployeeNameFK' => 'EMPL001' ,
                'dtPaymentDate' => 2013-08-21,
                'dtPaymentDueDate' => 2013-08-22,
                'strPaymentStatus' => 'Paid',
                'boolIsActive' => 1

        ));
        $payment->save();


        return view('billingpayment-submit-company');
    }

    public function printReceipt(Request $request)
    {
        $request->session()->flash('success-message', 'Payment successfully processed!');  
        $this->clearValues();

        return redirect('transaction/payment/company/home');
    }

    public function generateReceipt()
    {

        $custId = session()->get('cust_id'); //dd($custId);
        $custname = session()->get('name');

        $customer_orders = \DB::table('tblCustCompany AS a')
                ->leftJoin('tblJobOrder AS b', 'a.strCompanyID', '=', 'b.strJO_CustomerCompanyFK')
                ->select('a.strCompanyID', 'a.strCompanyName','b.*')
                ->where('a.strCompanyName', '=', $custname)
                ->orderBy('b.strJobOrderID')
                ->get();

        $payments = \DB::table('tblJobOrder AS a')
                ->leftJoin('tblJOPayment AS b', 'a.strJobOrderID', '=', 'b.strTransactionFK')
                ->leftJoin('tblCustCompany AS c', 'c.strCompanyID', '=', 'a.strJO_CustomerCompanyFK')
                ->leftJoin('tblJOSpecific AS d', 'a.strJobOrderID', '=', 'd.strJobOrderFK')
                ->leftJoin('tblSegment AS e', 'd.strJOSegmentFK', '=', 'e.strSegmentID')
                ->leftJoin('tblPackages AS f', 'f.strPackageSeg1FK', '=', 'e.strSegmentID')
                ->select('a.*', 'b.*', 'c.strCompanyID', 'd.*', 'e.*', 'f.*')
                ->orderBy('a.strJobOrderID')
                ->get();


        $empname = \DB::table('tblEmployee')
                    ->select('strEmployeeID', \DB::raw('CONCAT(strEmpFName, " ", strEmpMName, " ", strEmpLName) AS employeename'))
                    ->where('strEmployeeID', '=', 'EMPL001')//Temporary, since naka-hardcode pa yung pagset ng employee sa naunang process.
                    ->first();

        $paymentid = session()->get('payment_id');
        $order_receipt = session()->get('jorReceiptId');
        $payment_receipt = session()->get('pyrReceiptId');
        $amtTendered = (double)session()->get('amountTendered');
        $amtChange = (double)session()->get('amountChange');

        $pdf = PDF::loadView('pdf/billpayment-individual-receipt', 
                    compact('paymentid', 'order_receipt', 'payment_receipt', 'custId',
                        'amtTendered', 'amtChange','empname', 'custname', 'customer_orders', 'payments'))
        ->setPaper('Letter')->setOrientation('portrait');

        return $pdf->stream();

    }

    public function clearValues()
    {
        session()->forget('jo_ID');
        session()->forget('cust_id');
        session()->forget('amountToPay');
        session()->forget('outstandingBal');
        session()->forget('transaction_date');
        session()->forget('dueDate');
        session()->forget('jorReceiptId');
        session()->forget('pyrReceiptId');
        session()->forget('payment_id');        

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
}
