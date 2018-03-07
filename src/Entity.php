<?php

namespace Wcr\Crud;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Entity extends Model
{
    public function resource()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
