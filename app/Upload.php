<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    //
    protected $primaryKey = "upload_id";

    protected $imageUrl = "";

    public function type(){
    	return $this->belongsTo(UploadType::class, "upload_type_id");
    }

    public function user(){
    	return $this->belongsTo(User::class, "client_userid");
    }
    
}
