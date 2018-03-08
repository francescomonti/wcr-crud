<?php
namespace Wcr\Crud;

use Illuminate\Support\Facades\Auth;
use Wcr\Crud\Entity;

trait Entitize
{
    public $isEntity = true;

    public static function boot()
    {
        parent::boot();

        self::creating(function($model){
            // ... nothing for now
        });

        self::created(function($model){
            $relation = new Entity();
            $relation->relationship = 'owner';
            Auth::user()->entities()->save($relation);
            $model->relations()->save($relation);
        });

        self::updating(function($model){
            // ... nothing for now
        });

        self::updated(function($model){
            // ... nothing for now
        });

        self::deleting(function($model){
            $model->relations()->delete();
        });

        self::deleted(function($model){
            // ... nothing for now
        });
    }
    
    public function relations (){
        return $this->morphMany('Wcr\Crud\Entity', 'resource');
    }

    public function owner (){
        return $this->relations()->where('relationship', '=', 'owner')->get()[0]->user()->get()[0];
    }

    public function listOf ($relationship){
        $relations = $this->entities()->where('relationship', '=', $relationship)->get();
        $res = array();
        foreach ($relations as $r){
            $res[]=$r->user()->get()[0];
        }
        return $res;
    }

}