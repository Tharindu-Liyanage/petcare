<?php

    class DoctorModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }


       public function getCurrentAppointmentDB($time){

        $this->db->query(
            'SELECT * 
            FROM petcare_appointments
            JOIN petcare_pet pet ON petcare_appointments.pet_id = pet.id
            WHERE appointment_date = CURDATE()
            AND STR_TO_DATE(appointment_time, "%h:%i %p") <= CURTIME()
            AND ADDTIME(STR_TO_DATE(appointment_time, "%h:%i %p"), :time) > CURTIME()
            AND status = "Confirmed"
            AND vet_id = :vet_id
            ORDER BY appointment_date, STR_TO_DATE(appointment_time, "%h:%i %p")
            LIMIT 1'
        
        );

        $this->db->bind(':time', $time);
        $this->db->bind(':vet_id', $_SESSION['user_id']);

        $row = $this->db->single();

        //check row count

        if($this->db->rowCount() > 0 ){
            return $row;
        }else{
            return null;
        }

       }


       public function getTodayAppointment(){

        $this->db->query(
            'SELECT * 
            FROM petcare_appointments
            JOIN petcare_pet pet ON petcare_appointments.pet_id = pet.id
            JOIN petcare_petowner petowner ON petcare_appointments.petowner_id = petowner.id
            WHERE appointment_date = CURDATE()
            AND status = "Confirmed"
            AND vet_id = :vet_id
            ORDER BY appointment_date, STR_TO_DATE(appointment_time, "%h:%i %p")'
        
        );

        $this->db->bind(':vet_id', $_SESSION['user_id']);

        $row = $this->db->resultSet();

        //check row count

        if($this->db->rowCount() > 0 ){
            return $row;
        }else{
            return null;
        }
       }


         public function getAppointmentByVetID(){
    
          $this->db->query(
                'SELECT a.*, a.id as appointmentID, p.pet as pet_name, p.profileImage as propic , p.species as pet_species , po.first_name as fname , po.last_name as lname , po.profileImage as vetpic , po.id as poid, p.id as petid
                FROM petcare_appointments a
                JOIN petcare_pet p ON a.pet_id = p.id
                JOIN petcare_petowner po ON a.petowner_id = po.id
                WHERE vet_id = :vet_id
                AND appointment_date <= CURDATE()
                ORDER BY appointment_date DESC, appointment_time ASC'
          
          );
    
         
          $this->db->bind(':vet_id', $_SESSION['user_id']);
    
          $row = $this->db->resultSet();
    
          //check row count
    
          if($this->db->rowCount() > 0 ){
                return $row;
          }else{
                return null;
          }
    
         }

         //get all the treatment details by pet id
            public function getTreatmentDetailsByPetID($pet_id){
                 
                $this->db->query(
    
                    'SELECT report.* , pet.profileImage as petpic , pet.pet as petname , staff.profileImage as vetpic , staff.firstname as vetfname , staff.lastname as vetlname
                    FROM petcare_medical_reports report
                    JOIN petcare_pet pet ON report.pet_id = pet.id
                    JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                    WHERE (report.treatment_id, report.visit_date) IN (
                        SELECT treatment_id, MAX(visit_date) AS max_visit_date
                        FROM petcare_medical_reports
                        GROUP BY treatment_id
                    ) AND report.pet_id = :id AND report.status = "Ongoing"  -- Added condition for owner_id in the main query
                    ORDER BY report.visit_date DESC
                    ');
    
                    $this->db->bind(':id' , $pet_id);
                            
    
                    $results = $this->db->resultSet();
    
                    
                //check row count
        
                if($this->db->rowCount() > 0 ){
                    return $results;
                }else{
                    return null;
                }
            }

            public function getClosedTreatmentDetailsByPetID($pet_id){
                 
                $this->db->query(
    
                    'SELECT report.* , pet.profileImage as petpic , pet.pet as petname , staff.profileImage as vetpic , staff.firstname as vetfname , staff.lastname as vetlname
                    FROM petcare_medical_reports report
                    JOIN petcare_pet pet ON report.pet_id = pet.id
                    JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                    WHERE (report.treatment_id, report.visit_date) IN (
                        SELECT treatment_id, MAX(visit_date) AS max_visit_date
                        FROM petcare_medical_reports
                        GROUP BY treatment_id
                    ) AND report.pet_id = :id AND report.status = "Closed"  -- Added condition for owner_id in the main query
                    ORDER BY report.visit_date DESC
                    ');
    
                    $this->db->bind(':id' , $pet_id);
                            
    
                    $results = $this->db->resultSet();
    
                    
                //check row count
        
                if($this->db->rowCount() > 0 ){
                    return $results;
                }else{
                    return null;
                }
            }

            //get ward treatment details by pet id from petcare_ward_medical_reports
            public function getWardTreatmentDetailsByPetID($pet_id){
                 
                $this->db->query(
    
                    'SELECT report.* , pet.profileImage as petpic , pet.pet as petname , staff.profileImage as vetpic , staff.firstname as vetfname , staff.lastname as vetlname
                    FROM petcare_ward_medical_reports report
                    JOIN petcare_pet pet ON report.pet_id = pet.id
                    JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                    WHERE (report.treatment_id, report.lastupdate) IN (
                        SELECT treatment_id, MAX(lastupdate) AS max_visit_date
                        FROM petcare_ward_medical_reports
                        GROUP BY treatment_id
                    ) AND report.pet_id = :id   -- Added condition for owner_id in the main query
                    ORDER BY report.lastupdate DESC
                    ');
    
                    $this->db->bind(':id' , $pet_id);
                            
    
                    $results = $this->db->resultSet();
    
                    
                //check row count
        
                if($this->db->rowCount() > 0 ){
                    return $results;
                }else{
                    return null;
                }
            }



            public function getTreatmentDetailsByTreatmentID($id){

              
    
                $this->db->query(
    
                    'SELECT report.* , pet.pet as petname , pet.pet_id_generate as genIdPet, pet.sex as petsex, pet.*, staff.firstname as vetfname , staff.lastname as vetlname , petowner.petowner_id_generate as genIdPetOwner , petowner.address as petowneraddress ,petowner.email as petowneremail , petowner.mobile as petownerphone, petowner.first_name as petownerfname, petowner.last_name as petownerlname
                    FROM petcare_medical_reports report
                    JOIN petcare_pet pet ON report.pet_id = pet.id
                    JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                    JOIN petcare_petowner petowner ON report.owner_id = petowner.id
                    WHERE report.treatment_id = :id 
                    ORDER BY report.visit_date DESC
                    ');
    
                    $this->db->bind(':id' , $id);
                
                            
    
                    $results = $this->db->resultSet();
    
                    return $results;
            }

            public function getWardTreatmentDetailsByTreatmentID($id){

              
    
                $this->db->query(
    
                    'SELECT report.* , pet.pet as petname , pet.pet_id_generate as genIdPet, pet.sex as petsex, pet.*, staff.firstname as vetfname , staff.lastname as vetlname , petowner.petowner_id_generate as genIdPetOwner , petowner.address as petowneraddress ,petowner.email as petowneremail , petowner.mobile as petownerphone, petowner.first_name as petownerfname, petowner.last_name as petownerlname
                    FROM petcare_ward_medical_reports report
                    JOIN petcare_pet pet ON report.pet_id = pet.id
                    JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                    JOIN petcare_petowner petowner ON report.owner_id = petowner.id
                    WHERE report.treatment_id = :id 
                    ORDER BY report.lastupdate DESC
                    ');
    
                    $this->db->bind(':id' , $id);
                
                            
    
                    $results = $this->db->resultSet();
    
                    return $results;
            }

            public function getLatestTreatmentID($pet_id){
                 
                $this->db->query(
    
                    'SELECT treatment_id,appointment_type
                    FROM petcare_appointments
                    WHERE pet_id = :id AND status = "Confirmed"
                    ORDER BY appointment_date DESC
                    LIMIT 1
                    ');
    
                    $this->db->bind(':id' , $pet_id);
                            
    
                    $results = $this->db->single();
    
                    
                //check row count
        
                if($this->db->rowCount() > 0 ){
                    return $results;
                }else{
                    return null;
                }
            }

            public function getPetDetailsByPetID($pet_id){
                     
                    $this->db->query(
        
                        'SELECT pet.*, pet.id as petid, petowner.id as poid ,  petowner.petowner_id_generate as petownerid , petowner.first_name as petownerfname , petowner.last_name as petownerlname, petowner.email as petowneremail, petowner.mobile as petownerphone 
                        FROM petcare_pet pet
                        JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id
                        WHERE pet.id = :id
                        ');
        
                        $this->db->bind(':id' , $pet_id);
                                
        
                        $results = $this->db->single();
        
                        
                    //check row count
            
                    if($this->db->rowCount() > 0 ){
                        return $results;
                    }else{
                        return null;
                    }

            }

            public function addTreatment($data){

                //get petowner id by petid
                $petDetails=$this->getPetDetailsByPetID($data['pet_id']);
                $petowner_id = $petDetails->poid;

                if($data['date'] != NULL && $data['trtID'] == "new"){
                    //insert new treatment to with petid to petcare_treatment table and get the treatment id
                    $this->db->query('INSERT INTO petcare_treatment (pet_id) VALUES (:pet_id)');
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $this->db->execute();

                    $this->db->query('SELECT treatment_id FROM petcare_treatment WHERE pet_id = :pet_id ORDER BY treatment_id DESC LIMIT 1');
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $row = $this->db->single();
                    $data['trtID'] = $row->treatment_id;

                    //appointment table treatment id null update to new treatment id
                    $this->db->query('UPDATE petcare_appointments SET treatment_id = :treatment_id WHERE pet_id = :pet_id AND treatment_id IS NULL LIMIT 1');
                    $this->db->bind(':treatment_id', $data['trtID']);
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $this->db->execute();
                    

                    //now insert into petcare_medical_reports table
                    $this->db->query('INSERT INTO petcare_medical_reports (treatment_id, pet_id, owner_id, veterinarian_id, visit_date, status, diagnosis, treatment_plan, prescription, physical_examination,followup_date,followup_reason,instruction) VALUES (:treatment_id, :pet_id, :owner_id, :veterinarian_id, :visit_date, :status, :diagnosis, :treatment_plan, :prescription, :physical_examination,:followup_date,:followup_reason,:instruction)');
                    // Bind values
                    $this->db->bind(':treatment_id', $data['trtID']);
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $this->db->bind(':owner_id',$petowner_id);
                    $this->db->bind(':veterinarian_id', $_SESSION['user_id']);
                    $this->db->bind(':visit_date', $data['visit_date']);
                    $this->db->bind(':status', $data['status']);
                    $this->db->bind(':diagnosis', $data['diagnosis']);
                    $this->db->bind(':treatment_plan', $data['treatment_plan']);
                    $this->db->bind(':prescription', $data['prescription']);
                    $this->db->bind(':physical_examination', $data['examination']);
                    $this->db->bind(':followup_date', $data['date']);
                    $this->db->bind(':followup_reason', $data['follow-up-reason']);
                    $this->db->bind(':instruction', $data['instructions']);

                }else if($data['date'] == NULL && $data['trtID'] == "new"){

                    //insert new treatment to with petid to petcare_treatment table and get the treatment id
                    $this->db->query('INSERT INTO petcare_treatment (pet_id) VALUES (:pet_id)');
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $this->db->execute();

                    $this->db->query('SELECT treatment_id FROM petcare_treatment WHERE pet_id = :pet_id ORDER BY treatment_id DESC LIMIT 1');
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $row = $this->db->single();
                    $data['trtID'] = $row->treatment_id;

                    //appointment table treatment id null update to new treatment id
                    $this->db->query('UPDATE petcare_appointments SET treatment_id = :treatment_id WHERE pet_id = :pet_id AND treatment_id IS NULL LIMIT 1');
                    $this->db->bind(':treatment_id', $data['trtID']);
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $this->db->execute();

                    //now insert into petcare_medical_reports table
                    $this->db->query('INSERT INTO petcare_medical_reports (treatment_id, pet_id, owner_id, veterinarian_id, status, diagnosis, treatment_plan, prescription, physical_examination,instruction,visit_date) VALUES (:treatment_id, :pet_id, :owner_id, :veterinarian_id, :status, :diagnosis, :treatment_plan, :prescription, :physical_examination,:instruction,:visit_date)');
                    // Bind values
                    $this->db->bind(':treatment_id', $data['trtID']);
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $this->db->bind(':owner_id',$petowner_id);
                    $this->db->bind(':veterinarian_id', $_SESSION['user_id']);
                    $this->db->bind(':status', $data['status']);
                    $this->db->bind(':diagnosis', $data['diagnosis']);
                    $this->db->bind(':treatment_plan', $data['treatment_plan']);
                    $this->db->bind(':prescription', $data['prescription']);
                    $this->db->bind(':physical_examination', $data['examination']);
                    $this->db->bind(':instruction', $data['instructions']);
                    $this->db->bind(':visit_date', $data['visit_date']);


                }else if($data['date'] != NULL ){
                    
                    $this->db->query('INSERT INTO petcare_medical_reports (treatment_id, pet_id, owner_id, veterinarian_id, visit_date, status, diagnosis, treatment_plan, prescription, physical_examination,followup_date,followup_reason,instruction) VALUES (:treatment_id, :pet_id, :owner_id, :veterinarian_id, :visit_date, :status, :diagnosis, :treatment_plan, :prescription, :physical_examination,:followup_date,:followup_reason,:instruction)');

                    // Bind values
                    $this->db->bind(':treatment_id', $data['trtID']);
                    $this->db->bind(':pet_id', $data['pet_id']);
                    $this->db->bind(':owner_id',$petowner_id);
                    $this->db->bind(':veterinarian_id', $_SESSION['user_id']);
                    $this->db->bind(':visit_date', $data['visit_date']);
                    $this->db->bind(':status', $data['status']);
                    $this->db->bind(':diagnosis', $data['diagnosis']);
                    $this->db->bind(':treatment_plan', $data['treatment_plan']);
                    $this->db->bind(':prescription', $data['prescription']);
                    $this->db->bind(':physical_examination', $data['examination']);
                    $this->db->bind(':followup_date', $data['date']);
                    $this->db->bind(':followup_reason', $data['follow-up-reason']);
                    $this->db->bind(':instruction', $data['instructions']);

             
                    }else{
                        $this->db->query('INSERT INTO petcare_medical_reports (treatment_id, pet_id, owner_id, veterinarian_id, status, diagnosis, treatment_plan, prescription, physical_examination,followup_reason,instruction,visit_date) VALUES (:treatment_id, :pet_id, :owner_id, :veterinarian_id, :status, :diagnosis, :treatment_plan, :prescription, :physical_examination,:followup_reason,:instruction,:visit_date)');

                        // Bind values
                        $this->db->bind(':treatment_id', $data['trtID']);
                        $this->db->bind(':pet_id', $data['pet_id']);
                        $this->db->bind(':owner_id',$petowner_id);
                        $this->db->bind(':veterinarian_id', $_SESSION['user_id']);
                        $this->db->bind(':status', $data['status']);
                        $this->db->bind(':diagnosis', $data['diagnosis']);
                        $this->db->bind(':treatment_plan', $data['treatment_plan']);
                        $this->db->bind(':prescription', $data['prescription']);
                        $this->db->bind(':physical_examination', $data['examination']);
                        $this->db->bind(':followup_reason', $data['follow-up-reason']);
                        $this->db->bind(':instruction', $data['instructions']);
                        $this->db->bind(':visit_date', $data['visit_date']);

                    }

                    // Execute
                    if($this->db->execute()){
                        return true;
                    } else {
                        return false;
                    }

            }


            public function addWardTreatment($data){
                    
                    //get petowner id by petid
                    $petDetails=$this->getPetDetailsByPetID($data['pet_id']);
                    $petowner_id = $petDetails->poid;

                    if($data['trtID'] == 'new'){

                        //insert new treatment to with petid to petcare_treatment table and get the treatment id
                        $this->db->query('INSERT INTO petcare_ward_treatment (pet_id) VALUES (:pet_id)');
                        $this->db->bind(':pet_id', $data['pet_id']);
                        $this->db->execute();

                        $this->db->query('SELECT ward_treatment_id FROM petcare_ward_treatment WHERE pet_id = :pet_id ORDER BY ward_treatment_id DESC LIMIT 1');
                        $this->db->bind(':pet_id', $data['pet_id']);
                        $row = $this->db->single();
                        $data['trtID'] = $row->ward_treatment_id;

                    }

                    if($data['status'] =='Discharge'){

                        $today = date("Y-m-d");
                        //update cage status to available and |remove from inward pet add discharge date
                        $this->db->query('UPDATE petcare_cage_status SET status = "available" WHERE id = (SELECT cage_no FROM petcare_inward_pet WHERE pet_id = :id AND status = "Admitted" LIMIT 1)');
                        $this->db->bind(':id', $data['pet_id']);
                        $this->db->execute();

                        $this->db->query('UPDATE petcare_inward_pet SET status = "Discharged" , discharge_date= :date WHERE pet_id = :pet_id');
                        $this->db->bind(':pet_id', $data['pet_id']);
                        $this->db->bind(':date',$today);
                        $this->db->execute();

                        $this->db->query('UPDATE petcare_ward_treatment SET payment_status = "Processing" WHERE pet_id = :id AND payment_status IS NULL');
                        $this->db->bind(':id', $data['pet_id']);
                        $this->db->execute();

                    }
    
                    $this->db->query('INSERT INTO petcare_ward_medical_reports (treatment_id, pet_id, owner_id, veterinarian_id, status, diagnosis, treatment_plan, prescription, physical_examination,instruction) VALUES (:treatment_id, :pet_id, :owner_id, :veterinarian_id, :status, :diagnosis, :treatment_plan, :prescription, :physical_examination,:instruction)');
                    
                    // Bind values
                        $this->db->bind(':treatment_id', $data['trtID']);
                        $this->db->bind(':pet_id', $data['pet_id']);
                        $this->db->bind(':owner_id',$petowner_id);
                        $this->db->bind(':veterinarian_id', $_SESSION['user_id']);
                        $this->db->bind(':status', $data['status']);
                        $this->db->bind(':diagnosis', $data['diagnosis']);
                        $this->db->bind(':treatment_plan', $data['treatment_plan']);
                        $this->db->bind(':prescription', $data['prescription']);
                        $this->db->bind(':physical_examination', $data['examination']);
                        $this->db->bind(':instruction', $data['instructions']);
                    
    
                    // Execute
                    if($this->db->execute()){
                        return true;
                    } else {
                        return false;
                    }
            }

            //get all petdetails not removed pet owner and pet
            public function getAllPetDetails(){
                $this->db->query(
                    'SELECT pet.*,pet.profileImage as petpic,pet.id as petid, petowner.id as poid ,  petowner.petowner_id_generate as petownerid , petowner.first_name as petownerfname , petowner.last_name as petownerlname ,petowner.profileImage as petownerpic
                    FROM petcare_pet pet
                    JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id
                    WHERE petowner.isRemoved = 0 AND pet.isRemoved = 0
                    ');
    
                    $results = $this->db->resultSet();
    
                    return $results;
            }

            public function getTreatmentDetailsByVetID(){
                 
                $this->db->query(
    
                    'SELECT report.* , pet.profileImage as petpic , pet.pet as petname , pet.species as petspecies , staff.profileImage as vetpic , staff.firstname as vetfname , staff.lastname as vetlname
                    FROM petcare_medical_reports report
                    JOIN petcare_pet pet ON report.pet_id = pet.id
                    JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                    WHERE (report.treatment_id, report.visit_date) IN (
                        SELECT treatment_id, MAX(visit_date) AS max_visit_date
                        FROM petcare_medical_reports
                        GROUP BY treatment_id
                    )  AND report.veterinarian_id = :id  -- Added condition for owner_id in the main query
                    ORDER BY report.visit_date DESC
                    ');
    
                    $this->db->bind(':id' , $_SESSION['user_id']);
                            
    
                    $results = $this->db->resultSet();
    
                    
                //check row count
        
                if($this->db->rowCount() > 0 ){
                    return $results;
                }else{
                    return null;
                }
            }


            public function getBlogCategoryDetails(){
                //get all from petcare_products_category
                $this->db->query(
                    'SELECT *
                     FROM petcare_blogs_category
                    '
                );

                $results = $this->db->resultSet();

                return $results;


            }


            public function getAvailableCages(){
                
                $this->db->query(
                    'SELECT *
                     FROM petcare_cage_status
                     WHERE status = "available" AND isRemoved = 0
                     LIMIT 1
                    '
                );

                $row = $this->db->single();

                if($this->db->rowCount() > 0){
                    return $row;
                }else
                {
                    return null;
                }
                

            }

            public function getCageCountAll(){
                $this->db->query(
                    'SELECT *
                     FROM petcare_cage_status
                     WHERE isRemoved = 0
                    '
                );

                $row = $this->db->resultSet();

                if($this->db->rowCount() > 0){
                    return $row;
                }else
                {
                    return 0;
                }
            }

            public function addmitPetToWard($data){
                //get petowner id by petid
                $petDetails=$this->getPetDetailsByPetID($data['petid']);
                $petowner_id = $petDetails->poid;

                //get cage id availble
                $cageDetails=$this->getAvailableCages();

                

                if($cageDetails == null){
                    $_SESSION['notification'] = 'error';
                    redirect('doctor/pet');

                }else if($this->checkAdmitAlready($data['petid'])){

                    $_SESSION['notification'] = 'error';
                        redirect('doctor/pet');

                }else{

                    $this->db->query('INSERT INTO petcare_inward_pet (pet_id, owner_id, cage_no, admit_date, status, reason) VALUES (:pet_id, :owner_id, :cage_id, :admission_date, :status, :reason)');

                $today = date("Y-m-d");
                // Bind values
                $this->db->bind(':pet_id', $data['petid']);
                $this->db->bind(':owner_id',$petowner_id);
                $this->db->bind(':cage_id', $cageDetails->id);
                $this->db->bind(':admission_date', $today);
                $this->db->bind(':status', "Admitted");
                $this->db->bind(':reason', $data['reason']);

                // Execute
                if($this->db->execute()){

                    //die("available cageID ->" . $cageDetails->id);

                    //update cage status to occupied
                    $this->updateCageStatus($cageDetails->id);

                    $_SESSION['notification'] = 'ok';


                    return true;

                } else {

                    return false;
                }



                }
                

                
            }


            //update cage status to occupied
            public function updateCageStatus($cage_id){
                $this->db->query('UPDATE petcare_cage_status SET status = "occupied" WHERE id = :id');
                $this->db->bind(':id', $cage_id);
                try {
                    $this->db->execute();
                    // Optionally, you can log success here
                } catch (PDOException $e) {
                    // Log or handle the error
                    error_log('Error updating cage status: ' . $e->getMessage());
                    // Optionally, you can re-throw the exception
                    throw $e;
                }
            }
            


            //get animal ward details

            public function getAnimalWardDetails(){
                $this->db->query(
                    'SELECT inward.*, pet.id as petID, pet.pet as petname, pet.profileImage as petpic, pet.pet_id_generate as petid, petowner.first_name as petownerfname, petowner.last_name as petownerlname, petowner.profileImage as petownerpic
                     FROM petcare_inward_pet inward
                     JOIN petcare_pet pet ON inward.pet_id = pet.id
                     JOIN petcare_petowner petowner ON inward.owner_id = petowner.id
                     WHERE inward.status = "Admitted"
                    '
                );

                $results = $this->db->resultSet();

                return $results;
            }

            public function getDischargePets(){
                $this->db->query(
                    'SELECT inward.*, pet.id as petID, pet.pet as petname, pet.profileImage as petpic, pet.pet_id_generate as petid, petowner.first_name as petownerfname, petowner.last_name as petownerlname, petowner.profileImage as petownerpic
                     FROM petcare_inward_pet inward
                     JOIN petcare_pet pet ON inward.pet_id = pet.id
                     JOIN petcare_petowner petowner ON inward.owner_id = petowner.id
                     WHERE inward.status = "Discharged"
                    '
                );

                $results = $this->db->resultSet();

                return $results;
            }

            //check animal wward admit already

            public function checkAdmitAlready($petid){
                $this->db->query(
                    'SELECT *
                     FROM petcare_inward_pet
                     WHERE pet_id = :petid AND status = "Admitted" 
                    '
                );

                $this->db->bind(':petid', $petid);

                $results = $this->db->single();

                 //check row count
        
                 if($this->db->rowCount() > 0 ){
                    return true;
                }else{
                    return false;
                }


            }

            


        

    }