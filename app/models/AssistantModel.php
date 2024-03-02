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
    $this ->db -> query ('SELECT pet.* , petowner.* , pet.profileImage as petImage , petowner.profileImage as petownerImage
                          FROM petcare_pet pet
                          JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id
                          WHERE pet.isRemoved = 0 AND petowner.isRemoved = 0
                          ');

         $results = $this->db->resultSet();
         return $results;
 }


 public function getPetownerMobileEmailByID($petownerID){


    $this ->db->query('SELECT * FROM petcare_petowner WHERE id = :petownerID ');

    $this->db->bind(':petownerID' , $petownerID);

    $row = $this->db->single();

    return $row;


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

            if($this->db->rowCount() > 0 ){
                return true;
            }else{
                return false;
            }

           
        }

        // add petowner
        

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

public function findpetownerID($petownerID){


    $this ->db->query('SELECT * FROM petcare_petowner WHERE id = :petownerID ');

    $this->db->bind(':petownerID' , $petownerID);

    $row = $this->db->single();

    if($this->db->rowCount() > 0 ){
        return true;
    }else{
        return false;
    }




 }




       

        public function addPet($data){
            $this->db->query('INSERT INTO petcare_pet (pet,DOB,species,breed,sex,petowner_id) VALUES(:pname,:dob,:species,:breed,:sex,:petownerID)');

        
            $this->db->bind(':pname' , $data['pname']);
            $this->db->bind(':dob', $data['dob']);
            $this->db->bind(':species', $data['species']);
            $this->db->bind(':breed', $data['breed']);
            $this->db->bind(':sex', $data['sex']);
            $this->db->bind(':petownerID', $data['petownerID']);
            
           

            
            //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }


        }


      
/*

for update pet


$this->db->query('UPDATE petcare_pet SET pet = :pname , DOB = :DOB , breed= :breed, sex = :sex , species = :species   WHERE id = :id');
     

           //bind values
           $this->db->bind(':id' , $data['id']);
           $this->db->bind(':pname',$data['pname']);
           $this->db->bind(':DOB',$data['dob']);
           $this->db->bind(':breed',$data['breed']);
           $this->db->bind(':sex',$data['sex']);
           $this->db->bind(':species',$data['species']);

    
                //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }


*/
      




 }




       

     
      

    