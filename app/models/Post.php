<?php
    class Post{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getPosts(){
            $this->db->query('SELECT * FROM petcare_blogs');

            $results = $this->db->resultSet();
            return $results;
        }

        public function getPostById($id){
            $this->db->query('SELECT * FROM petcare_blogs WHERE blogID = :id');
            $this->db->bind(':id' , $id);
            $row = $this->db->single();
            return $row;
        }

        public function getRecentPost(){
            $this->db->query('SELECT * FROM petcare_blogs ORDER BY publishdate DESC');
            $result = $this->db->resultSet();
            return $result;
        }

        public function addBlog($data){
            $this->db->query('INSERT INTO petcare_blogs (title,user_id,tags,category,content,thumbnail ,author) VALUES (:title , :user_id ,  :tags , :category , :content , :thumbnail , :author )');
            $this->db->bind(':title' , $data['title']);
            $this->db->bind(':thumbnail' , $data['thumbnail']);
            $this->db->bind(':content' , $data['content']);
            $this->db->bind(':tags' , $data['tags']);
            $this->db->bind(':category' , $data['category']);
            $this->db->bind(':author' , '31');
            $this->db->bind(':user_id' , $data['user_id']);


           if($this->db->execute()){
            return true;
           }else{
            return false;
           }

        }

        public function updateBlog($data){
            $this->db->query('UPDATE petcare_blogs  SET title = :title , thumbnail = :thumbnail , content = :content ,
            tags = :tags , category = :category , author = :author , user_id = :user_id WHERE blogID = :id');
            $this->db->bind(':id' , $data['id']);
            $this->db->bind(':title' , $data['title']);
            $this->db->bind(':thumbnail' , $data['thumbnail']);
            $this->db->bind(':content' , $data['content']);
            $this->db->bind(':tags' , $data['tags']);
            $this->db->bind(':category' , $data['category']);
            $this->db->bind(':author' , '31');
            $this->db->bind(':user_id' , $data['user_id']);


           if($this->db->execute()){
            return true;
           }else{
            return false;
           }

        }

        public function deleteBlog($id){
            $this->db->query('DELETE FROM petcare_blogs WHERE blogID = :id');

            $this->db->bind(':id' , $id);
            


           if($this->db->execute()){
            return true;
           }else{
            return false;
           }
        }

        

    }