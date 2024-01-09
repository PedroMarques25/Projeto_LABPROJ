<?php
if (!function_exists('userName')) {
    function userName(){
        return Session::get('user_name');
    }
}

if (!function_exists('userBio')) {
    function userBio(){
        return Session::get('user_bio');
    }
}

if (!function_exists('userCity')) {
    function userCity(){
        return Session::get('user_city');
    }
}

if (!function_exists('sessionSuccess')) {
    function sessionSuccess(){
        return Session::get('success');
    }
}
