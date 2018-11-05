<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [     
		'stu_id',
		'f_name',
		'l_name',
		'initials',
		'init_in_full', 
		'dob',
		'email',
		'phone',  
		'guardian_name',
		'guardian_phone',
		'address',
		'comment'
    ];

    /**
     * Relationship mappings.
     *
     */
    public function subjects()
    {
    	return $this->belongsToMany('App\Subject')->withTimestamps();
    }
}
