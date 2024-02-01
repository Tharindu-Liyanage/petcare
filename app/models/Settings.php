<?php
    class Settings{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getSettingDetails($userid){
            $this->db->query('SELECT * FROM petcare_staff WHERE staff_id = '.$userid );

            $results = $this->db->single();
            return $results;
        }

        public function getPetOwnerSettingDetails($userid){
            $this->db->query('SELECT * FROM petcare_petowner WHERE id = '.$userid );

            $results = $this->db->single();
            return $results;
        }

        public function getPasswordById($user_id){
            $this->db->query('SELECT * FROM petcare_staff WHERE staff_id = :id');
            $this->db->bind(':id' , $user_id);
            $results = $this->db->single();
            $hashed_password = $results->password;
            return $hashed_password;

            
        }
    }