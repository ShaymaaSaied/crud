<?php
namespace App\Core\Mvc\Controller;

use Tamtamchik\SimpleFlash\Flash;

abstract class AbstractController{
    /** @var \Pecee\Http\Request  */
    protected $request;

    /** @var \Pecee\Http\Response  */
    protected $response;

    /** @var \Twig_Environment  */
    protected $twig;

    /** @var Flash  */
    protected $flash;


    /**
     * AbstractModel constructor.
     */
    public function __construct(){
        $this->request  = request();
        $this->response = response();
        $this->twig     = twig();
        $this->flash = new Flash();

        $this->_init();
    }

    public function _init(){

    }
}