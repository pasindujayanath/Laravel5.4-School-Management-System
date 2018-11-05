<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [     
		'cls_id',
		'code',
		'name',
		'year',
		'semester',
		'floor',
		'room',
		'capacity'
    ];
}
