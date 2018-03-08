<?php

namespace Wcr\Crud;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public function users (){
        return $this->belongsToMany('App\User', 'users_roles');
    }

    public function permissions (){
        return $this->morphMany('Wcr\Crud\Permissions', 'target');
    }
}
