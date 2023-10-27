<?php

    class Dashboard {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }


        /*
        For Admin
        
        */

        public function getStaffDetails(){
            // Assuming you are using a PHP variable in your SQL query
            $userID = $_SESSION['user_id'];
            $this->db->query("SELECT * FROM petcare_staff WHERE StaffID != :userID");
            $this->db->bind(':userID', $userID);

            $results = $this->db->resultSet();

            return $results;
        }

        public function addStaff($data){

            $this->db->query('INSERT INTO petcare_staff (firstname,lastname,email,phone,role,password,address ,profileImage) VALUES(:first_name, :last_name, :email, :mobile, :role,:tmp_pwd, :address , "nopic.png")');

        //bind values
        $this->db->bind(':first_name',$data['first_name']);
        $this->db->bind(':last_name',$data['last_name']);
        $this->db->bind(':mobile',$data['mobile']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':tmp_pwd',$data['tmp_pwd']);
        $this->db->bind(':role',$data['role']);
        $this->db->bind(':address',$data['address']);
        

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }   
        }

        public function updateStaff($data){

            $this->db->query('UPDATE petcare_staff SET firstname = :first_name , lastname = :last_name , email= :email, role = :role , address = :address , phone = :mobile  WHERE StaffID = :id');

        //bind values
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':first_name',$data['first_name']);
        $this->db->bind(':last_name',$data['last_name']);
        $this->db->bind(':mobile',$data['mobile']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':role',$data['role']);
        $this->db->bind(':address',$data['address']);
        

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }  

        }



         //find user by id
         public function getStaffUserById($id){
            $this->db->query('SELECT * FROM petcare_staff WHERE StaffID = :id');
            $this->db->bind(':id' , $id);
    
            $row = $this->db->single();
    
            //return row
    
            return $row;
    
        }


        //remove staff

        public function removeStaffUser($id){
            $this->db->query('DELETE  FROM petcare_staff WHERE StaffID = :id');
            $this->db->bind(':id' , $id);
            
            $row = $this->db->single();

            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }  
    

        }



}