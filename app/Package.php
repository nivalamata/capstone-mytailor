<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $table = 'tblPackages';
	protected $primaryKey = 'strPackageID';
	protected $fillable = array('strPackageID',
								'strPackageName',
								'strPackageSex',
								'strPackageSeg1FK',
								'strPackageSeg2FK',
								'strPackageSeg3FK',
								// 'strPackageSeg4FK',
								// 'strPackageSeg5FK',
								'dblPackagePrice',
								'strPackageImage',
								'intPackageMinDays',
								'strPackageDesc',
								'strPackageInactiveReason',
								'boolIsActive'
								//
								);
}
