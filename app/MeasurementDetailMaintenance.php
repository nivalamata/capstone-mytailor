<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeasurementDetailMaintenance extends Model
{
    protected $table = 'tblMeasurementDetail';
	protected $primaryKey = 'strMeasurementDetailID';
	protected $fillable = array('strMeasurementDetailID',
								'strMeasDetSegmentFK',
								'strMeasCategoryFK',
								'strMeasDetailName',
								'txtMeasDetailDesc',
								'dblMeasDetailMinCm',
								'dblMeasDetailMinInch',
								'strMeasDetInactiveReason',
								'boolIsActive'
								
								);
}
