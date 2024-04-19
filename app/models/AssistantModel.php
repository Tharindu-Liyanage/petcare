<!-- ========================================================================================================== -->
<?php

    class AssistantModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

//---------------------------------------------------------------------------        

    public function getPetownerDetails(){
    $this->db->query('SELECT * FROM petcare_petowner WHERE isRemoved = 0');

            $results = $this->db->resultSet();
            return $results;
 }
 //--------------------------------------------------------------------------

 public function getPetDetails(){
    $this ->db -> query ('SELECT pet.* , petowner.* , pet.profileImage as petImage , petowner.profileImage as petownerImage
                          FROM petcare_pet pet
                          JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id
                          WHERE pet.isRemoved = 0 AND petowner.isRemoved = 0
                          ');

         $results = $this->db->resultSet();
         return $results;
 }
//-----------------------------------------------------------------------------------

 public function getPetownerMobileEmailByID($petownerID){


    $this ->db->query('SELECT * FROM petcare_petowner WHERE id = :petownerID ');

    $this->db->bind(':petownerID' , $petownerID);

    $row = $this->db->single();

    return $row;


 }


 //-------------------------------------------------------------------------------------
 public function getPetDetailsByID($id){


    $this ->db->query('SELECT * FROM petcare_pet WHERE id = :id ');

    $this->db->bind(':petID' , $id);

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


        //Update Petowner----------------------------------------------------------------------------------------------------------------------------------------
      public function updatePetowner($data){
        $this->db->query('UPDATE petcare_petowner SET mobile = :mobile , email =:email  WHERE id = :id');
        //bind values
        $this->db->bind(':id' , $data['id']);
        $this->db->bind(':mobile',$data['mobile']);
        $this->db->bind(':email',$data['email']);
        
        
                  //execute
                  if($this->db->execute()){
                      return true;
      
                  }else{
                      return false;
                  }
        }
// ------------------------------------------------
      public function getAppointmentDetails(){
      $this->db->query('SELECT 
      petcare_appointments.*, 
      petcare_pet.profileImage AS petpic, 
      petcare_pet.pet AS petname, 
      petcare_petowner.profileImage AS petownerpic, 
      petcare_petowner.first_name AS petownerfname, 
      petcare_petowner.last_name AS petownerlname,
      petcare_pet.species AS species
      FROM 
        petcare_appointments
      JOIN 
        petcare_pet ON petcare_appointments.pet_id = petcare_pet.id
      JOIN 
        petcare_petowner ON petcare_appointments.petowner_id = petcare_petowner.id
      WHERE 
        petcare_appointments.status != "Completed" ORDER BY 
        CASE WHEN petcare_appointments.status = "Pending" THEN 0 ELSE 1 END , petcare_appointments.appointment_date ASC ,  petcare_appointments.appointment_time ASC ' );
    
      $results = $this->db->resultSet();
      return $results;
                            
     }

     public function updateAppointmentStatusToConfirm($appoitmentID){
       $this ->db -> query ('UPDATE petcare_appointments   SET status = "Confirmed"  WHERE id=:appointmentID');
       $this->db->bind(':appointmentID' ,$appoitmentID );

       
                //execute
                if($this->db->execute()){
                    return true;
    
                }else{
                    return false;
                }
     }

     public function updateAppointmentStatusToReject($appoitmentID){
        $this ->db -> query ('UPDATE petcare_appointments   SET status = "Rejected"  WHERE id=:appointmentID');
        $this->db->bind(':appointmentID' ,$appoitmentID );

         //execute
         if($this->db->execute()){
            return true;

        }else{
            return false;
        }
    }
      
                
                

    }