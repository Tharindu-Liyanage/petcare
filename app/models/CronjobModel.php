<?php

    class CronjobModel {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }



        public function unlockTimeSlot(){

            $this->db->query('UPDATE petcare_temp_lock_timeslots SET status = 0 WHERE end_time < NOW() AND status = 1');
            
            
            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }
        }
    
    }