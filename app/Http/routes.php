<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', 'HomeController@showWelcome');
Route::post('/login', 'HomeController@LogIn');


Route::group(['prefix' => 'maintenance'], function(){
	Route::resource('individual', 'CustomerIndividualController');

		Route::post('individual/update', 'CustomerIndividualController@updateIndividual');
		Route::post('individual/destroy', 'CustomerIndividualController@deleteIndividual');

	Route::resource('company', 'CustomerCompanyController');

		Route::post('company/update', 'CustomerCompanyController@updateCompany');
		Route::post('company/destroy', 'CustomerCompanyController@deleteCompany');
});

Route::group(['prefix' => 'maintenance'], function(){
	Route::resource('employee', 'EmployeeController');

		Route::post('employee/update', 'EmployeeController@updateEmployee');
		Route::post('employee/destroy', 'EmployeeController@deleteEmployee');

	Route::resource('employee-role', 'EmployeeRoleController');
	
		Route::post('employee-role/update','EmployeeRoleController@updateRole');
	    Route::post('employee-role/destroy','EmployeeRoleController@deleteRole');

});

Route::group(['prefix' => 'maintenance'], function(){
	Route::resource('garment-category', 'GarmentCategoryController');

		Route::post('garment-category/update','GarmentCategoryController@updateGarmentCategory');
		Route::post('garment-category/destroy','GarmentCategoryController@deleteGarmentCategory');

	Route::resource('garment-segment', 'GarmentSegmentController');

		Route::post('garment-segment/update','GarmentSegmentController@updateGarmentSegment');
		Route::post('garment-segment/destroy','GarmentSegmentController@deleteGarmentSegment');
		


	Route::resource('segment-pattern', 'SegmentPatternController',
		['only' => ['index']]);

	Route::resource('measurement-category', 'MeasurementCategoryController',
		['only' => ['index']]);

	Route::resource('measurement-detail', 'MeasurementDetailController',
		['only' => ['index']]);
});

Route::group(['prefix' => 'maintenance'], function(){
	Route::resource('fabric-type', 'FabricTypeController',
		['only' => ['index']]);

	Route::resource('swatch', 'SwatchController',
		['only' => ['index']]);

	Route::resource('material', 'MaterialsController',
		['only' => ['index']]);
});

Route::group(['prefix' => 'maintenance'], function(){
	Route::resource('catalogue', 'CatalogueController',
		['only' => ['index']]);
});


Route::group(['prefix' => 'transaction'], function(){
	Route::resource('walkin-individual', 'WalkInIndividualController',
		['only' => ['index']]);
	Route::resource('walkin-company', 'WalkInCompanyController',
		['only' => ['index']]);
});

Route::group(['prefix' => 'transaction'], function(){
	Route::resource('online-customer-individual', 'OnlineCustomerIndividualController',
		['only' => ['index']]);
	Route::resource('online-customer-company', 'OnlineCustomerCompanyController',
		['only' => ['index']]);
});

Route::group(['prefix' => 'utilities'], function(){
	Route::resource('inactive-data', 'InactiveDataController',
		['only' => ['index']]);
});
