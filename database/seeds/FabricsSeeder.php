<?php

use Illuminate\Database\Seeder;

class FabricsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tblFabrics = array (
            array(
                'strFabricID' => 'FAB001',
                'strFabricTypeFK' => 'FABTYPE001',
                'strFabricPatternFK' =>'FBRCPAT003',
                'strFabricColorFK' => 'FABCLR001',
                'strFabricThreadCountFK' => 'THRDC002',
                'strFabricName' => 'Calvary Pink Plain',
                'dblFabricPrice' => '150',
                'strFabricCode' => 'FC01',
                'strFabricImage' => 'imgFabrics/s-697-8-1323753168826',
                'txtFabricDesc' => 'Use for school uniforms and costumes.',
                'strFabricInactiveReason' => '',
                'boolIsActive' => '1'
            ),

            array(
                'strFabricID' => 'FAB002',
                'strFabricTypeFK' => 'FABTYPE002',
                'strFabricPatternFK' =>'FBRCPAT002',
                'strFabricColorFK' => 'FABCLR002',
                'strFabricThreadCountFK' => 'THRDC001',
                'strFabricName' => 'Blue Striped Soft',
                'dblFabricPrice' => '200',
                'strFabricCode' => 'FC02',
                'strFabricImage' => 'imgFabrics/h2',
                'txtFabricDesc' => 'Use for customize shirts and polos.',
                'strFabricInactiveReason' => '',
                'boolIsActive' => '1'
            ),


            array(
                'strFabricID' => 'FAB003',
                'strFabricTypeFK' => 'FABTYPE003',
                'strFabricPatternFK' =>'FBRCPAT003',
                'strFabricColorFK' => 'FABCLR003',
                'strFabricThreadCountFK' => 'THRDC002',
                'strFabricName' => 'Plain Yellow',
                'dblFabricPrice' => '200',
                'strFabricCode' => 'FC03',
                'strFabricImage' => 'imgFabrics/o37-b-1260944373495',
                'txtFabricDesc' => 'Use for customize gowns and costumes.',
                'strFabricInactiveReason' => '',
                'boolIsActive' => '1'
            )

            // array(
            //     'strFabricID' => 'FAB004',
            //     'strFabricTypeFK' => 'FABTYPE002',
            //     'strFabricPatternFK' =>'FBRCPAT002',
            //     'strFabricColorFK' => 'FABCLR004',
            //     'strFabricThreadCountFK' => 'THRDC003',
            //     'strFabricName' => 'Rainbow Striped',
            //     'dblFabricPrice' => '200',
            //     'strFabricCode' => 'FC04',
            //     'strFabricImage' => 'imgFabrics/20100509-0253',
            //     'txtFabricDesc' => 'Use for customize polos and costumes.',
            //     'strFabricInactiveReason' => '',
            //     'boolIsActive' => '1'
            // )

            // array(
            //     'strFabricID' => 'FAB005',
            //     'strFabricTypeFK' => 'FABTYPE001',
            //     'strFabricPatternFK' =>'FBRCPAT002',
            //     'strFabricColorFK' => 'FABCLR004',
            //     'strFabricThreadCountFK' => 'THRDC003',
            //     'strFabricName' => 'Dark Pallete Rainbow Striped',
            //     'dblFabricPrice' => '200',
            //     'strFabricCode' => 'FC05',
            //     'strFabricImage' => 'imgFabrics/20100509-0252',
            //     'txtFabricDesc' => 'Use for customize polos and costumes.',
            //     'strFabricInactiveReason' => '',
            //     'boolIsActive' => '1'
            // ),


            // array(
            //     'strFabricID' => 'FAB006',
            //     'strFabricTypeFK' => 'FABTYPE001',
            //     'strFabricPatternFK' =>'FBRCPAT002',
            //     'strFabricColorFK' => 'FABCLR004',
            //     'strFabricThreadCountFK' => 'THRDC001',
            //     'strFabricName' => 'Dark Pallete Rainbow Striped',
            //     'dblFabricPrice' => '200',
            //     'strFabricCode' => 'FC06',
            //     'strFabricImage' => 'imgFabrics/20100509-0252',
            //     'txtFabricDesc' => 'Use for customize polos and costumes.',
            //     'strFabricInactiveReason' => '',
            //     'boolIsActive' => '1'
            // ),

            // array(
            //     'strFabricID' => 'FAB007',
            //     'strFabricTypeFK' => 'FABTYPE001',
            //     'strFabricPatternFK' =>'FBRCPAT003',
            //     'strFabricColorFK' => 'FABCLR006',
            //     'strFabricThreadCountFK' => 'THRDC002',
            //     'strFabricName' => 'Plain Black',
            //     'dblFabricPrice' => '150',
            //     'strFabricCode' => 'FC07',
            //     'strFabricImage' => 'imgFabrics/c12-1366254050453',
            //     'txtFabricDesc' => 'Use for customize polos and costumes.',
            //     'strFabricInactiveReason' => '',
            //     'boolIsActive' => '1'
            // ),

            // array(
            //     'strFabricID' => 'FAB008',
            //     'strFabricTypeFK' => 'FABTYPE001',
            //     'strFabricPatternFK' =>'FBRCPAT003',
            //     'strFabricColorFK' => 'FABCLR007',
            //     'strFabricThreadCountFK' => 'THRDC003',
            //     'strFabricName' => 'Plain Gray',
            //     'dblFabricPrice' => '200',
            //     'strFabricCode' => 'FC08',
            //     'strFabricImage' => 'imgFabrics/2dgtw95z7-s-114188586',
            //     'txtFabricDesc' => 'Use for customize polos and costumes.',
            //     'strFabricInactiveReason' => '',
            //     'boolIsActive' => '1'
            // ),

            //  array(
            //     'strFabricID' => 'FAB009',
            //     'strFabricTypeFK' => 'FABTYPE001',
            //     'strFabricPatternFK' =>'FBRCPAT003',
            //     'strFabricColorFK' => 'FABCLR007',
            //     'strFabricThreadCountFK' => 'THRDC001',
            //     'strFabricName' => 'Plain Gray',
            //     'dblFabricPrice' => '200',
            //     'strFabricCode' => 'FC09',
            //     'strFabricImage' => 'imgFabrics/2dgtw95z7-s-114188586',
            //     'txtFabricDesc' => 'Use for customize polos and costumes.',
            //     'strFabricInactiveReason' => '',
            //     'boolIsActive' => '1'
            // ),


            //  array(
            //     'strFabricID' => 'FAB010',
            //     'strFabricTypeFK' => 'FABTYPE002',
            //     'strFabricPatternFK' =>'FBRCPAT002',
            //     'strFabricColorFK' => 'FABCLR005',
            //     'strFabricThreadCountFK' => 'THRDC001',
            //     'strFabricName' => 'Dots Red',
            //     'dblFabricPrice' => '250',
            //     'strFabricCode' => 'FC10',
            //     'strFabricImage' => 'imgFabrics/2rwd9618-s-1905521480',
            //     'txtFabricDesc' => 'Use for customize polos and blouses.',
            //     'strFabricInactiveReason' => '',
            //     'boolIsActive' => '1'
            // )





        );

        DB::table('tblFabrics')->insert($tblFabrics);
    }
}
