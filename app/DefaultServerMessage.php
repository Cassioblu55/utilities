<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultServerMessage extends Model
{

	protected $fillable = ['url_param', 'css', 'message_box_name', 'css_class_name', 'fade_in', 'fade_out'];

}
