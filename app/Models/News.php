<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = [
		'postby', 
		'publishdate', 
		'name', 'slug', 
		'details', 
		'image', 
		'file', 
		'status', 
		'sequence', 
		'meta_description',
		'keywords',
		'entry_date'
	];
	
	protected $guarded = [];
}
