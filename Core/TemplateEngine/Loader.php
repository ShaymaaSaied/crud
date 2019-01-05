<?php
namespace App\Core\TemplateEngine;

use Twig_Environment;
use Twig_Loader_Filesystem;

class Loader{
    protected $loader;
    protected $twig;

    public function __construct(){
        $this->loader = new Twig_Loader_Filesystem(getBasePath().'/Code/Views');
        $this->twig   = new Twig_Environment($this->loader, array(
            'cache' => getBasePath().'/cache/views',
        ));
    }

    public function getTwig(){
        return $this->twig;
    }
}