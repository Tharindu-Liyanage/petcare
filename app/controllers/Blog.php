<?php
    class Blog extends Controller{
       public function __construct(){
        
        $this->blogModel = $this->model('Post');
       }

       public function index(){
        $posts = $this->blogModel->getPosts();
    
    
        $data = [
            'posts' => $posts
        ];
        $this->view('blog/index', $data);
       }

       public function show($id){

        $posts = $this->blogModel->getPostById($id);
        $recentPosts = $this->blogModel->getRecentPost();

        if(!$posts){
            // Load 404 page    
            $this->view('error/404');

        }else{


            $data = [
                'posts' => $posts,
                'recentPost' => $recentPosts
            ];
    
            $this->view('blog/show', $data);
        
        }

        

       }
    }