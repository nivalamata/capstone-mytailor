<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\MeasurementCategory;
use App\GarmentCategory;
use App\GarmentSegment;
use App\MeasurementDetail;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MeasurementCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all the category

        $ids = \DB::table('tblMeasurementCategory')
            ->select('strMeasCatID')
            ->orderBy('created_at', 'desc')
            ->orderBy('strMeasCatID', 'desc')
            ->take(1)
            ->get();

        $ID = $ids["0"]->strMeasCatID;
        $newID = $this->smartCounter($ID);

        $category =  GarmentCategory::all();

        $segment = GarmentSegment::all();

        $detailList = MeasurementDetail::all();


        $head = \DB::table('tblMeasurementCategory AS a')
            ->leftJoin('tblGarmentCategory AS b', 'a.strMeasGarFK', '=', 'b.strGarmentCategoryID')
            ->leftJoin('tblSegment AS c', 'a.strMeasSegmentFK', '=', 'c.strSegmentID')
            ->leftJoin('tblMeasurementDetail AS d', 'a.strMeasDetFK', '=', 'd.strMeasurementDetailID')
            ->select('a.*', 'b.strGarmentCategoryName','c.strSegmentName', 'd.strMeasurementDetailName')
            ->orderBy('created_at') 
            ->get();

        //load the view and pass the employees
        return view('maintenance-measurement-category')
                    ->with('head', $head)
                    ->with('category', $category)
                    ->with('segment', $segment)
                    ->with('detailList', $detailList)
                    ->with('newID', $newID);

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
        $meas_category = MeasurementCategory::create(array(
                'strMeasCatID' => $request->input('addMeasurementID'),
                'strMeasGarFK' => $request->input('addCategory'),
                'strMeasSegmentFK' => $request->input('addSegment'),
                'strMeasDetFK' => $request->input('addDetail'),
                'strMeasCatInactiveReason' => null,
                'boolIsActive' => 1
            ));

        $meas_category->save();

        return redirect('maintenance/measurement-category');
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

    function delete_measurementcategory(Request $request)
    {
        $meas_category = MeasurementCategory::find($request->input('delMeasurementID'));

        $meas_category->strMeasCatInactiveReason = trim($request->input('delInactiveHead'));
        $meas_category->boolIsActive = 0;
        $meas_category->save();

        return redirect('maintenance/measurement-category');
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