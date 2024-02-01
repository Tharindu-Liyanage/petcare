<!-- ========================================================================================================== -->
<?php

    class AssistantModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }
 public function getPetownerDetails(){
    $this->db->query('SELECT * FROM petcare_petowner WHERE isRemoved = 0');

            $results = $this->db->resultSet();
            return $results;
 }
 

      

    }