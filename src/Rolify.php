<?php
namespace Wcr\Crud;

use Wcr\Crud\Entity;

trait Rolify
{
    
    public $hasRoles = true;

    public function entities (){
        return $this->hasMany('Wcr\Crud\Entity', 'user_id');
    }

    public function listOf ($type){
        $resources = $this->entities()->where('resource_type', '=', $type)->get();
        $res = array();
        foreach ($resources as $r){
            $res[]=$r->resource()->get()[0];
        }
        return $res;
    }

    public function roles (){
        return $this->belongsToMany('Wcr\Crud\Role', 'users_roles');
    }

    public function permissions (){
        return $this->morphMany('Wcr\Crud\Permission', 'target');
    }

    public function has_ability ($ability){
        $a = $this->permissions()->where('ability', '=', $ability)->count();
        if ( $a > 0 ) return true;
        else {
            foreach($this->roles()->get() as $role){
                $b = $role->permissions()->where('ability', '=', $ability)->count();
                if ( $b > 0 ) return true;
                break;
            }

            return false;
        }
    }

}