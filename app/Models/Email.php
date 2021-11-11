<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{

	protected $fillable = ['lead_id','contact_id','caption','files','details','status','created_by','updated_by','deleted_by'];	
	
}
