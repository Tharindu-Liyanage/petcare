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

 public function getPetDetails(){
    $this ->db -> query ('SELECT * FROM petcare_pet WHERE isRemoved = 0');

         $results = $this->db->resultSet();
         return $results;
 }

 public function findEmail($email){


    $this ->db->query('SELECT * FROM petcare_petowner WHERE email = :useremail ');

    $this->db->bind(':useremail' , $email);

    $row = $this->db->single();

    if($row){
        return true;
    }else{
        return false;
    }




 }
 

        public function findMobile($mobile){


            $this ->db->query('SELECT * FROM petcare_petowner WHERE mobile = :usermobile ');

            $this->db->bind(':usermobile' , $mobile);

            $row = $this->db->single();

            if($row){
                return true;
            }else{
                return false;
            }




        }

        public function addPetowner($data){
            $this->db->query('INSERT INTO petcare_petowner (first_name,last_name,address,email,mobile,password) VALUES(:firstname,:lastname,:address,:email,:mobile,:password)');

        
            $this->db->bind(':firstname' , $data['firstname']);
            $this->db->bind(':lastname', $data['lastname']);
            $this->db->bind(':address', $data['address']);
            $this->db->bind(':email', $data['email']);
            $this->db->bind(':mobile', $data['mobile']);
            $this->db->bind(':password', $data['password']);

            //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }


        } 



//add pet--------------------------------------------------------------------------------------------------------------------------------------

        public function addPet($data){
            $this->db->query('INSERT INTO petcare_pet (pet,DOB,species,breed,sex,img) VALUES(:pname,:dob,:species,:breed,:sex,:img)');

        
            $this->db->bind(':pname' , $data['pname']);
            $this->db->bind(':dob', $data['dob']);
            $this->db->bind(':species', $data['species']);
            $this->db->bind(':breed', $data['breed']);
            $this->db->bind(':sex', $data['sex']);
            $this->db->bind(':img', $data['img']);

            
            //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }


        }

      

    }