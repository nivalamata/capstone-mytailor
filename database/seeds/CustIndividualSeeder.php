<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CustIndividualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
       // DB::table('tblCustIndividual')->delete();

        $tblCustIndividual = array (
            array(
                'strIndivID' => 'CUSTP001',
                'strIndivFName' => 'Riel',
                'strIndivLName' => 'Apellanes',
                'strIndivMName' => 'Aquino',
                'strIndivSex' => 'F',
                'strIndivHouseNo' => '44',
                'strIndivStreet' => 'Ipil St.',
                'strIndivBarangay' => 'St. Anthony',
                'strIndivCity' => 'Cainta',
                'strIndivProvince' => 'Rizal',
                'strIndivZipCode' => '1007',
                'strIndivLandlineNumber' => '0467892',
                'strIndivCPNumber' => '09156789678',
                'strIndivCPNumberAlt' => '09122345678',
                'strIndivEmailAddress' => 'morriel.aquino@gmail.com',
                'strIndivImg' => '',
                'userId' => null,
                'boolIsActive' => '1'
            ),

            array(
                'strIndivID' => 'CUSTP002',
                'strIndivFName' => 'Bimby',
                'strIndivLName' => 'Reyes',
                'strIndivMName' => 'Legaspi',
                'strIndivSex' => 'M',
                'strIndivHouseNo' => '41',
                'strIndivStreet' => 'Narra St.',
                'strIndivBarangay' => 'Kwek-kwek',
                'strIndivCity' => 'Angono',
                'strIndivProvince' => 'Rizal',
                'strIndivZipCode' => '1003',
                'strIndivLandlineNumber' => '0723456',
                'strIndivCPNumber' => '09198761290',
                'strIndivCPNumberAlt' => '09121236789',
                'strIndivEmailAddress' => 'bimbsaquino090409@gmail.com',
                'strIndivImg' => '',
                'userId' => null,
                'boolIsActive' => '1'
            )

        );

        DB::table('tblCustIndividual')->insert($tblCustIndividual);
    }
}