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
            $this->db->query("SELECT * FROM petcare_staff WHERE staff_id != :userID AND isRemoved = 0");
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
           
            $this->db->query('UPDATE petcare_staff SET isRemoved = 1 WHERE staff_id = :id');
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

        18. getPetDetailsByPetownerID

        19. getTimeSlots

        20. checkAvailbility  - ajax requst get data

        21. getVetDetails   - get vet details

        22. getHolidayDetails - get holiday details
        
        23. timeSlotLock -  lock the time slot

        24. checkTimeSlotIsLocked - also check the time slot is locked or not

        25. getAppointmentReasons - for add appointment

        26. insertAppointment  - insert appointment details

        27. getVetNameByID  - for add appointment

        28. getPetNameByID  - for add appointment

        29. getGeneratedIDAppointment - for add appointment

        30. getTreatmentDetailsByUserID    - to show Medical reports in the table

        31. getTreatmentDetailsByTreatmentID -  to showMedicaReport details , showMedicalReport/2   2 is report id

        32. getPetCareDetails - for medical report details

        33. getTreatmentDetailsByUserIDOnlyOngoing  - for Addappointment

        34. getPetProfileImageByID - for delete the old pro pic
        

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

            if($data['img'] === NULL) {

                $this->db->query('INSERT INTO petcare_pet (pet,DOB,breed,sex,species,petowner_id) VALUES(:pet, :DOB, :breed, :sex,:species,:petowner_id)');

             //bind values
            $this->db->bind(':pet',$data['pname']);
            $this->db->bind(':DOB',$data['dob']);
            $this->db->bind(':breed',$data['breed']);
            $this->db->bind(':sex',$data['sex']);
            $this->db->bind(':species',$data['species']);
            $this->db->bind(':petowner_id',$_SESSION['user_id']);
        

            //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }
            

            }else{

               //insert data with img
               $this->db->query('INSERT INTO petcare_pet (pet,DOB,breed,sex,species,profileImage,petowner_id) VALUES(:pet, :DOB, :breed, :sex ,:species,:filename,:petowner_id)');
        

                //bind values
                $this->db->bind(':pet',$data['pname']);
                $this->db->bind(':DOB',$data['dob']);
                $this->db->bind(':breed',$data['breed']);
                $this->db->bind(':sex',$data['sex']);
                $this->db->bind(':species',$data['species']);
                $this->db->bind(':filename',$data['uniqueImgFileName']);
                $this->db->bind(':petowner_id',$_SESSION['user_id']);

    
                // Specify the source directory (temporary location)
                $sourceDir = $data['img']['tmp_name'];

                // Specify the destination directory using __DIR__
                $destinationDir = __DIR__ . '/../../public/storage/uploads/animals/';
                // Set the path to move the uploaded file to
                $uploadPath = $destinationDir . $data['uniqueImgFileName'];

               
                if (move_uploaded_file($sourceDir, $uploadPath)) {

                    $imageType = exif_imagetype($uploadPath);
                   // die("success");

                   switch ($imageType) {
                    case IMAGETYPE_JPEG:
                        
                        $source = imagecreatefromjpeg($uploadPath);

                        // Save the compressed image to the same file
                        imagejpeg($source, $uploadPath,30);  //can adjust the compression level (0-100)
                    
                        // Free up resources
                        imagedestroy($source);

                       

                        break;

                    case IMAGETYPE_PNG:
                       $source = imagecreatefrompng($uploadPath);

                        // Save the compressed image to the same file
                        imagepng($source, $uploadPath, 5); // You can adjust the compression level (0-9)

                        // Free up resources
                        imagedestroy($source);
                        break;
                   
                    default:
                        echo "Unsupported image format.";
                        break;
                }
        
                } else {
                    // Error moving the file
                   // $data['img_err'] = 'Error moving the file.';
                   // die("Misson failed");
                }


                    //execute
                if($this->db->execute()){
                    return true;

                }else{
                    return false;
                }


            }

            

        }


        //14

        public function updatePetDetails($data){

            if($data['img'] === NULL) {


        

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



            }else{

                //get image name from database
                $oldImgFileName = $this->getPetProfileImageByID($data['id']);


                // Delete the old image file

                /*
                $oldImagePath = __DIR__ . '/../../public/storage/uploads/animals/' . $oldImgFileName->profileImage;
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }*/


                $this->db->query('UPDATE petcare_pet SET pet = :pname , DOB = :DOB , breed= :breed, sex = :sex , species = :species , profileImage =:filename   WHERE id = :id');
        

                    //bind values
                    $this->db->bind(':id' , $data['id']);
                    $this->db->bind(':pname',$data['pname']);
                    $this->db->bind(':DOB',$data['dob']);
                    $this->db->bind(':breed',$data['breed']);
                    $this->db->bind(':sex',$data['sex']);
                    $this->db->bind(':species',$data['species']);
                    $this->db->bind(':filename',$data['uniqueImgFileName']);


                    // Specify the source directory (temporary location)
                    $sourceDir = $data['img']['tmp_name'];

                    // Specify the destination directory using __DIR__
                    $destinationDir = __DIR__ . '/../../public/storage/uploads/animals/';
                    // Set the path to move the uploaded file to
                    $uploadPath = $destinationDir . $data['uniqueImgFileName'];

                   
                    if (move_uploaded_file($sourceDir, $uploadPath)) {

                        $imageType = exif_imagetype($uploadPath);
                       // die("success");

                       switch ($imageType) {
                        case IMAGETYPE_JPEG:
                            
                            $source = imagecreatefromjpeg($uploadPath);

                            // Save the compressed image to the same file
                            imagejpeg($source, $uploadPath,30);  //can adjust the compression level (0-100)
                        
                            // Free up resources
                            imagedestroy($source);

                           

                            break;

                        case IMAGETYPE_PNG:
                           $source = imagecreatefrompng($uploadPath);

                            // Save the compressed image to the same file
                            imagepng($source, $uploadPath, 5); // You can adjust the compression level (0-9)

                            // Free up resources
                            imagedestroy($source);
                            break;
                       
                        default:
                            echo "Unsupported image format.";
                            break;
                    }
            
                    } else {
                        // Error moving the file
                       // $data['img_err'] = 'Error moving the file.';
                       // die("Misson failed");
                    }

    
                        //execute
                    if($this->db->execute()){
                        return true;

                    }else{
                        return false;
                    }


            }

            
            

        }

        //15

        public function removePetDetails($id){

            //update query to set isRemoved = 1
            $this->db->query('UPDATE petcare_pet SET isRemoved = 1 WHERE id = :id');

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
                WHERE petowner_id = :id AND pet.isRemoved = 0
                ORDER BY pet.id ASC');

            $this->db->bind(':id' , $id);

            $results = $this->db->resultSet();

            return $results;

        }

        //19

        public function getTimeSlots(){

            $this->db->query(

                'SELECT *
                FROM petcare_timeslots');

            

            $results = $this->db->resultSet();

            return $results;

        }

        //20

        public function checkAvailability($selectedTime, $selectedDate, $selectedVetId){


            

            $this->db->query(

                //SELECT * FROM petcare_appointments WHERE appointment_date = "2023-11-18" AND appointment_time = "09:00 AM" AND vet_id=30;
                

                'SELECT *
                FROM petcare_appointments
                WHERE appointment_date =:selectedDate AND appointment_time =:selectedTime AND vet_id = :selectedVetId');

            

            $this->db->bind(':selectedDate' , $selectedDate);
            $this->db->bind(':selectedTime' , $selectedTime);
            $this->db->bind(':selectedVetId', $selectedVetId);


          
            $row = $this->db->single();

            

        
            if($this->db->rowCount()> 0){
                
                return false;
            }else{
                
                return true;
               
            }



        }


        //21

        public function getVetDetails(){

            $this->db->query(

                'SELECT *
                FROM petcare_staff
                WHERE role = "Doctor" ');


            $results = $this->db->resultSet();

            return $results;


        }

        //22 

        public function getHolidayDetails(){

            $this->db->query(

                'SELECT day
                FROM petcare_holiday
                WHERE holiday = "true" ');

            $results = $this->db->resultSet();
            return $results;
        }

        //23 

        public function timeSlotLock($selectedTime, $selectedDate, $selectedVetId,$endTimeLock,$startTimeLock){

            $this->db->query(

                'INSERT INTO petcare_temp_lock_timeslots (time,date,vet_id,end_time,receive_time,status) VALUES(:selectedTime, :selectedDate, :selectedVetId, :endTimeLock,:startTimeLock, "1")');



                $this->db->bind(':selectedTime',$selectedTime);
                $this->db->bind(':selectedDate',$selectedDate);
                $this->db->bind(':selectedVetId',$selectedVetId);
                $this->db->bind(':endTimeLock',$endTimeLock);
                $this->db->bind(':startTimeLock',$startTimeLock);
            
    
            //execute
            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }
              
        }

        //24

        public function checkTimeSlotIsLocked($selectedTime, $selectedDate, $selectedVetId){
           
            $this->db->query('
                SELECT *
                FROM petcare_temp_lock_timeslots
                WHERE time = :selectedTime AND date = :selectedDate AND vet_id = :selectedVetId AND status = 1
            ');
        
            $this->db->bind(':selectedTime', $selectedTime);
            $this->db->bind(':selectedDate', $selectedDate);
            $this->db->bind(':selectedVetId', $selectedVetId);
        
            $row = $this->db->single();

            if($row){
                return true;
            }else{
                return false;
            }
        }

        //25

        public function getAppointmentReasons(){

            $this->db->query(

                'SELECT *
                FROM petcare_appointment_reason');

            $results = $this->db->resultSet();
            return $results;
        }

        //26
        public function insertAppointment($vetID, $reason, $petID, $date, $time,$treatment_id){

            if($treatment_id == "NONE"){
                $this->db->query(

                    'INSERT INTO petcare_appointments (vet_id, appointment_type, pet_id, appointment_date, appointment_time, petowner_id,status) VALUES(:vetID, :reason, :petID, :date, :time, :petowner_id,"Pending")');
    
                    $this->db->bind(':vetID',$vetID);
                    $this->db->bind(':reason',$reason);
                    $this->db->bind(':petID',$petID);
                    $this->db->bind(':date',$date);
                    $this->db->bind(':time',$time);
                    $this->db->bind(':petowner_id',$_SESSION['user_id']);
                
        
                //execute
                if($this->db->execute()){
                    return true;
        
                }else{
                    return false;
                }
            }else{
                $this->db->query(

                    'INSERT INTO petcare_appointments (vet_id, appointment_type, pet_id, appointment_date, appointment_time, petowner_id,status,treatment_id) VALUES(:vetID, :reason, :petID, :date, :time, :petowner_id,"Pending",:treatment_id)');
    
                    $this->db->bind(':vetID',$vetID);
                    $this->db->bind(':reason',$reason);
                    $this->db->bind(':petID',$petID);
                    $this->db->bind(':date',$date);
                    $this->db->bind(':time',$time);
                    $this->db->bind(':petowner_id',$_SESSION['user_id']);
                    $this->db->bind(':treatment_id',$treatment_id);
                
        
                //execute
                if($this->db->execute()){
                    return true;
        
                }else{
                    return false;
                }
            }

           
        }

        //27

        public function getVetNameByID($vetID){

            $this->db->query(

                'SELECT firstname, lastname
                FROM petcare_staff
                WHERE staff_id = :vetID');

                $this->db->bind(':vetID',$vetID);
            
    
            //execute
            $row = $this->db->single();

            return $row;
        }

        //28

       public function getPetNameByID($petID){

            $this->db->query(

                'SELECT pet
                FROM petcare_pet
                WHERE id = :petID');

                $this->db->bind(':petID',$petID);
            
    
            //execute
            $row = $this->db->single();

            return $row;
        }

        //29

        public function getGeneratedIDAppointment($vetid,$reson,$petid,$date,$time){
                
                $this->db->query(
    
                    'SELECT appointment_id
                    FROM petcare_appointments
                    WHERE vet_id = :vetid AND appointment_type = :reson AND pet_id = :petid AND appointment_date = :date AND appointment_time = :time');
    
                    $this->db->bind(':vetid',$vetid);
                    $this->db->bind(':reson',$reson);
                    $this->db->bind(':petid',$petid);
                    $this->db->bind(':date',$date);
                    $this->db->bind(':time',$time);
                
        
                //execute
                $row = $this->db->single();
    
                return $row;

        }


        //30

        public function getTreatmentDetailsByUserID($id){

            $this->db->query(

                'SELECT report.* , pet.profileImage as petpic , pet.pet as petname , staff.profileImage as vetpic , staff.firstname as vetfname , staff.lastname as vetlname
                FROM petcare_medical_reports report
                JOIN petcare_pet pet ON report.pet_id = pet.id
                JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                WHERE (report.treatment_id, report.visit_date) IN (
                    SELECT treatment_id, MAX(visit_date) AS max_visit_date
                    FROM petcare_medical_reports
                    GROUP BY treatment_id
                ) AND report.owner_id = :id  -- Added condition for owner_id in the main query
                ORDER BY report.visit_date DESC
                ');

                $this->db->bind(':id' , $id);
                        

                $results = $this->db->resultSet();

                return $results;


        }

        //31

        public function getTreatmentDetailsByTreatmentID($id){

            $userID = $_SESSION['user_id'];

            $this->db->query(

                'SELECT report.* , pet.pet as petname , pet.pet_id_generate as genIdPet, pet.sex as petsex, pet.*, staff.firstname as vetfname , staff.lastname as vetlname , petowner.petowner_id_generate as genIdPetOwner , petowner.address as petowneraddress
                FROM petcare_medical_reports report
                JOIN petcare_pet pet ON report.pet_id = pet.id
                JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                JOIN petcare_petowner petowner ON report.owner_id = petowner.id
                WHERE report.treatment_id = :id AND report.owner_id = :userID -- Added condition for owner_id in the main query
                ORDER BY report.visit_date DESC
                ');

                $this->db->bind(':id' , $id);
                $this->db->bind(':userID' , $userID);
                        

                $results = $this->db->resultSet();

                return $results;
        }



        //32

        public function getPetCareDetails(){
                
                $this->db->query(
    
                    'SELECT *
                    FROM petcare_details');
    
                $results = $this->db->resultSet();
                return $results;
        }

        //33

        public function getTreatmentDetailsByUserIDOnlyOngoing($id){
                
                $this->db->query(
    
                    'SELECT report.* , pet.profileImage as petpic , pet.pet as petname , staff.profileImage as vetpic , staff.firstname as vetfname , staff.lastname as vetlname
                    FROM petcare_medical_reports report
                    JOIN petcare_pet pet ON report.pet_id = pet.id
                    JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                    WHERE (report.treatment_id, report.visit_date) IN (
                        SELECT treatment_id, MAX(visit_date) AS max_visit_date
                        FROM petcare_medical_reports
                        GROUP BY treatment_id
                    ) AND report.owner_id = :id AND report.status = "Ongoing"  -- Added condition for owner_id in the main query
                    ORDER BY report.visit_date DESC
                    ');
    
                    $this->db->bind(':id' , $_SESSION['user_id']);
                            
    
                    $results = $this->db->resultSet();
    
                    return $results;
        }

        //34

        public function getPetProfileImageByID($id){
                
                $this->db->query(
    
                    'SELECT profileImage
                    FROM petcare_pet
                    WHERE id = :id');
    
                    $this->db->bind(':id' , $id);
                            
    
                    $row = $this->db->single();
    
                    return $row;
        }



        // ============================  Pet Owner over =========================================================================================



}