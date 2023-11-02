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

         //get pet owner details

         public function getPetwonerDetails(){
            $this->db->query('SELECT * FROM petcare_petowner');
        

            $results = $this->db->resultSet(); 

            return $results;
    

        }

         //get  inventory details

         public function getInventoryDetails(){
            $this->db->query('SELECT * FROM petcare_inventory');
        

            $results = $this->db->resultSet(); 

            return $results;
    

        }

         //remove product

         public function removeProduct($id){

            $this->db->query('DELETE  FROM petcare_inventory WHERE id = :id');
            $this->db->bind(':id' , $id);
            
            $row = $this->db->single();

            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }  
    

        }

        // add product data

        public function addProduct($data){

            $this->db->query('INSERT INTO petcare_inventory (name,brand,category,stock,price) VALUES(:name, :brand, :category, :stock, :price )');

             //bind values
        $this->db->bind(':name',$data['pname']);
        $this->db->bind(':brand',$data['brand']);
        $this->db->bind(':category',$data['category']);
        $this->db->bind(':stock',$data['stock']);
        $this->db->bind(':price',$data['price']);
        

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }  

        }


        // get product data

        public function getProductDetailsById($id){

            $this->db->query('SELECT * FROM petcare_inventory WHERE id = :id');
        

            $this->db->bind(':id' , $id);
    
            $row = $this->db->single();
    
            //return row
    
            return $row;


        }

         // update product data

         public function updateProduct($data){

            $this->db->query('UPDATE petcare_inventory SET name = :pname , brand = :brand , category= :category, stock = :stock , price = :price   WHERE id = :id');
        

            $this->db->bind(':id' , $data['id']);
            $this->db->bind(':pname',$data['pname']);
            $this->db->bind(':brand',$data['brand']);
            $this->db->bind(':category',$data['category']);
            $this->db->bind(':stock',$data['stock']);
            $this->db->bind(':price',$data['price']);

    
                //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }


        }


        //get pet details 

        public function getPetDetails(){

            $this->db->query('SELECT * FROM petcare_pet');
        

            
    
            $results = $this->db->resultSet();
    
            //return row
    
            return $results;

        }

        //add pet details 

        public function addPetDetails($data){

            $this->db->query('INSERT INTO petcare_pet (pet,DOB,breed,sex,age,species) VALUES(:pet, :DOB, :breed, :sex, :age ,:species)');

             //bind values
            $this->db->bind(':pet',$data['pname']);
            $this->db->bind(':DOB',$data['dob']);
            $this->db->bind(':breed',$data['breed']);
            $this->db->bind(':sex',$data['sex']);
            $this->db->bind(':species',$data['species']);
            $this->db->bind(':age',$data['age']);
        

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }
            

        }


        //update pet details 

        public function updatePetDetails($data){

            $this->db->query('UPDATE petcare_pet SET pet = :pname , DOB = :DOB , breed= :breed, sex = :sex , species = :species , age = :age   WHERE id = :id');
        

           //bind values
           $this->db->bind(':id' , $data['id']);
           $this->db->bind(':pname',$data['pname']);
           $this->db->bind(':DOB',$data['dob']);
           $this->db->bind(':breed',$data['breed']);
           $this->db->bind(':sex',$data['sex']);
           $this->db->bind(':species',$data['species']);
           $this->db->bind(':age',$data['age']);

    
                //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }
            

        }

        //remove pet details 

        public function removePetDetails($id){

            $this->db->query('DELETE  FROM petcare_pet WHERE id = :id');
            $this->db->bind(':id' , $id);
            
            $row = $this->db->single();

            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }  
            

        }

        public function getPetDetailsByID($id){

            $this->db->query('SELECT * FROM petcare_pet WHERE id = :id');
        

            $this->db->bind(':id' , $id);
    
            $row = $this->db->single();
    
            //return row
    
            return $row;
        }




}