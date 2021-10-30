<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{

    use Notifiable;

    protected $fillable = [
        'name', 'email', 'password', 'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $appends = [
        'role_name'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    public function setPasswordAttribute($value)
    {
        if ($value != '') {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function getRoleNameAttribute()
    {
        return $this->role->label;
    }

    public function hasPermission($permission)
    {
        return true;
        return $this->hasAnyRoles($permission->roles);
    }

    public function hasAnyRoles($roles)
    {
        if(is_array($roles) || is_object($roles)){
            return $roles->intersect([$this->role])->count();
        }
        return $this->role == $roles;
    }
}
