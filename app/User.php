<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $primaryKey = "userid";
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'dob', 'email', 'password', 'user_role_id', 'city', 'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'user_role_id'
    ];

    public function role(){
      return $this->belongsTo(UserRole::class, "user_role_id");
    }

    public function upload(){
      return $this->hasMany(Upload::class, "client_userid");
    }

    public function attorney(){
      return $this->hasOne(Attorney::class, "userid");
    }

    public function authorizeRoles($roles){
      if (is_array($roles)) {
          return $this->hasAnyRole($roles);
      }
          return $this->hasRole($roles);
    }

    public function hasAnyRole($roles)
    {
      return $this->role()->whereHas('type', function($query) use($roles){
          $query->whereIn('type_description', $roles);
      })->first();
    }

    public function hasRole($role)
    {
      return $this->role()->whereHas('type', function($query) use($role){
          $query->where('type_description', $role);
      })->first();
    }

    public function uploads($type){
      return $this->upload()->where('upload_type_id', $type)->first();
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

}
