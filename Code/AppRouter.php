<?php
namespace App\Code;

use Pecee\SimpleRouter\SimpleRouter;

class AppRouter{
    static public function init(){
        SimpleRouter::setDefaultNamespace('\App\Code\Controller');
    }

    static public function callRoutes(){
        SimpleRouter::get('/', 'HomeController@index');
        SimpleRouter::get('/home', 'HomeController@index');
    }
}