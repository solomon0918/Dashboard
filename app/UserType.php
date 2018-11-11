<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    //
    protected $table = "lk_user_type";
    protected $primaryKey = "user_type_id";

    public function roles(){
    	return $this->hasMany(UserRole::class, "user_type_id");
    }
}
