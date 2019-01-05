<?php
namespace App\Core\Mvc\Controller;

abstract class AbstractController{
    /** @var \Pecee\Http\Request  */
    protected $request;

    /** @var \Pecee\Http\Response  */
    protected $response;

    /** @var \Twig_Environment  */
    protected $twig;

    /**
     * AbstractModel constructor.
     */
    public function __construct(){
        $this->request  = request();
        $this->response = response();
        $this->twig     = twig();

        $this->_init();
    }

    public function _init(){

    }
}