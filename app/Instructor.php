<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [     
		'ins_id',
		'f_name',
		'l_name',
		'initials',
		'init_in_full', 
		'dob',
		'experience',
		'qualification',
		'email',
		'phone',
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
