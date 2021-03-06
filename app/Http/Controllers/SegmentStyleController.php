<?php

namespace App\Http\Controllers;

use App\GarmentSegment;
use App\SegmentStyle;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\MaintenanceSegmentStyleRequest;
use App\Http\Controllers\Controller;

class SegmentStyleController extends Controller
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
         //get all the segmentStyle style

        $ids = \DB::table('tblSegmentStyleCategory')
            ->select('strSegStyleCatID')
            ->orderBy('created_at', 'desc')
            ->orderBy('strSegStyleCatID', 'desc')
            ->take(1)
            ->get();

        $ID = $ids["0"]->strSegStyleCatID;
        $newID = $this->smartCounter($ID);  

        $segment = GarmentSegment::all();


        $segmentStyle = \DB::table('tblSegmentStyleCategory')
                ->join('tblSegment', 'tblSegmentStyleCategory.strSegmentFK', '=', 'tblSegment.strSegmentID')
                ->select('tblSegmentStyleCategory.*','tblSegment.strSegmentName') 
                ->orderBy('strSegStyleCatID')
                ->get();
        
        //load the view and pass the style
        return view('maintenance.maintenance-segment-style')
                    ->with('segmentStyle', $segmentStyle)
                    ->with('segment', $segment)
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
    public function store(MaintenanceSegmentStyleRequest $request)
    {
        $styles = SegmentStyle::get();
            $segmentStyle = SegmentStyle::create(array(
                'strSegStyleCatID' => $request->input('strSegStyleCatID'),
                'strSegmentFK' => $request->input('strSegmentFK'),
                'strSegStyleName' => trim($request->input('strSegStyleName')),
                'txtSegStyleCatDesc' => trim($request->input('txtSegStyleCatDesc')),
                'boolIsActive' => 1
                ));

         $added=$segmentStyle->save();
          

        \Session::flash('flash_message','Segment style  category successfully added.'); //flash message

        return redirect('maintenance/segment-style');
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



    function updatesegmentStyle(Request $request)
    {
        $checkSegmentStyles = SegmentStyle::all();
        $isAdded=FALSE;

        foreach($checkSegmentStyles as $checkSegmentStyle)
            if(!strcasecmp($checkSegmentStyle->strSegStyleCatID, $request->input('editSegmentStyleID')) == 0 && strcasecmp($checkSegmentStyle->strSegmentFK,$request->input('editSegmentStyle')) == 0 &&
                strcasecmp($checkSegmentStyle->strSegStyleName, trim($request->input('editSegmentStyleName'))) == 0)
                $isAdded = TRUE;

        if(!$isAdded){   
        $segmentStyle  = SegmentStyle::find($request->input('editSegmentStyleID'));

            $segmentStyle ->strSegmentFK = $request->input('editSegmentStyle');
            $segmentStyle ->strSegStyleName = trim($request->input('editSegmentStyleName'));
            $segmentStyle ->txtSegStyleCatDesc = trim($request->input('editStyleDesc'));

            $segmentStyle  ->save();

        \Session::flash('flash_message_update','Segment style category detail/s successfully updated.'); //flash message
        }else \Session::flash('flash_message_duplicate','Segment style category already exists.'); //flash message

        return  redirect('maintenance/segment-style');
    }

    function deletesegmentStyle(Request $request)
    {

        $id = $request->input('delsegmentStyleID');
        $segmentStyle = SegmentStyle::find($request->input('delsegmentStyleID'));

        $count = \DB::table('tblSegmentPattern')
                ->join('tblSegmentStyleCategory', 'tblSegmentPattern.strSegPStyleCategoryFK', '=', 'tblSegmentStyleCategory.strSegStyleCatID')
                ->select('tblSegmentStyleCategory.*')
                ->where('tblSegmentStyleCategory.strSegStyleCatID','=', $id)
                ->count();

        if ($count != 0) {
                    return redirect('maintenance/segment-style?success=beingUsed');

        }else {
            $segmentStyle->strSegStyleCatInactiveReason = trim($request->input('delInactiveSegmentStyle'));
            $segmentStyle->boolIsActive = 0;
            $segmentStyle->save();

       \Session::flash('flash_message_delete','Segment style successfully deactivated.'); //flash message

        return redirect('maintenance/segment-style');

        }

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
