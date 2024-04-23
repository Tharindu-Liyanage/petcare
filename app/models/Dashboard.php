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
            

        $this->db->query('INSERT INTO petcare_staff (firstname,lastname,email,phone,role,password,address,nic) VALUES(:first_name, :last_name, :email, :mobile, :role,:tmp_pwd, :address,:nic)');

        //bind values
        $this->db->bind(':first_name',$data['first_name']);
        $this->db->bind(':last_name',$data['last_name']);
        $this->db->bind(':mobile',$data['mobile']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':tmp_pwd',$data['tmp_pwd']);
        $this->db->bind(':role',$data['role']);
        $this->db->bind(':address',$data['address']);
        $this->db->bind(':nic',$data['nic']);
        

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }  

        }



        //3

        public function updateStaff($data){

            $this->db->query('UPDATE petcare_staff SET firstname = :first_name , lastname = :last_name , email= :email, role = :role , address = :address , phone = :mobile , nic = :nic ,password=:password  WHERE staff_id = :id');

        //bind values
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':first_name',$data['first_name']);
        $this->db->bind(':last_name',$data['last_name']);
        $this->db->bind(':mobile',$data['mobile']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':role',$data['role']);
        $this->db->bind(':address',$data['address']);
        $this->db->bind(':nic',$data['nic']);
        $this->db->bind(':password',password_hash($data['nic'],PASSWORD_DEFAULT));
        // $this->db->bind(':fb_url',$data['fb_url']);
        // $this->db->bind(':insta_url',$data['insta_url']);
        // $this->db->bind(':twitter_url',$data['twitter_url']);
        // $this->db->bind(':password',$data['password']);

        
        

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }  

    }

        public function updateSettings1($data){

       

                $this->db->query('UPDATE petcare_staff SET firstname = :first_name , lastname = :last_name , email= :email,  address = :address , phone = :mobile   WHERE staff_id = :id');

            //bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':first_name',$data['first_name']);
            $this->db->bind(':last_name',$data['last_name']);
            $this->db->bind(':mobile',$data['mobile']);
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':address',$data['address']);

        

            
            
            

            //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }  

        }

        public function updateSettings3($data){

       

            $this->db->query('UPDATE petcare_staff SET fb_url = :fb_ur; , insta_url = :insta_url , twitter_url= :twitter_url   WHERE staff_id = :id');

        //bind values
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':fb_ur',$data['fb_url']);
        $this->db->bind(':insta_url',$data['insta_url']);
        $this->db->bind(':twitter_url',$data['twitter_url']);

    

        
        
        

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }  

    }

        public function updateSettings2($data){

          
            $this->db->query('UPDATE petcare_staff SET   password = :password  WHERE staff_id = :id');
    
            //bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':password',$data['password']);
    
            
            
            
    
            //execute
            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }  
    
        }



        // public function updatePassword(){

        // }



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
            $this->db->query('SELECT * FROM petcare_petowner WHERE isRemoved = 0');
        

            $results = $this->db->resultSet(); 

            return $results;
    

        }

        public function getPetownerDetailsById($id){
            $this->db->query('SELECT * FROM petcare_petowner WHERE id = :id');
            $this->db->bind(':id' , $id);
        

            $row = $this->db->single();
    
            //return row
    
            return $row;
    
        }

        public function updatePetowner($data){
            $this->db->query('UPDATE petcare_petowner SET first_name = :first_name , last_name = :last_name , email= :email , address = :address , mobile = :mobile   WHERE id = :id');

        //bind values
        $this->db->bind(':id',$data['id']);
        $this->db->bind(':first_name',$data['first_name']);
        $this->db->bind(':last_name',$data['last_name']);
        $this->db->bind(':mobile',$data['mobile']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':address',$data['address']);
        // $this->db->bind(':fb_url',$data['fb_url']);
        // $this->db->bind(':insta_url',$data['insta_url']);
        // $this->db->bind(':twitter_url',$data['twitter_url']);
        // $this->db->bind(':password',$data['password']);

        
        

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }  
        }

        public function removePetowner($id){
            $this->db->query('UPDATE petcare_petowner SET isRemoved = 1 WHERE id = :id');

            $this->db->bind(':id' , $id);
            
            $row = $this->db->single();

            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }  
        }


        //admin petowner start

        public function getPetDetails(){
            $this->db->query('SELECT pet.* , petowner.id as poid, petowner.first_name as petownerfname, petowner.last_name as petownerlname, petowner.profileImage as poimg FROM petcare_pet pet JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id WHERE pet.isRemoved = 0 AND petowner.isRemoved = 0');
        

            $results = $this->db->resultSet(); 

            return $results;
        }


        public function updatePet($data){ // for admin
            $this->db->query('UPDATE petcare_pet SET pet = :petname , DOB = :dob , species= :species , breed = :breed , sex = :sex   WHERE id = :id');

            //bind values
            $this->db->bind(':id',$data['id']);
            $this->db->bind(':petname',$data['petname']);
            $this->db->bind(':species',$data['species']);
            $this->db->bind(':breed',$data['breed']);
            $this->db->bind(':sex',$data['sex']);
            $this->db->bind(':dob',$data['DOB']);

            if($this->db->execute()){
                return true;

            }else{
                return false;
            }  
        

        }


        public function adminGetPetDetailsByID($id){

            $this->db->query('SELECT * FROM petcare_pet WHERE id = :id ');
        

            $this->db->bind(':id' , $id);
            
    
            $row = $this->db->single();
    
            //return row
    
            return $row;
        }

        // appointmnet admin

        public function getAppointments(){
            

             
            $this->db->query('SELECT petcare_appointments.*, petcare_pet.pet , petcare_pet.profileImage as petProfile, petcare_petowner.first_name , petcare_petowner.last_name ,
                    petcare_petowner.profileImage as petownerProfile , petcare_petowner.id as poid
                    FROM petcare_appointments
                    JOIN petcare_petowner ON  petcare_appointments.petowner_id = petcare_petowner.id
                    JOIN petcare_pet ON petcare_appointments.pet_id = petcare_pet.id
                    
    
                ');
    

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

        12. getOrderDetails()
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

            $this->db->query('INSERT INTO petcare_inventory (name,brand,category,stock,price,image) VALUES(:name, :brand, :category, :stock, :price, :image )');

             //bind values
        $this->db->bind(':name',$data['pname']);
        $this->db->bind(':brand',$data['brand']);
        $this->db->bind(':category',$data['category']);
        $this->db->bind(':stock',$data['stock']);
        $this->db->bind(':price',$data['price']);
        $this->db->bind(':image',$data['uniqueImgFileName']);

        $sourceDir = $data['img']['tmp_name'];

        //new path link
        $destinationDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'products' . DIRECTORY_SEPARATOR;

                
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
            //  die("Misson failed img not moved");
        }
        

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

        public function getOrderDetails(){
            $this->db->query('SELECT petcare_shop_invoices.*, petcare_inventory.*, petcare_petowner.*, petcare_cart_items.*
                FROM petcare_shop_invoices
                JOIN petcare_petowner ON  petcare_shop_invoices.user_id = petcare_petowner.id
                JOIN petcare_cart_items ON petcare_shop_invoices.cart_id = petcare_cart_items.cart_id
                JOIN petcare_inventory ON petcare_cart_items.product_id = petcare_inventory.id
                GROUP BY petcare_shop_invoices.invoice_id,petcare_petowner.id
                ORDER BY petcare_shop_invoices.invoice_date DESC;

            ');

            $results = $this->db->resultSet(); 

            return $results;

        }

        public function getOrderDetailsById($id){
            $this->db->query('SELECT petcare_shop_invoices.*, petcare_inventory.*, petcare_petowner.*, petcare_cart_items.*
                FROM petcare_shop_invoices
                JOIN petcare_petowner ON  petcare_shop_invoices.user_id = petcare_petowner.id
                JOIN petcare_cart_items ON petcare_shop_invoices.cart_id = petcare_cart_items.cart_id
                JOIN petcare_inventory ON petcare_cart_items.product_id = petcare_inventory.id
                WHERE invoice_id = :invoice_id;
            ');

            $this->db->bind(':invoice_id' , $id);
                
            $results = $this->db->resultSet(); 

            return $results;

        }

        public function getOrderDetailsByIdRow($id){
            $this->db->query('SELECT petcare_shop_invoices.*, petcare_inventory.*, petcare_petowner.*, petcare_cart_items.*
                FROM petcare_shop_invoices
                JOIN petcare_petowner ON  petcare_shop_invoices.user_id = petcare_petowner.id
                JOIN petcare_cart_items ON petcare_shop_invoices.cart_id = petcare_cart_items.cart_id
                JOIN petcare_inventory ON petcare_cart_items.product_id = petcare_inventory.id
                WHERE invoice_id = :invoice_id;
            ');

            $this->db->bind(':invoice_id' , $id);
                
            $row = $this->db->single();
    
            //return row
    
            return $row;

        }


        public function getCategories(){
            $this->db->query('SELECT * FROM petcare_product_category WHERE isRemoved = 0' );

            $results = $this->db->resultSet(); 

            return $results;
        }

        public function getCategoriesById($id){
            $this->db->query('SELECT * FROM petcare_product_category WHERE id = :id' );

            $this->db->bind(':id' , $id);

            $row = $this->db->single();
    
            //return row
    
            return $row;
        }

        public function addCategory($data){

            $this->db->query('INSERT INTO petcare_product_category (categoryname) VALUES(:categoryName)');

             //bind values
            $this->db->bind(':categoryName',$data['categoryName']);
        
        

            //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }  

        }

        public function updateCategory($data){
            
            $this->db->query('UPDATE petcare_product_category SET categoryname = :categoryname WHERE id = :id' );

            $this->db->bind(':id' , $data['id']);
            //bind values
            $this->db->bind(':categoryname',$data['categoryName']);
        

            //execute
            if($this->db->execute()){
                return true;

            }else{
                return false;
            }  

        }

        public function removeCategory($id){
            
            $this->db->query('UPDATE petcare_product_category SET isRemoved = 1 WHERE id = :id');

            $this->db->bind(':id' , $id);
            
            $row = $this->db->single();

            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }  

        }


        // public function updateShipmentStatus($shipmentId, $newStatus) {
        //     $this->db->query("UPDATE shipments SET ship_status = :status WHERE invoice_id = :id");
        //     $this->db->bind(':status', $newStatus);
        //     $this->db->bind(':invoice_id', $shipmentId);
    
        //     return $this->db->execute();
        // }

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
                //$destinationDir = __DIR__ . '/../../public/storage/uploads/animals/';

                //new path link support for windows and linux
                $destinationDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'animals' . DIRECTORY_SEPARATOR;
                
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
                $previousImage = $this->getPetProfileImageByID($data['id']);


           

                


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
                    //$destinationDir = __DIR__ . '/../../public/storage/uploads/animals/';

                    //new path link support for windows and linux
                    $destinationDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'animals' . DIRECTORY_SEPARATOR;

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

                    //delete the old image
                    if($data['img'] != NULL){

                        $oldImgPath = $destinationDir . $previousImage;
                        if($previousImage != 'petcare-default-picture-pet.png'){
                            unlink($oldImgPath);
                        }
                    }
                        

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

            $this->db->query('SELECT * FROM petcare_pet WHERE id = :id AND petowner_id = :petowner_id');
        

            $this->db->bind(':id' , $id);
            $this->db->bind(':petowner_id' , $_SESSION['user_id']);
    
            $row = $this->db->single();
    
            //return row
    
            return $row;
        }


        //17
       public function getAppointmentDetailsByPetOwner($id){

            $this->db->query(

                'SELECT a.*, p.pet as pet_name, p.profileImage as propic , p.species as pet_species , staff.firstname as fname , staff.lastname as lname , staff.profileImage as vetpic ,staff.staff_id as vet_id
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

                'SELECT pet.* , pet.id as petid
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
        public function insertAppointment($vetID, $reason, $petID, $date, $time,$treatment_id,$price){

            if($treatment_id == "NONE"){
                $this->db->query(

                    'INSERT INTO petcare_appointments (vet_id, appointment_type, pet_id, appointment_date, appointment_time, petowner_id,status,price) VALUES(:vetID, :reason, :petID, :date, :time, :petowner_id,"Pending",:price)');
    
                    $this->db->bind(':vetID',$vetID);
                    $this->db->bind(':reason',$reason);
                    $this->db->bind(':petID',$petID);
                    $this->db->bind(':date',$date);
                    $this->db->bind(':time',$time);
                    $this->db->bind(':petowner_id',$_SESSION['user_id']);
                    $this->db->bind(':price',$price);
                
        
                //execute
                if($this->db->execute()){
                    return true;
        
                }else{
                    return false;
                }
            }else{
                $this->db->query(

                    'INSERT INTO petcare_appointments (vet_id, appointment_type, pet_id, appointment_date, appointment_time, petowner_id,status,treatment_id,price) VALUES(:vetID, :reason, :petID, :date, :time, :petowner_id,"Pending",:treatment_id,:price)');
    
                    $this->db->bind(':vetID',$vetID);
                    $this->db->bind(':reason',$reason);
                    $this->db->bind(':petID',$petID);
                    $this->db->bind(':date',$date);
                    $this->db->bind(':time',$time);
                    $this->db->bind(':petowner_id',$_SESSION['user_id']);
                    $this->db->bind(':treatment_id',$treatment_id);
                    $this->db->bind(':price',$price);
                
        
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

                'SELECT report.* , pet.profileImage as petpic , pet.pet as petname , staff.profileImage as vetpic , staff.firstname as vetfname , staff.lastname as vetlname , staff.staff_id as vet_id
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
    
                    return $row->profileImage;
        }

        //35

        public function getAppointmentDetailsByID($id,$petowner){
                
                $this->db->query(
    
                    'SELECT *
                    FROM petcare_appointments a
                    WHERE a.id = :id AND a.petowner_id = :petowner');
    
                $this->db->bind(':id' , $id);
                $this->db->bind(':petowner' , $_SESSION['user_id']);
            
    
                $row = $this->db->single();
    
                return $row;
        }

        //36

        public function updateAppointment($data){
                
            $this->db->query('UPDATE petcare_appointments SET vet_id = :vet_id , appointment_type = :appointment_type , pet_id= :pet_id, appointment_date = :appointment_date , appointment_time = :appointment_time , status = "Pending" , treatment_id = :treatment_id  WHERE id = :id');

            $this->db->bind(':id' , $data['appointment_id']);
            $this->db->bind(':vet_id',$data['vet_post']);
            $this->db->bind(':appointment_type',$data['reason_post']);
            $this->db->bind(':pet_id',$data['pet_post']);
            $this->db->bind(':appointment_date',$data['date_post']);
            $this->db->bind(':appointment_time',$data['time_post']);

            // Check if treatment_post is set to 'NONE', if so, set treatment_id to NULL, otherwise, bind the value as usual
            if ($data['treatment_post'] == 'NONE') {
                $this->db->bind(':treatment_id', null, PDO::PARAM_NULL);
            } else {
                $this->db->bind(':treatment_id', $data['treatment_post']);
            }

                
    
        
                    //execute
                if($this->db->execute()){
                    return true;
    
                }else{
                    return false;
                }
        }


        public function getMyOrdersByPetownerID($id){
            //get user orders from petcare_carts and total amount from petcare_shop_invoices

            $this->db->query('SELECT cart.*, invoice.total_amount as total_price, invoice.invoice_id as invoice_id, invoice.invoice_date as order_date
            FROM petcare_carts cart
            JOIN petcare_shop_invoices invoice ON cart.cart_id = invoice.cart_id
            WHERE cart.user_id = :id
            ORDER BY invoice.invoice_date DESC');

            $this->db->bind(':id', $id);

            $results = $this->db->resultSet();

            return $results;

        }

        public function getCartDetailsByCartID($id){

            $this->db->query('SELECT cart.* , invoice.invoice_date as order_date , invoice.invoice_id as invoice_id , invoice.total_amount as total_price
            FROM petcare_carts cart
            JOIN petcare_shop_invoices invoice ON cart.cart_id = invoice.cart_id
            WHERE cart.cart_id = :id');

            $this->db->bind(':id', $id);

            $row = $this->db->single();
    
            return $row;

        }

        public function getProductsByCartID($id){
                
                $this->db->query('SELECT inventory.* , cart.quantity as ordered_quantity
                FROM petcare_cart_items cart
                JOIN petcare_inventory inventory ON cart.product_id = inventory.id
                WHERE cart.cart_id = :id');
    
                $this->db->bind(':id', $id);
    
                $results = $this->db->resultSet();
    
                return $results;
        }


        public function animalWardDetails(){
            $this->db->query('SELECT * FROM petcare_ward');
            $results = $this->db->resultSet();
            return $results;
        }

        public function getWardTreatmentDetailsByUserID($id) {
            $this->db->query('SELECT report.*,
                       pet.profileImage AS petpic,
                       pet.pet AS petname,
                       staff.profileImage AS vetpic,
                       staff.firstname AS vetfname,
                       staff.lastname AS vetlname,
                       staff.staff_id AS vet_id
                FROM petcare_ward_medical_reports report
                JOIN petcare_pet pet ON report.pet_id = pet.id
                JOIN petcare_staff staff ON report.veterinarian_id = staff.staff_id
                WHERE (report.treatment_id, report.lastupdate) IN (
                    SELECT treatment_id, MAX(lastupdate) AS max_lastupdate
                    FROM petcare_ward_medical_reports
                    GROUP BY treatment_id
                ) AND report.owner_id = :id
                ORDER BY report.lastupdate DESC
            ');
        
            $this->db->bind(':id', $id);
            
            $results = $this->db->resultSet();
            
            return $results;
        }


        public function getBillByTreatmentID($id) {
            $this->db->query('SELECT bill.* , treat.payment_status AS payment_status 
             FROM petcare_ward_medical_bill bill
             JOIN petcare_ward_treatment treat ON bill.ward_treatment_id = treat.ward_treatment_id
             WHERE bill.ward_treatment_id = :id');
            $this->db->bind(':id', $id);

            $results = $this->db->resultSet();
            
            return $results;
        }


        public function getWardPaymentStatusByTreatmentID($id){
            $this->db->query('SELECT * , petowner.first_name AS petownerFname , petowner.last_name AS petownerLname , petowner.address AS petownerAddress , petowner.email AS petownerEmail , petowner.mobile AS petownerMobile
             FROM petcare_ward_treatment treat
             JOIN petcare_pet pet ON treat.pet_id = pet.id
             JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id
             WHERE ward_treatment_id = :id');
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            return $row;
        }

        public function getDischargeDetails(){
            //from inward_pet table
            $this->db->query('SELECT ward.* , pet.pet_id_generate as genPetID, petowner.petowner_id_generate as genPetOwnerID ,  pet.pet as petname, pet.profileImage as petpic, petowner.profileImage as petownerpic, petowner.first_name as petownerfname, petowner.last_name as petownerlname
                              FROM petcare_ward_treatment ward
                              JOIN petcare_pet pet ON ward.pet_id = pet.id
                              JOIN petcare_petowner petowner ON pet.petowner_id = petowner.id
                             -- WHERE ward.payment_status = "Processing"
                             WHERE petowner.id = :id
                               
                           ');

            $this->db->bind(':id', $_SESSION['user_id']);
            $results = $this->db->resultSet();
            return $results;
            
        }


        
        



        // ============================  Pet Owner over =========================================================================================



}