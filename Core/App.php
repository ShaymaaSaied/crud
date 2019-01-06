<?php
namespace App\Core;

use App\Core\CoreLoader;
use Twig_Environment;

class App{
    protected $configLoader;
    protected $twigLoader;
    protected $dbLoader;

    /**
     * App bootstrap.
     */
    public function bootstrap(){
        // Start a Session
        if( !session_id() ) @session_start();

        $this->configLoader = new CoreLoader\Config\Loader();
        $this->twigLoader   = new CoreLoader\TemplateEngine\Loader();
        $this->dbLoader     = new CoreLoader\Database\Loader();
    }

    /**
     * @return Twig_Environment
     */
    public function getTwig(){
        return $this->twigLoader->load();
    }


    /**
     * @return \ParagonIE\EasyDB\EasyDB
     */
    public function getDb(){
        return $this->dbLoader->load();
    }

    /**
     * @return CoreLoader\Config\Loader
     */
    public function getConfig(){
        return $this->configLoader->load();
    }
}