<?php
namespace App\Code;

use Pecee\SimpleRouter\SimpleRouter;

class AppRouter{
    static public function init(){
        SimpleRouter::setDefaultNamespace('\App\Code\Controller');
    }

    static public function callRoutes(){
        /*
         * HOME PAGE
         */
        SimpleRouter::get('/', function (){
            response()->redirect('/authors');
        });

        /*
         * AUTHOR ROUTES
         */
        SimpleRouter::get('/authors', 'AuthorController@index')->name('authors');
        SimpleRouter::match(['get', 'post'], '/authors/edit/{id}', 'AuthorController@edit')->name('authors.edit');
        SimpleRouter::match(['get', 'post'], '/authors/create', 'AuthorController@create')->name('authors.create');
        SimpleRouter::match(['get', 'post'], '/authors/delete/{id}', 'AuthorController@delete')->name('authors.delete');

        /*
         * POSTS ROUTES
         */
        SimpleRouter::get('/authors/{id}/posts', 'PostsController@index')->name('posts');
        SimpleRouter::match(['get', 'post'], '/authors/{id}/posts/edit/{postId}', 'PostsController@edit')->name('posts.edit');
        SimpleRouter::match(['get', 'post'], '/authors/{id}/posts/create', 'PostsController@create')->name('posts.create');
        SimpleRouter::match(['get', 'post'], '/authors/{id}/posts/delete/{postId}', 'PostsController@delete')->name('posts.delete');
    }
}