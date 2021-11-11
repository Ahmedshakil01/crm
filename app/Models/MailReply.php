<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MailReply extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = [];
	
	protected $guarded = [];

	public function mailBoxes() {
		return $this->belongsTo(Mailbox::class, 'mail_id','id');
	}
}
