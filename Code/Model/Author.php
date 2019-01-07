<?php
namespace App\Code\Model;

use App\Core\Mvc\Model\AbstractModel;

class Author extends AbstractModel{
    /**
     * @return mixed
     */
    public function getAll(){
        return $this->db->run("
            SELECT `author_id`
            , CONCAT(`first_name`, ' ', `middle_name`, ' ', `last_name`) AS `name`
            , `email`
            , `created_at`
            , `updated_at`
            FROM author
            WHERE `deleted_at` IS NULL
        ");
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->db->row("
            SELECT `author_id`
            , `first_name`, `middle_name`, `last_name`
            , `email`
            , `bio`
            FROM author
            WHERE `deleted_at` IS NULL AND `author_id` = ?
        ", $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getNameById($id){
        return $this->db->cell("
            SELECT CONCAT(`first_name`, ' ', `middle_name`, ' ', `last_name`) AS `name`
            FROM author WHERE author_id = ?
        ", $id);
    }

    /**
     * @param $data
     * @return int
     */
    public function insert($data){
        return $this->db->insert('author', $data);
    }

    /**
     * @param $id
     * @param $data
     * @return int
     */
    public function update($id, $data){
        return $this->db->update('author', array_merge($data, [
            'updated_at' => date('Y-m-d H:i:s')
        ]), [
            'author_id' => $id
        ]);
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id){
        return $this->db->update('author', [
            'deleted_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ], [
            'author_id' => $id
        ]);
    }
}