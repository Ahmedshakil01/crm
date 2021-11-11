<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mailbox extends Model
{
    use HasFactory;
	use SoftDeletes;
	
	protected $fillable = [];
	
	protected $guarded = [];

	public function mailReplies() {
		return $this->hasMany(MailReply::class, 'mail_id','id');
	}
}
