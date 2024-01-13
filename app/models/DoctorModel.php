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
        

    }