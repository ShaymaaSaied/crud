<?php
/**
 * Created by PhpStorm.
 * User: Shaymaa
 * Date: 06/01/2019
 * Time: 15:19
 */

namespace App\Code\Model;
use App\Core\Mvc\Model\AbstractModel;

class Post extends AbstractModel{

    /**
     * @return mixed
     */
    public function getAll(){
        return $this->db->run("
            SELECT `post`.`post_id`
            , CONCAT(`author`.`first_name`, ' ', `author`.`middle_name`, ' ', `author`.`last_name`) AS `author`
            , `post`.`subject`
            , `post`.`created_at`
            , `post`.`updated_at`
            FROM post
            INNER JOIN author
            ON `post`.`author_id`=`post`.`post_id`
            WHERE `post`.`deleted_at` IS NULL AND `author`.`deleted_at` IS NULL 
        ");
    }

    /**
     * @param $author_id
     * @return mixed
     */
    public function getByAuthorId($author_id){
        return $this->db->run("
            SELECT `post`.`post_id`
            , `post`.`subject`
            , `post`.`created_at`
            , `post`.`updated_at`
            FROM post
            WHERE `post`.`deleted_at` IS NULL AND `post`.`author_id` = ? 
        ", $author_id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getById($id){
        return $this->db->row("
            SELECT `post_id`
            , `subject`
            , `content`
            FROM post
            WHERE `deleted_at` IS NULL AND `post_id` = ?
        ", $id);
    }

    /**
     * @param $data
     * @return int
     */
    public function insert($data){
        return $this->db->insert('post', $data);
    }

    /**
     * @param $id
     * @param $data
     * @return int
     */
    public function update($id, $data){
        return $this->db->update('post', array_merge($data, [
            'updated_at' => date('Y-m-d H:i:s')
        ]), [
            'post_id' => $id
        ]);
    }

    /**
     * @param $id
     * @return int
     */
    public function delete($id){
        return $this->db->update('post', [
            'deleted_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ], [
            'post_id' => $id
        ]);
    }
}