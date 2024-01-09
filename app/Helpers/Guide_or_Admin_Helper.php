<?php

if (!function_exists('isGuide')) {
    function isGuide():bool
    {
        if(Auth::user()->isGuide()){
            return true;
        }
        return false;
    }
}

if (!function_exists('isAdmin')) {
    function isAdmin():bool
    {
        if(Auth::user()->isAdmin()){
            return true;
        }
        return false;
    }
}

if (!function_exists('routeBelongs')) {
    function routeBelongs($route) {
        $user = Auth::user();
        if ($user && $user->guide && $user->guide->id === $route->guide_id) {
            return true;
        }
        return false;
    }
}

