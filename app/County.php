<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class County extends Model
{
    protected $table = "counties";
    protected $primaryKey = "county_id";

    public function courthouse(){
    	return $this->hasMany(Courthouse::class, "county_id");
    }
}
