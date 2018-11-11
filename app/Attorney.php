<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attorney extends Model
{
    protected $table = "attorneys";

	protected $fillable = [
        'attorney_key', 'state_bar_number', 'primary_attorney_ssn',
    ];

    public function user(){
    	return $this->belongsTo(User::class, "userid");
    }

    public function courthouses(){
        return $this->hasMany(CourthouseInfo::class, "attorney_userid");
    }
}
