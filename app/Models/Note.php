<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{

	protected $fillable = ['lead_id','contact_id','caption','files','created_by','updated_by','deleted_by'];	
	
}
