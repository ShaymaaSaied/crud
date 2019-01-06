<?php
namespace App\Code\Controller;

use App\Code\Model\Author;
use App\Core\Mvc\Controller\AbstractController;

class AuthorController extends AbstractController {
    /** @var \App\Code\Model\Author */
    private $author;

    public function _init(){
        $this->author = new Author();
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function index(){
        $rows     = $this->author->getAll();
        $messages = flash()->display();
        return $this->twig->load('author/grid.twig')->render([
            'messages'  => $messages,
            'grid_rows' => $rows
        ]);
    }

    public function create(){
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
                $this->author->insert($data);
                $this->flash->success('Add new record successfully');
            }catch (\Exception $e){
                $this->flash->error(['Import new data error!', $e->getMessage()]);
                $this->response->refresh();
            }

            /*
             * Finally redirect when success
             */
            $this->response->redirect('/authors');
        }else{
            /*
             * Prepare form data
             */
            $messages = flash()->display();
            return $this->twig->load('author/create.twig')->render([
                'messages'    => $messages,
                'csrf_token'  => csrf_token()
            ]);
        }
    }

    /**
     * @param $id
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function edit($id){
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
                $this->author->update($id, $data);
                $this->flash->success('Updated Successfully');
            }catch (\Exception $e){
                $this->flash->error(['Update Error!', $e->getMessage()]);
                $this->response->refresh();
            }

            /*
             * Finally redirect when success
             */
            $this->response->redirect('/authors');
        }else{
            /*
             * Prepare form data
             */
            $messages = flash()->display();
            return $this->twig->load('author/edit.twig')->render([
                'messages'    => $messages,
                'csrf_token'  => csrf_token(),
                'form_data'   => $this->author->getById($id)
            ]);
        }
    }

    /**
     * @param $id
     */
    public function delete($id){
        /*
         * Update process
         */
        try{
            $this->author->delete($id);
            $this->flash->info('Record deleted successfully');
        }catch (\Exception $e){
            $this->flash->error(['Delete Error!', $e->getMessage()]);
            $this->response->refresh();
        }

        /*
         * Finally redirect when success
         */
        $this->response->redirect('/authors');
    }
}