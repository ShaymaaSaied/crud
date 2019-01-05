<?php
namespace App\Core\CoreLoader\TemplateEngine;

use App\Core\CoreLoader\Interfaces\LoaderInterface;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Loader implements LoaderInterface {
    protected $loader;
    protected $twig;

    public function __construct(){
        $this->loader = new Twig_Loader_Filesystem(getBasePath().'/Code/Views');
        $this->twig   = new Twig_Environment($this->loader, array(
            //'cache' => getBasePath().'/cache/views',
        ));
    }

    public function load(){
        return $this->twig;
    }

    /*public function addExtension(){

    }*/
}