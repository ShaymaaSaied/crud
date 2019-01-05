<?php
namespace App\Code\Controller;

class HomeController{
    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(){
        //print_r(request()->getInputHandler()->get('id')->getValue());
        if(request()->isAjax()){
            return response()->json(['test'=>'val']);
        }
        //return response()->json(['test'=>'val']);

        return twig()->load('home.html')->render(['a_variable' => "Hi, This is a template"]);
    }
}