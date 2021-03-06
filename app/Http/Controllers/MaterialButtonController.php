<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Button;

use App\Http\Requests;
use App\Http\Requests\MaintenanceButtonRequest;
use App\Http\Controllers\Controller;

class MaterialButtonController extends Controller
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
        $ids = \DB::table('tblButton')
            ->select('intButtonID')
            ->orderBy('created_at', 'desc')
            ->orderBy('intButtonID', 'desc')
            ->take(1)
            ->get();

        $ID = $ids["0"]->intButtonID;
        $newButtonID = $this->smartCounter($ID);  

        $button = Button::all();

        return view('maintenance.maintenance-material-button')
                    ->with('buttons', $button)
                    ->with('newButtonID', $newButtonID);
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
    public function store(MaintenanceButtonRequest $request)
    {
        $file = $request->input('addImage');
        $destinationPath = 'imgMaterialButtons';

                if($file == '' || $file == null){
                $button = Button::create(array(
                    'intButtonID' => $request->input('intButtonID'),
                    'strButtonBrand' => trim($request->input('strButtonBrand')),
                    'strButtonSize' => trim($request->input('strButtonSize')),
                    'strButtonColor' => trim($request->input('strButtonColor')),
                    'strButtonDesc' => trim($request->input('strButtonDesc')),
                    'boolIsActive' => 1
                    ));
                }else{
                    $request->file('addImg')->move($destinationPath);

                    $button = Button::create(array(
                    'intButtonID' => $request->input('intButtonID'),
                    'strButtonBrand' => trim($request->input('strButtonBrand')),
                    'strButtonSize' => trim($request->input('strButtonSize')),
                     'strButtonColor' => trim($request->input('strButtonColor')),
                    'strButtonDesc' => trim($request->input('strButtonDesc')),
                    'strButtonImage' => 'imgMaterialButtons/'.$file,
                    'boolIsActive' => 1
                        ));
                }
                $button ->save();

                \Session::flash('flash_message','Button successfully added.'); //flash message

                return redirect('maintenance/material-button');
        
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

    function delete_button(Request $request)
    {
        $button = Button::find($request->input('delButtonID'));

        $button->strButtonInactiveReason = trim($request->input('delInactiveButton'));
        $button->boolIsActive = 0;
        $button->save();

        \Session::flash('flash_message_delete','Button successfully deactivated.'); //flash message

        return redirect('maintenance/material-button');
    }


    function update_button(Request $request)
    {
        $button = Button::find($request->input('editButtonID'));
        $checkButtons = Button::all();

        $file = $request->input('editButtonImage');
        $destinationPath = 'imgMaterialButtons';
        $isAdded = FALSE;

        foreach ($checkButtons as $checkButton)
            if(!strcasecmp($checkButton->intButtonID, $request->input('editButtonID')) == 0 &&
                strcasecmp($checkButton->strButtonBrand, trim($request->input('editButtonBrand'))) == 0 &&
                strcasecmp($checkButton->strButtonSize, trim($request->input('editButtonSize'))) == 0  &&
                strcasecmp($checkButton->strButtonColor, trim($request->input('editButtonColor'))) == 0)
                $isAdded = TRUE;

        if(!$isAdded){

                if($file == $button->strButtonImage)
                {
                   $button ->strButtonBrand = trim($request->input('editButtonBrand'));
                    $button ->strButtonSize = trim($request->input('editButtonSize'));
                    $button ->strButtonColor = trim($request->input('editButtonColor'));
                    $button ->strButtonDesc = trim($request->input('editButtonDesc'));
                    
                }else{
                    $request->file('editImg')->move($destinationPath, $file);
                    $button ->strButtonBrand = trim($request->input('editButtonBrand'));
                    $button ->strButtonSize = trim($request->input('editButtonSize'));
                    $button ->strButtonColor = trim($request->input('editButtonColor'));
                    $button ->strButtonDesc = trim($request->input('editButtonDesc'));
                   $button ->strButtonImage = 'imgMaterialButtons/'.$file;
                   
                }
                $button ->save();

                \Session::flash('flash_message_update','Button successfully updated.'); //flash message

         }else \Session::flash('flash_message_duplicate','Button already exists.'); //flash message  

                return redirect('maintenance/material-button');

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
