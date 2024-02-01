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

    }