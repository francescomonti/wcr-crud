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

}