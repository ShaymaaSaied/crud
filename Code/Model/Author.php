<?php
namespace App\Code\Model;

use App\Core\Mvc\Model\AbstractModel;

class Author extends AbstractModel{
    public function getAll(){
        return $this->db->run('SELECT * FROM author');
    }
}