<?php
namespace App\Core\Mvc\Model;

abstract class AbstractModel{
    /** @var \ParagonIE\EasyDB\EasyDB  */
    protected $db;

    /**
     * AbstractModel constructor.
     */
    public function __construct(){
        $this->db = db();
    }
}