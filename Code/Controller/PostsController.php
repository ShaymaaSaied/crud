<?php
namespace App\Code\Controller;

use App\Code\Model\Author;
use App\Code\Model\Post;
use App\Core\Mvc\Controller\AbstractController;

class PostsController extends AbstractController {
    /** @var \App\Code\Model\Post */
    private $post;

    /** @var \App\Code\Model\Author */
    private $author;



    public function _init(){
        $this->post   = new Post();
        $this->author = new Author();
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index($id){
        $rows     = $this->post->getByAuthorId($id);
        $messages = flash()->display();
        return $this->twig->load('posts/grid.twig')->render([
            'messages'    => $messages,
            'author_id'   => $id,
            'author_name' => $this->author->getNameById($id),
            'grid_rows'   => $rows
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function create($id){
        if($this->request->getMethod() == 'post'){
            /*
             * Prepare data
             */
            $data = $this->request->getInputHandler()->all();
            unset($data['submit'], $data['csrf_token']);

            /*
             * Create process
             */
            try{
                $this->post->insert($data);
                $this->flash->success('Add new record successfully');
            }catch (\Exception $e){
                $this->flash->error(['Import new data error!', $e->getMessage()]);
                $this->response->refresh();
            }

            /*
             * Finally redirect when success
             */
            $this->response->redirect('/authors/'.$id.'/posts/');
        }else{
            /*
             * Prepare form data
             */
            $messages = flash()->display();
            return $this->twig->load('posts/create.twig')->render([
                'messages'    => $messages,
                'author_id'   => $id,
                'author_name' => $this->author->getNameById($id),
                'csrf_token'  => csrf_token()
            ]);
        }
    }

    /**
     * @param $id
     * @param $postId
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function edit($id, $postId){
        if($this->request->getMethod() == 'post'){
            /*
             * Prepare data
             */
            $data = $this->request->getInputHandler()->all();
            unset($data['submit'], $data['csrf_token']);

            /*
             * Update process
             */
            try{
                $this->post->update($postId, $data);
                $this->flash->success('Updated Successfully');
            }catch (\Exception $e){
                $this->flash->error(['Update Error!', $e->getMessage()]);
                $this->response->refresh();
            }

            /*
             * Finally redirect when success
             */
            $this->response->redirect('/authors/'.$id.'/posts/');
        }else{
            /*
             * Prepare form data
             */
            $messages = flash()->display();
            return $this->twig->load('posts/edit.twig')->render([
                'messages'    => $messages,
                'csrf_token'  => csrf_token(),
                'form_data'   => $this->post->getById($id),
                'author_id'   => $id,
                'author_name' => $this->author->getNameById($id)
            ]);
        }
    }

    /**
     * @param $id
     * @param $postId
     */
    public function delete($id, $postId){
        /*
         * Update process
         */
        try{
            $this->post->delete($postId);
            $this->flash->info('Record deleted successfully');
        }catch (\Exception $e){
            $this->flash->error(['Delete Error!', $e->getMessage()]);
            $this->response->refresh();
        }

        /*
         * Finally redirect when success
         */
        $this->response->redirect('/authors/'.$id.'/posts/');
    }
}