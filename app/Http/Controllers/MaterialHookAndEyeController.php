<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\HookAndEye;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MaterialHookAndEyeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ids = \DB::table('tblHookEye')
            ->select('intHookID')
            ->orderBy('created_at', 'desc')
            ->orderBy('intHookID', 'desc')
            ->take(1)
            ->get();

        $ID = $ids["0"]->intHookID;
        $newHookID = $this->smartCounter($ID); 

        $hook = HookAndEye::all();

        return view('maintenance-material-hookandeye')
                    ->with('hooks', $hook)
                    ->with('newHookID', $newHookID);;
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
       
       $file = $request->input('addImage');
        $destinationPath = 'imgMaterialHooks';

                if($file == '' || $file == null){
                $hook = HookAndEye::create(array(
                    'intHookID' => $request->input('addHookEyeID'),
                    'strHookBrand' => trim($request->input('addHookEyeBrand')),
                    'strHookSize' => trim($request->input('addHookEyeSize')),
                    'strHookColor' => trim($request->input('addHookEyeColor')),
                    'textHookDesc' => trim($request->input('addHookEyeDesc')),
                    'boolIsActive' => 1
                    ));
                }else{
                    $request->file('addImg')->move($destinationPath);

                    $hook = HookAndEye::create(array(
                    'intHookID' => $request->input('addHookEyeID'),
                    'strHookBrand' => trim($request->input('addHookEyeBrand')),
                    'strHookSize' => trim($request->input('addHookEyeSize')),
                    'strHookColor' => trim($request->input('addHookEyeColor')),
                    'textHookDesc' => trim($request->input('addHookEyeDesc')),
                    'strHookImage' => 'imgMaterialHooks/'.$file,
                    'boolIsActive' => 1
                        ));
                }
                $hook ->save();

                return redirect('maintenance/material-hookandeye');
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

    function delete_hookeye(Request $request)
    {
        $hook = HookAndEye::find($request->input('delHookID'));

        $hook->strHookInactiveReason = trim($request->input('delInactiveHook'));
        $hook->boolIsActive = 0;
        $hook->save();

        return redirect('maintenance/material-hookandeye');
    }

    function update_hookeye(Request $request)
    {
       $hook = HookAndEye::find($request->input('editHookID'));

        $file = $request->input('editHookImage');
        $destinationPath = 'imgMaterialHooks';

                if($file == $hook->strHookImage)
                {
                   $hook ->strHookBrand = trim($request->input('editHookBrand'));
                    $hook ->strHookSize = trim($request->input('editHookSize'));
                    $hook ->strHookColor = trim($request->input('editHookColor'));
                    $hook ->textHookDesc = trim($request->input('editHookDesc'));
                    
                }else{
                    $request->file('editImg')->move($destinationPath);
                    $hook ->strHookBrand = trim($request->input('editHookBrand'));
                    $hook ->strHookSize = trim($request->input('editHookSize'));
                    $hook ->strHookColor = trim($request->input('editHookColor'));
                    $hook ->textHookDesc = trim($request->input('editHookDesc'));
                   $hook ->strHookImage = 'imgMaterialHooks/'.$file;
                   
                }
                $hook ->save();

                return redirect('maintenance/material-hookandeye');

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