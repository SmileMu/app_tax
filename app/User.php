<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use App\Role;
class User extends Authenticatable
{
use Notifiable;

/**
* The attributes that are mass assignable.
*
* @var array
*/
protected $fillable = [
'name', 'email', 'password','Status', 'role_id'
];
/**
* The attributes that should be hidden for arrays.
*
* @var array
*/
protected $hidden = [
'password', 'remember_token',
];
/**
* The attributes that should be cast to native types.
*
* @var array
*/
protected $casts = [
'email_verified_at' => 'datetime',


];


public function role()
{
    return $this->belongsTo(Role::class, 'role_id');
}

public function hasAbility($permissions)    //products  //mahoud -> admin can't see brands
{
    $role = $this->role;

    if (!$role) {
        return false;
    }

    foreach ($role->permissions as $permission) {
        if (is_array($permissions) && in_array($permission, $permissions)) {
            return true;
        } else if (is_string($permissions) && strcmp($permissions, $permission) == 0) {
            return true;
        }
    }
    return false;
}






}
