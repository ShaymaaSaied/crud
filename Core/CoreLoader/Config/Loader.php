<?php
namespace App\Core\CoreLoader\Config;

use App\Core\CoreLoader\Interfaces\LoaderInterface;
use function DI\factory;


class Loader implements LoaderInterface{
    /** @var array  */
    private $configData = [];

    /**
     * Loader constructor.
     */
    public function __construct(){
        $this->scanConfig();
    }

    /**
     * @param $configPath
     * @return mixed|null
     */
    public function getConfig($configPath){
        return isset($this->configData[$configPath])?$this->configData[$configPath]:null;
    }

    /**
     * @return $this
     */
    public function load(){
        return $this;
    }

    /**
     * Scan Config Files to parse it
     */
    private function scanConfig(){
        $configFiles = $this->getConfigFiles();
        foreach ($configFiles as $configFile){
            $this->configData = array_merge($this->configData, $this->nestedValues(include $configFile['path'], $configFile['name'].'.'));
        }
    }

    /**
     * @return array
     */
    private function getConfigFiles(){
        $configDirectory = getBasePath().'/config/';
        $dirItems        = scandir($configDirectory);
        $files           = [];
        foreach ($dirItems as $item){
            if(preg_match('/^\./', $item)) continue;
            $files[] = [
                'name' => pathinfo($item, PATHINFO_FILENAME),
                'path' => $configDirectory . $item
            ];
        }

        return $files;
    }

    /**
     * @param $array
     * @param string $path
     * @return array
     */
    private function nestedValues($array, $path=""){
        $output = array();
        foreach($array as $key => $value) {
            if(is_array($value)) {
                $output = array_merge($output, $this->nestedValues($value, (!empty($path)) ? $path.$key."." : $key."."));
            } else $output[$path.$key] = $value;
        }
        return $output;
    }

}