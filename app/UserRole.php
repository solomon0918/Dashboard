<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
	protected $table = "lk_user_role";
    //
	protected $primaryKey = "user_role_id";
    public function type(){
    	return $this->belongsTo(UserType::class, "user_type_id");
    }

    public function user(){
    	return $this->hasMany(User::class, "user_role_id");
    }

    public function checkType($user_type_id){
    	return $this->type('user_type_id', $user_type_id)->first();
    }
}
