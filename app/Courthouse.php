<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courthouse extends Model
{
    protected $table = "courthouses";
    protected $primaryKey = "courthouse_id";

    public function county(){
    	return $this->belongsTo(County::class, "county_id");
    }

    public function info(){
    	return $this->hasOne(CourthouseInfo::class, "courthouse_id");
    }
}
