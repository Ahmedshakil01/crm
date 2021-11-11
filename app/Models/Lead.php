<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Nicolaslopezj\Searchable\SearchableTrait;
use Illuminate\Notifications\Notifiable;
use App\Models\Administration;

class Lead extends Authenticatable
{
	use SoftDeletes;
	
    protected $fillable = [
       'company',
       'owner_name',
       'photo',
       'contact',
       'address',
       'email',
       'division',
       'district',
       'area',
       'zipcode',
       'status',
       'telephone',
       'alternate_email',
	   'contact_person_name',
	   'contact_person_mobile',
	   'fax',
	   'skype_id',
	   'twitter',
	   'facebook',
	   'linkedin',
	   'youtube',
	   'source',
	   'industry',
	   'rating',
	   'status',
	   'total_employee',
	   'annual_revenue',
	   'details',
	   'created_by',
	   'updated_by',
    ];

	public function getAdmin()
    {
        return $this->belongsTo(Administration::class, 'created_by','id');
    }

}
