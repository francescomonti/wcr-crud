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

}