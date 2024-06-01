<?php

namespace Framework\Middleware;

use Framework\Session;

class Authorize{
    public static function isAuthenticated() {
        return Session::hasKey('user');
    }

    public static function handle($role) {
        if($role == 'guest' && Authorize::isAuthenticated()){
            return redirect('/resume');
        }
        else if ($role == 'auth' && !Authorize::isAuthenticated()){
            return redirect('/login');
        }
    }
}