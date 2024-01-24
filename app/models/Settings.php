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

        public function getStaffSettingDetails($userid){
            $this->db->query('SELECT * FROM petcare_petowner WHERE id = '.$userid );

            $results = $this->db->single();
            return $results;
        }
    }