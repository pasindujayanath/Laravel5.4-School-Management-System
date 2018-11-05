<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [     
		'sbj_id',
		'code',
		'name',
		'year',
		'semester',
		'periods'
    ];

    /**
     * Relationship mappings.
     *
     */
    public function instructors()
    {
    	return $this->belongsToMany('App\Instructor')->withTimestamps();
    } 

    public function students()
    {
    	return $this->belongsToMany('App\Student')->withTimestamps();
    }
}
