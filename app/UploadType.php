<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadType extends Model
{
    //
    protected $table = "lk_upload_type";
    protected $primaryKey = "upload_type_id";

    public function upload(){
    	return $this->hasMany(Upload::class, "upload_type_id");
    }
}
