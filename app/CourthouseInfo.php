<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CourthouseInfo extends Model
{
    protected $table = "courthouses_info";
    protected $primaryKey = null;
    public $incrementing = false;

    public function courthouse(){
    	return $this->belongsTo(Courthouse::class, "courthouse_id");
    }

    public function attorney(){
    	return $this->belongsTo(Attorney::class, "attorney_userid");
    }

    public function getCountyAttribute(){
    	return $this->courthouse->county;
    }

}
