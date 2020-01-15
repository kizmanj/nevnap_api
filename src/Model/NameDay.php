<?php

namespace Nameday\Model;

use Illuminate\Database\Eloquent\Model;

class NameDay extends Model {
	protected $table = 'namedays';
	public $timestamps = false;
	protected $fillable = ['day', 'month', 'name', 'primary'];
}