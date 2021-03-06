<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class JobOrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        $tblJobOrder = array (
            array(
                'strJobOrderID' => 'JO001',
                'strJO_CustomerFK' => 'CUSTP001',    
                'strJO_CustomerCompanyFK' => NULL,
                'strTermsOfPayment' => 'Full Payment',
                'strModeOfPayment' => 'Cash',
                'intJO_OrderQuantity' => '10',
                'dblOrderTotalPrice' => '4500.00',
                'boolIsOrderAccepted' => '1',
                'dtOrderDate' => '2016-07-23',
                'dtOrderApproved' => '2016-07-23',
                'dtOrderExpectedToBeDone' => '2016-07-23',
                'dtExpectedDeliveryDate' => '2016-07-23',
                'dtFinished' => '2016-07-23',
                'dtDelivered' => '2016-07-23',
                'boolIsActive' => '1',
                'boolIsOnline' => '0'
            ),
            array(
                'strJobOrderID' => 'JO002',
                'strJO_CustomerFK' => 'CUSTP002',    
                'strJO_CustomerCompanyFK' => NULL,
                'strTermsOfPayment' => 'Full Payment',
                'strModeOfPayment' => 'Cash',
                'intJO_OrderQuantity' => '5',
                'dblOrderTotalPrice' => '4000.00',
                'boolIsOrderAccepted' => '1',
                'dtOrderDate' => '2016-07-24',
                'dtOrderApproved' => '2016-07-24',
                'dtOrderExpectedToBeDone' => '2016-07-24',
                'dtExpectedDeliveryDate' => '2016-07-24',
                'dtFinished' => '2016-07-24',
                'dtDelivered' => '2016-07-24',
                'boolIsActive' => '1',
                'boolIsOnline' => '0'

            ),
            array(
                'strJobOrderID' => 'JO003',
                'strJO_CustomerFK' => NULL,    
                'strJO_CustomerCompanyFK' => 'CUSTC001',
                'strTermsOfPayment' => 'Full Payment',
                'strModeOfPayment' => 'Cash',
                'intJO_OrderQuantity' => '20',
                'dblOrderTotalPrice' => '11000.00',
                'boolIsOrderAccepted' => '1',
                'dtOrderDate' => '2016-07-23',
                'dtOrderApproved' => '2016-07-23',
                'dtOrderExpectedToBeDone' => '2016-07-23',
                'dtExpectedDeliveryDate' => '2016-07-23',
                'dtFinished' => '2016-07-23',
                'dtDelivered' => '2016-07-23',
                'boolIsActive' => '1',
                'boolIsOnline' => '0'
            ),

            array(
                'strJobOrderID' => 'JO004',
                'strJO_CustomerFK' => NULL,    
                'strJO_CustomerCompanyFK' => 'CUSTC001',
                'strTermsOfPayment' => 'Full Payment',
                'strModeOfPayment' => 'Cash',
                'intJO_OrderQuantity' => '30',
                'dblOrderTotalPrice' => '22500.00',
                'boolIsOrderAccepted' => '1',
                'dtOrderDate' => '2016-08-23',
                'dtOrderApproved' => '2016-08-23',
                'dtOrderExpectedToBeDone' => '2016-09-23',
                'dtExpectedDeliveryDate' => '2016-09-24',
                'dtFinished' => '2016-09-20',
                'dtDelivered' => '2016-09-24',
                'boolIsActive' => '1',
                'boolIsOnline' => '0'
            ),

            array(
                'strJobOrderID' => 'JO005',
                'strJO_CustomerFK' => NULL,    
                'strJO_CustomerCompanyFK' => 'CUSTC001',
                'strTermsOfPayment' => 'Full Payment',
                'strModeOfPayment' => 'Cash',
                'intJO_OrderQuantity' => '20',
                'dblOrderTotalPrice' => '12000.00',
                'boolIsOrderAccepted' => '1',
                'dtOrderDate' => '2016-08-24',
                'dtOrderApproved' => '2016-08-24',
                'dtOrderExpectedToBeDone' => '2016-09-24',
                'dtExpectedDeliveryDate' => '2016-09-25',
                'dtFinished' => '2016-09-21',
                'dtDelivered' => '2016-09-26',
                'boolIsActive' => '1',
                'boolIsOnline' => '0'
            )
        );

        DB::table('tblJobOrder')->insert($tblJobOrder);
    }
}