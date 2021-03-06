<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Fabric;
use App\FabricType;
use App\FabricColor;
use App\FabricPattern;
use App\FabricThreadCount;

use App\SegmentStyle;
use App\SegmentPattern;
use App\Thread;

class OnlineCustomizeSuitController extends Controller
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
        //
    }

    public function fabric()
    {      
        $fabrics = Fabric::all();
        $fabricThreadCounts = FabricThreadCount::all();
        $fabricColors = FabricColor::all();
        $fabricTypes = FabricType::all();
        $fabricPatterns = FabricPattern::all();

        return view('customize.suit-fabric')
                ->with('fabrics', $fabrics)
                ->with('fabricThreadCounts', $fabricThreadCounts)
                ->with('fabricColors', $fabricColors)
                ->with('fabricTypes', $fabricTypes)
                ->with('fabricPatterns', $fabricPatterns);

    }

    public function stylejacket(Request $request)
    {
       $selectedFabric = \DB::table('tblFabric AS a')
                    ->leftJoin('tblFabricType AS b', 'a.strFabricTypeFK', '=','b.strFabricTypeID')
                    ->select('a.*', 'b.strFabricTypeName')
                    ->where('a.strFabricID', $request->input('rdb_fabric'))
                    ->get();

        $patterns = SegmentPattern::all();
        $threads = Thread::all();

        $garmentKey = 'Suits';
        $segment = \DB::table('tblSegment')
                    ->join('tblGarmentCategory', 'tblSegment.strSegCategoryFK', '=', 'tblGarmentCategory.strGarmentCategoryID')
                    ->select('tblSegment.*', 'tblGarmentCategory.strGarmentCategoryName')
                    ->where('tblGarmentCategory.strGarmentCategoryName', 'LIKE', '%'.$garmentKey.'%')
                    ->orderBy('strSegmentID')
                    ->get();

        $keysingle = 'Single Breasted';
        $singleSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keysingle.'%')
                    ->get();

        $keydouble = 'Double Breasted';
        $doubleSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keydouble.'%')
                    ->get();

        $keyjacket = 'Bottom';
        $jacketSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keyjacket.'%')
                    ->get();

        $keyvents = 'Vents';
        $ventsSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keyvents.'%')
                    ->get();

        $keycollar = 'Collar';
        $keychest = 'Chest Pocket';
        $keyjacket = 'Pocket';

        $collarSegment =\DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keycollar.'%')
                    ->get();

        $chestSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keychest.'%')
                    ->get();

        $jackpotSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keyjacket.'%')
                    ->get();

        return view('customize.suit-style-jacket')
            ->with('fabrics', $selectedFabric)
            ->with('segments', $segment)
            ->with('patterns', $patterns)
            ->with('ventsSegment', $ventsSegment)
            ->with('singleSegment', $singleSegment)
            ->with('doubleSegment', $doubleSegment)
            ->with('jacketSegment', $jacketSegment)
            ->with('threads', $threads)
            ->with('collarSegment', $collarSegment)
            ->with('chestSegment', $chestSegment)
            ->with('jackpotSegment', $jackpotSegment);

    }

   /* public function stylecollarpocket()
    {
        $patterns = SegmentPattern::all();


        return view('customize.suit-style-collar-pocket')
                ->with('patterns', $patterns)
                ->with('threads', $threads)
                ->with('collarSegment', $collarSegment)
                ->with('chestSegment', $chestSegment)
                ->with('jackpotSegment', $jackpotSegment);

    }*/

    public function stylepants()
    {
        $patterns = SegmentPattern::all();

        $key = 'Pleat';
        $pleatsSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$key.'%')
                    ->get();

        $garmentKey = 'Pants';
        $segment = \DB::table('tblSegment')
                    ->join('tblGarmentCategory', 'tblSegment.strSegCategoryFK', '=', 'tblGarmentCategory.strGarmentCategoryID')
                    ->select('tblSegment.*', 'tblGarmentCategory.strGarmentCategoryName')
                    ->where('tblGarmentCategory.strGarmentCategoryName', 'LIKE', '%'.$garmentKey.'%')
                    ->orderBy('strSegmentID')
                    ->get();

        $keypocket = 'Pocket';
        $pocketSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keypocket.'%')
                    ->get();

        $keyback = 'Backpocket';
        $backSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keyback.'%')
                    ->get();

        $keybottom = 'Bottom';
        $bottomSegment = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName', 'strSegmentFK', 'boolIsActive')
                    ->where('strSegStyleName', 'LIKE', '%'.$keybottom.'%')
                    ->get();

        return view('customize.suit-style-pants')
                    ->with('patterns', $patterns)
                    ->with('segments', $segment)
                    ->with('pleatsSegment', $pleatsSegment)
                    ->with('pocketSegment', $pocketSegment)
                    ->with('backSegment', $backSegment)
                    ->with('bottomSegment', $bottomSegment);

    }

    public function stylemonogram()
    {
        $patterns = SegmentPattern::all();

        $keymonogram = 'Monogram';
        $monograms = \DB::table('tblSegmentStyleCategory')
                    ->select('strSegStyleCatID', 'strSegStyleName')
                    ->where('strSegStyleName', 'LIKE', '%'.$keymonogram.'%')
                    ->get();

        return view('customize.suit-style-monogram')
                    ->with('patterns', $patterns)
                    ->with('monograms', $monograms);
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
