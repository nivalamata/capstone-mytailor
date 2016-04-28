<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Swatch;
use App\FabricType;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SwatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         //get all the fabric types

       /* $roles =  EmployeeRole::with('employees')
            ->select('strEmpRoleID', 'strEmpRoleName', 'boolIsActive')
            ->get();  
        */
        $fabricType = FabricType::all();

        $reason = Swatch::all(); /*dummy lang wala pang model un reasons e*/


        $newID = 0;
        

        $swatch = Swatch::all();

        //load the view and pass the employees
        return view('fabricAndMaterialsSwatches')
                    ->with('fabricType', $fabricType)
                    ->with('swatch', $swatch)
                    ->with('reason', $reason)
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
}
