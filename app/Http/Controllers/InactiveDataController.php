<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Individual;
use App\Company;
use App\EmployeeRole;
use App\Employee;
use App\GarmentCategory;
use App\GarmentSegment;
use App\SegmentPattern;
use App\MeasurementCategory;
use App\MeasurementDetail;
use App\FabricType;
use App\Swatch;
use App\SwatchNameMaintenance;
use App\Thread;
use App\Needle;
use App\Button;
use App\Zipper;
use App\HookAndEye;
use App\Catalogue;
use App\Alteration;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InactiveDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $individual = Individual::all(); //temporary
        $company = Company::all();
        $role = EmployeeRole::all();
        $employee = Employee::all();
        $category = GarmentCategory::all();
        $segment = GarmentSegment::all();
        $pattern = SegmentPattern::all();
        $head = MeasurementCategory::all();
        $detail = MeasurementDetail::all();
        $fabricType = FabricType::all();
        $swatch = Swatch::all();
        $swatchname = SwatchNameMaintenance::all();
        $thread = Thread::all();
        $needle = Needle::all();
        $button = Button::all();
        $zipper = Zipper::all();
        $hook = HookAndEye::all();
        $catalogue = Catalogue::all();
        $alteration = Alteration::all();

        $newID = 0;

//$reason = Individual::all(); 


        return view('inactiveData')
            ->with('individual', $individual)
            ->with('company', $company)
            ->with('role', $role)
            ->with('employee', $employee)
            ->with('category', $category)
            ->with('segment', $segment)
            ->with('pattern', $pattern)
            ->with('head', $head)
            ->with('detail', $detail)
            ->with('fabricType', $fabricType)
            ->with('swatch', $swatch)
            ->with('swatchname', $swatchname)
            ->with('thread', $thread)
            ->with('needle', $needle)
            ->with('button', $button)
            ->with('zipper', $zipper)
            ->with('hook', $hook)
            ->with('catalogue', $catalogue)
            ->with('alteration', $alteration)

            //->with('reason', $reason)
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

    function reactivate_individual(Request $request)
    {
        $individual = Individual::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $individual->strIndivInactiveReason = null;

        $individual->boolIsActive = 1;
        $individual->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_company(Request $request)
    {
        $company = Company::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $company->strCompanyInactiveReason = null;

        $company->boolIsActive = 1;
        $company->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_emprole(Request $request)
    {
        $role = EmployeeRole::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $role->strRoleInactiveReason = null;

        $role->boolIsActive = 1;
        $role->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_employee(Request $request)
    {
        $employee = Employee::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $employee->strEmpInactiveReason = null;

        $employee->boolIsActive = 1;
        $employee->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_catalogue(Request $request)
    {
        $catalogue = Catalogue::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $catalogue->strCatalogueInactiveReason = null;

        $catalogue->boolIsActive = 1;
        $catalogue->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_alteration(Request $request)
    {
        $alteration = Alteration::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $alteration->strAlterationInactiveReason = null;

        $alteration->boolIsActive = 1;
        $alteration->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_category(Request $request)
    {
        $category = GarmentCategory::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $category->strGarmentCategoryInactiveReason = null;

        $category->boolIsActive = 1;
        $category->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_segment(Request $request)
    {
        $segment = GarmentSegment::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $segment->strSegInactiveReason = null;

        $segment->boolIsActive = 1;
        $segment->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_segmentpattern(Request $request)
    {
        $pattern = SegmentPattern::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $pattern->strSegPInactiveReason = null;

        $pattern->boolIsActive = 1;
        $pattern->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_head(Request $request)
    {
        $head = MeasurementCategory::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $head->strMeasCatInactiveReason = null;

        $head->boolIsActive = 1;
        $head->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_detail(Request $request)
    {
        $detail = MeasurementDetail::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $detail->strMeasDetInactiveReason = null;

        $detail->boolIsActive = 1;
        $detail->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_fabrictype(Request $request)
    {
        $fabricType = FabricType::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $fabricType->strFabricTypeInactiveReason = null;

        $fabricType->boolIsActive = 1;
        $fabricType->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_swatch(Request $request)
    {
        $swatch = Swatch::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $swatch->strSwatchInactiveReason = null;

        $swatch->boolIsActive = 1;
        $swatch->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_swatchname(Request $request)
    {
        $swatchname = SwatchNameMaintenance::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $swatchname->strSwatchNameInactiveReason = null;

        $swatchname->boolIsActive = 1;
        $swatchname->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_thread(Request $request)
    {
        $thread = Thread::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $thread->strThreadInactiveReason = null;

        $thread->boolIsActive = 1;
        $thread->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_needle(Request $request)
    {
        $needle = Needle::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $needle->strNeedleInactiveReason = null;

        $needle->boolIsActive = 1;
        $needle->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_button(Request $request)
    {
        $button = Button::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $button->strButtonInactiveReason = null;

        $button->boolIsActive = 1;
        $button->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_zipper(Request $request)
    {
        $zipper = Zipper::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $zipper->strZipperInactiveReason = null;

        $zipper->boolIsActive = 1;
        $zipper->save();

        return redirect('utilities/inactive-data');
    }

    function reactivate_hookeye(Request $request)
    {
        $hook = HookAndEye::find($request->input('reactID'));

      //  $reas = $request->input('reactInactiveID');
       // $indiv = \DB::table('tblCustIndividual')
               // ->where('strIndivID', $individual)
              //  ->update(array($individual->strIndivInactiveReason => null));
        $hook->strHookInactiveReason = null;

        $hook->boolIsActive = 1;
        $hook->save();

        return redirect('utilities/inactive-data');
    }
}