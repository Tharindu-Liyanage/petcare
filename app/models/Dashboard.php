<?php

    class Dashboard {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        /*
        ====================  Dashboard Model =============== 
        
          ** All database business with DASHBOARD here
          ** Return data goes to particular actor controller (app/controller/actor/method) called method
        
        =====================================================
        */



        /*
         ============================= For Admin  =======================================

        1. getStaffDetails  ->  get Staff details without own details. 

        2. addStaff -> insert staff data

        3. updateStaff -> update staff details

        4. getStaffUserById -> id given as parameter to this method and return the row

        5. removeStaffUser ->  id given as parameter to this method and remove user

        6. getPetwonerDetails ->  get pet owner details and return results

        ================================================================================
        
        */



        /*1*/

        public function getStaffDetails(){
            
            $userID = $_SESSION['user_id'];
            $this->db->query("SELECT * FROM petcare_staff WHERE staff_id != :userID");
            $this->db->bind(':userID', $userID);

            $results = $this->db->resultSet();

            return $results;
        }


        //2
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



        //3

        public function updateStaff($data){

            $this->db->query('UPDATE petcare_staff SET firstname = :first_name , lastname = :last_name , email= :email, role = :role , address = :address , phone = :mobile  WHERE staff_id = :id');

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



         //4 

         public function getStaffUserById($id){
            $this->db->query('SELECT * FROM petcare_staff WHERE staff_id = :id');
            $this->db->bind(':id' , $id);
    
            $row = $this->db->single();
    
            //return row
    
            return $row;
    
        }


        //5

        public function removeStaffUser($id){
            $this->db->query('DELETE  FROM petcare_staff WHERE staff_id = :id');
            $this->db->bind(':id' , $id);
            
            $row = $this->db->single();

            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }  
    

        }

        
        //6

         public function getPetwonerDetails(){
            $this->db->query('SELECT * FROM petcare_petowner');
        

            $results = $this->db->resultSet(); 

            return $results;
    

        }

        // ============================  Admin over ===========================================





         /*
         ============================= For Store Manager =======================================

        7. getInventoryDetails  ->  get all inventory details 

        8. removeProduct -> id given as parameter to this method and remove product

        9. addProduct -> insert product details

        10. getProductDetailsById -> id given as parameter to this method and return the product details row

        11. updateProduct ->  id given as parameter to this method and update the product

        ================================================================================
        
        */



         //7

         public function getInventoryDetails(){
            $this->db->query('SELECT * FROM petcare_inventory');
        

            $results = $this->db->resultSet(); 

            return $results;
    

        }

         
        //8

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

       
        // 9

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


        //10

        public function getProductDetailsById($id){

            $this->db->query('SELECT * FROM petcare_inventory WHERE id = :id');
        

            $this->db->bind(':id' , $id);
    
            $row = $this->db->single();
    
            //return row
    
            return $row;


        }

         // 11

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


          // ============================  Store Manager over ===========================================





         /*
         ============================= For Pet Owner =======================================

        12. getPetDetails ->  get pet owner details and return results

        13. addPetDetails ->  insert pet details

        14. updatePetDetails ->  update pet details

        15. removePetDetails -> remove pet details by paramenter id

        16. getPetDetailsByID -> get petdetauls by parameter id
        
        17. getAppointmentDetailsByPetOwner -> 

        18. getPetDetails

        ================================================================================
        
        */


        //12

        public function getAllPetDetails(){

            $this->db->query('SELECT * FROM petcare_pet');
        

            
    
            $results = $this->db->resultSet();
    
            //return row
    
            return $results;

        }

       
        //13 

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


        //14

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

        //15

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

        //16

        public function getPetDetailsByID($id){

            $this->db->query('SELECT * FROM petcare_pet WHERE id = :id');
        

            $this->db->bind(':id' , $id);
    
            $row = $this->db->single();
    
            //return row
    
            return $row;
        }


        //17
       public function getAppointmentDetailsByPetOwner($id){

            $this->db->query(

                'SELECT a.*, p.pet as pet_name, p.profileImage as propic , p.species as pet_species , staff.firstname as fname , staff.lastname as lname , staff.profileImage as vetpic
                FROM petcare_appointments a
                JOIN petcare_pet p ON a.pet_id = p.id
                JOIN petcare_staff staff ON a.vet_id = staff.staff_id
                WHERE a.petowner_id = :id
                ORDER BY a.appointment_date DESC , a.appointment_time DESC');

            $this->db->bind(':id' , $id);
           

            $results = $this->db->resultSet();

            return $results;
            
        }

        //18

        public function getPetDetailsByPetownerID($id){

            $this->db->query(

                'SELECT pet.*
                FROM petcare_pet pet
                JOIN petcare_petowner po ON pet.petowner_id = po.id
                WHERE petowner_id = :id
                ORDER BY pet.id ASC');

            $this->db->bind(':id' , $id);

            $results = $this->db->resultSet();

            return $results;

        }



}