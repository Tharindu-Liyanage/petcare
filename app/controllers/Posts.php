<?php
    class Posts extends Controller{
       public function __construct(){
        if(!isLoggedIn()){
            redirect('auth/login');
        }else{
            die ('endeed');
        }

        $this->postModel = $this->model('Post');
       }

       public function index(){

        $posts = $this->postModel->getPosts();


        $data = [
            'posts' => $posts
        ];
        $this->view('home/index', $data);
       }
    }