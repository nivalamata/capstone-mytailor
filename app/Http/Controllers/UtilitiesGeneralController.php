<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\UtilitiesGeneral;


class UtilitiesGeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $shopLogo = \DB::table('tblUtilitiesGeneral')
            ->where('intUtilsGenID','1')
            ->orderBy('created_at', 'desc')
            ->pluck('strShopImage');

        session::put('shop_logo',$shopLogo);

        $shopName = \DB::table('tblUtilitiesGeneral')
            ->where('intUtilsGenID','1')
            ->orderBy('created_at', 'desc')
            ->pluck('strShopName');

        session::put('shop_name',$shopName);

         $shopAddress = \DB::table('tblUtilitiesGeneral')
            ->where('intUtilsGenID','1')
            ->orderBy('created_at', 'desc')
            ->pluck('strShopAddress');

        session::put('shop_address', $shopAddress);


        return view('utilities.utilities-general')
                ->with('shop_logo', $shopLogo)
                ->with('shop_address', $shopAddress)
                ->with('shop_name', $shopName);
    }

    public function updateSettings(Request $request)
    {   
        $utilities  = UtilitiesGeneral::find("1");
        $file = $request->input('updateFile');

        $destinationPath = 'img';

        if($file == $utilities->strShopImage)
        {
            $utilities->strShopName = $request->input('updateShopName');
            $utilities->strShopAddress = $request->input('updateShopAddress'); 
        }else{
            $request->file('updateLogo')->move($destinationPath);
            $utilities->strShopName = $request->input('updateShopName'); 
            $utilities->strShopAddress = $request->input('updateShopAddress'); 
            $utilities->strShopImage = 'img/'.$file;
        }

        $utilities->save();
         
        session::put('shop_logo', $request->input('updateFile'));
        session::put('shop_name', $request->input('updateShopName'));
        session::put('shop_address', $request->input('updateShopAddress'));
        
        return redirect('utilities/utilities-general');
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
