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
        

    }