<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BodyPartCategory extends Model
{
    protected $table = 'tblBodyPartCategory';
    
	protected $primaryKey = 'strBodyPartCategoryID';
	protected $fillable = array('strBodyPartCategoryID',
								'strBodyPartCatName',
								'textBodyPartCatDesc',
								'strBodyPartCategoryInactiveReason',
								'boolIsActive'
								//
								);
}
