<?php
namespace App\Core\CoreLoader\Database;

use App\Core\CoreLoader\Interfaces\LoaderInterface;

class Loader implements LoaderInterface {
    /** @var \ParagonIE\EasyDB\EasyDB  */
    protected $dbInstance;

    /**
     * Loader constructor.
     */
    public function __construct(){
        $this->dbInstance = \ParagonIE\EasyDB\Factory::create(
            'mysql:host='.config('database.host').';dbname='.config('database.dbname'),
            config('database.username'),
            config('database.password')
        );
    }

    /**
     * @return \ParagonIE\EasyDB\EasyDB
     */
    public function load(){
        return $this->dbInstance;
    }
}