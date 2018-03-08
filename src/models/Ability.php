<?php

namespace App;

use Auth;

class Ability
{
    public static function Create($model)
    {
        $user = User::find(Auth::user()->id);
        $ability = "Create::".get_class($model);
        return $user->has_ability($ability);
    }

    public static function Edit($model)
    {
        $user = User::find(Auth::user()->id);
        $ability = "Edit::".get_class($model);
        return $user->has_ability($ability);
    }

    public static function Show($model)
    {
        $user = User::find(Auth::user()->id);
        $ability = "Show::".get_class($model);
        return $user->has_ability($ability);
    }

    public static function Destroy($model)
    {
        $user = User::find(Auth::user()->id);
        $ability = "Destroy::".get_class($model);
        return $user->has_ability($ability);
    }

}