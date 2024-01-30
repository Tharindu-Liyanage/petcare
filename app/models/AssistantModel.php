<?php

    class AssistantModel{
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


         public function getAppointmentByVetID(){
    
          $this->db->query(
                'SELECT a.*, p.pet as pet_name, p.profileImage as propic , p.species as pet_species , po.first_name as fname , po.last_name as lname , po.profileImage as vetpic
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

            

        

    }