<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementCategoryMaintenance extends Model
{
    protected $table = 'tblMeasurementCategory';
	protected $primaryKey = 'strSegStyleCatID';
	protected $fillable = array('strMeasurementCategoryID',
								'strMeasurementCategoryName',
								'txtMeasurementCategoryDesc',
								'strMeasCatInactiveReason',
								'boolIsActive'
								
								);
}
