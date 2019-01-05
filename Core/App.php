<?php
namespace App\Core;

use App\Core\TemplateEngine\Loader;
use Twig_Environment;

class App{
    protected $twigLoader;

    /**
     * App constructor.
     */
    public function __construct(){
        $this->twigLoader = new Loader();
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig(){
        return $this->twigLoader->getTwig();
    }
}