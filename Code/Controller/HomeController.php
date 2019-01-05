<?php
namespace App\Code\Controller;

use App\Code\Model\Author;
use App\Core\Mvc\Controller\AbstractController;

class HomeController extends AbstractController {
    private $author;

    public function _init(){
        $this->author = new Author();
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(){
        /*print_r($this->author->getAll());
        exit;*/

        //print_r(request()->getInputHandler()->get('id')->getValue());
        if($this->request->isAjax()){
            return $this->request->json(['test'=>'val']);
        }
        //return response()->json(['test'=>'val']);

        return $this->twig->load('home.twig')->render(['a_variable' => "Hi, This is a template"]);
    }
}