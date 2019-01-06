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

        /*
         * AUTHOR ROUTES
         */
        SimpleRouter::get('/authors', 'AuthorController@index')->name('authors');
        SimpleRouter::match(['get', 'post'], '/authors/edit/{id}', 'AuthorController@edit')->name('authors.edit');
        SimpleRouter::match(['get', 'post'], '/authors/create', 'AuthorController@create')->name('authors.create');
        SimpleRouter::match(['get', 'post'], '/authors/delete/{id}', 'AuthorController@delete')->name('authors.delete');
    }
}