<?php
    class NurseModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getDischargeDetails(){
            //from inward_pet table
            $this->db->query('SELECT ward.* , pet.pet_id_generate as genPetID,petowner.id as poid, petowner.petowner_id_generate as genPetOwnerID ,  pet.pet as petname, pet.profileImage as petpic, petowner.profileImage as petownerpic, petowner.first_name as petownerfname, petowner.last_name as petownerlname
                              FROM petcare_ward_treatment ward
                              JOIN petcare_pet pet ON ward.pet_id = pet.id
                              JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id
                             -- WHERE ward.payment_status = "Processing"
                               
                           ');
            $results = $this->db->resultSet();
            return $results;
            
        }

      public function  getAddmitDischargeDate($trtID){

        $this->db->query('SELECT ward.discharge_date ,ward.admit_date, pet.pet as petname, pet.pet_id_generate as genPetID,petowner.first_name as petownerfname, petowner.last_name as petownerlname , petowner.petowner_id_generate as genPetOwnerID
                          FROM petcare_ward_treatment trt
                          JOIN petcare_inward_pet ward ON ward.pet_id = trt.pet_id
                          JOIN petcare_pet pet ON ward.pet_id = pet.id
                          JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id
                          WHERE trt.ward_treatment_id = :id
                          ORDER BY ward.discharge_date DESC
                          LIMIT 1;');

        $this->db->bind(':id', $trtID);
        $row = $this->db->single();
        return $row;
      }


      public function prepareMedicalBill($data){

        $query = 'INSERT INTO petcare_ward_medical_bill (ward_treatment_id, service, price) VALUES ';

        // Without binding
        foreach($data['services'] as $index => $service){
            // Assuming $data['service'] and $data['price'] are arrays
            $query .= "('".$data['trtID']."','".$data['services'][$index]."', '".$data['prices'][$index]."'),";
        }

        // Remove the last comma
        $query = rtrim($query, ',');

        // Execute the query
        $this->db->query($query);
        $this->db->execute();



        $this->db->query('UPDATE petcare_ward_treatment
                          SET payment_status = "Pending"
                          WHERE ward_treatment_id = :id');
        $this->db->bind(':id', $data['trtID']);
        if($this->db->execute()){
          return true;
        }else{
          return false;
        }
      }

        
}