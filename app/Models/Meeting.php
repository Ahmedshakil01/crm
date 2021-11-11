<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{

	protected $fillable = ['lead_id','contact_id','caption','files','meeting_date','status','created_by','updated_by','deleted_by'];	
	
}
