<?php
    class Settings{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function getSettingDetails($userid){
            $this->db->query('SELECT * FROM petcare_staff WHERE staff_id = :userid ');

            $this->db->bind(':userid' , $userid);

            $results = $this->db->single();
            return $results;
        }

        public function getPetOwnerSettingDetails($userid){
            $this->db->query('SELECT * FROM petcare_petowner WHERE id = '.$userid );

            $results = $this->db->single();
            return $results;
        }

        public function getPasswordById($user_id){
            $this->db->query('SELECT * FROM petcare_staff WHERE staff_id = :id');
            $this->db->bind(':id' , $user_id);
            $results = $this->db->single();
            $hashed_password = $results->password;
            return $hashed_password;

            
        }



        // ============================== Pet owner settings Start ===================================//

        public function updatePetownerProfile($data){

            $userDetails = $this->getPetOwnerSettingDetails($_SESSION['user_id']);

            $previousImage = $userDetails->profileImage;

            if($data['profile_pic_img'] == null){

                $this->db->query('UPDATE petcare_petowner SET first_name = :firstname , last_name = :lastname , address = :address WHERE id = :id');

            }else{

                $this->db->query('UPDATE petcare_petowner SET first_name = :firstname , last_name = :lastname , address = :address , profileImage = :filename WHERE id = :id');
                $this->db->bind(':filename',$data['uniqueImgFileName']);

                //new path link support for windows and linux
                $destinationDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'userprofiles' . DIRECTORY_SEPARATOR;

                // Set the path to move the uploaded file to
                $uploadPath = $destinationDir . $data['uniqueImgFileName'];

                $sourceDir = $data['profile_pic_img']['tmp_name'];



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
                    die("Misson failed");
                }
            }


            $this->db->bind(':firstname' , $data['fname']);
            $this->db->bind(':lastname' , $data['lname']);
            $this->db->bind(':address' , $data['address']);
            $this->db->bind(':id' , $_SESSION['user_id']);

            if($this->db->execute()){
                    //update session variable
                    $_SESSION['user_fname'] = $data['fname'];
                    $_SESSION['user_lname'] = $data['lname'];

                    if($data['profile_pic_img'] != null){
                        $_SESSION['user_profileimage'] = $data['uniqueImgFileName'];

                        //unlink the img
                        unlink($destinationDir . $previousImage);
                    }

                    return true;
            }else{
                   
                    return false;
            }   
        }

        public function verifyPasswordPetowner($pass){

            $user = $this->getPetOwnerSettingDetails($_SESSION['user_id']);
            $hashed_password = $user->password;

            

            

            if(password_verify($pass , $hashed_password)){

                return true;
                
            }else{
                
                return false;
            }
        }

        public function updatePetownerPassword($pass){
            $this->db->query('UPDATE petcare_petowner SET password = :password WHERE id = :id');
            $this->db->bind(':password' , $pass);
            $this->db->bind(':id' , $_SESSION['user_id']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }

        }


        public function updatePetownerEmail($email){

            $this->db->query('UPDATE petcare_petowner SET email = :email WHERE id = :id');
            $this->db->bind(':email' , $email);
            $this->db->bind(':id' , $_SESSION['user_id']);

            if($this->db->execute()){

                //update session 
                $_SESSION['user_email'] = $email;

                return true;

                
            }else{
                return false;
            }
        }

        public function updatePetownerMobile($num){
                
                $this->db->query('UPDATE petcare_petowner SET mobile = :mobile WHERE id = :id');
                $this->db->bind(':mobile' , $num);
                $this->db->bind(':id' , $_SESSION['user_id']);
    
                if($this->db->execute()){
    
                    //update session 
                    $_SESSION['user_mobile'] = $num;
    
                    return true;
    
                    
                }else{
                    return false;
                }
        }

        // ============================== Pet owner settings over ===================================//


        // ============================== Staff settings Start ===================================//

        public function updateStaffProfile($data){

            $userDetails = $this->getSettingDetails($_SESSION['user_id']);

            $previousImage = $userDetails->profileImage;

            if($data['profile_pic_img'] == null){

                if($_SESSION['user_role'] != 'Doctor' ){
                    $this->db->query('UPDATE petcare_staff SET firstname = :firstname , lastname = :lastname , address = :address, nic =:nic WHERE staff_id = :id');
                }else{
                    $this->db->query('UPDATE petcare_staff SET firstname = :firstname , lastname = :lastname , address = :address, nic =:nic , bio=:bio WHERE staff_id = :id');
                    $this->db->bind(':bio' , $data['bio']);
                }

            }else{

                if($_SESSION['user_role'] != 'Doctor' ){
                    $this->db->query('UPDATE petcare_staff SET firstname = :firstname , lastname = :lastname , address = :address, nic =:nic , profileImage = :filename WHERE staff_id = :id');
                    
                }else{
                    $this->db->query('UPDATE petcare_staff SET firstname = :firstname , lastname = :lastname , address = :address, nic =:nic , profileImage = :filename , bio = :bio WHERE staff_id = :id');
                    $this->db->bind(':bio' , $data['bio']);
                }

               


                $this->db->bind(':filename',$data['uniqueImgFileName']);

                //new path link support for windows and linux
                $destinationDir = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'userprofiles' . DIRECTORY_SEPARATOR;

                // Set the path to move the uploaded file to
                $uploadPath = $destinationDir . $data['uniqueImgFileName'];

                $sourceDir = $data['profile_pic_img']['tmp_name'];

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
                    die("Misson failed");
                }
            }


            $this->db->bind(':firstname' , $data['fname']);
            $this->db->bind(':lastname' , $data['lname']);
            $this->db->bind(':address' , $data['address']);
            $this->db->bind(':nic' , $data['nic']);
            $this->db->bind(':id' , $_SESSION['user_id']);

            if($this->db->execute()){
                    //update session variable
                    $_SESSION['user_fname'] = $data['fname'];
                    $_SESSION['user_lname'] = $data['lname'];

                    if($data['profile_pic_img'] != null){
                        $_SESSION['user_profileimage'] = $data['uniqueImgFileName'];

                        //unlink the img
                        unlink($destinationDir . $previousImage);
                    }

                    return true;
            }else{
                   
                    return false;
            }   
        }

        public function verifyPasswordStaff($pass){
                
                $user = $this->getSettingDetails($_SESSION['user_id']);
                $hashed_password = $user->password;
    
                
    
                
    
                if(password_verify($pass , $hashed_password)){
    
                    return true;
                    
                }else{
                    
                    return false;
                }
        }

        public function updatePasswordStaff($pas){
            $this->db->query('UPDATE petcare_staff SET password = :password WHERE staff_id = :id');
            $this->db->bind(':password' , $pas);
            $this->db->bind(':id' , $_SESSION['user_id']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function updateStaffEmail($email){
                
                $this->db->query('UPDATE petcare_staff SET email = :email WHERE staff_id = :id');
                $this->db->bind(':email' , $email);
                $this->db->bind(':id' , $_SESSION['user_id']);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }

        }

        public function updateStaffMobile($phone){
                    
                    $this->db->query('UPDATE petcare_staff SET phone = :mobile WHERE staff_id = :id');
                    $this->db->bind(':mobile' , $phone);
                    $this->db->bind(':id' , $_SESSION['user_id']);
    
                    if($this->db->execute()){
                        return true;
                    }else{
                        return false;
                    }
        }

        public function getPrice(){
            //from petcare_appointment_price

            $this->db->query('SELECT * FROM petcare_appointment_price WHERE id = 1');
            $result = $this->db->single();
            return $result;
        }

        public function updatePrice($data){
            $this->db->query('UPDATE petcare_appointment_price SET price = :price, price_id = :priceID WHERE id = 1');
            $this->db->bind(':price' , $data['appointment_price']);
            $this->db->bind(':priceID' , $data['price_id']);

            if($this->db->execute()){
                return true;
            }else{
                return false;
            }
        }


        public function addCage(){
            $this->db->query('SELECT * FROM petcare_cage_status WHERE isRemoved = 1 LIMIT 1');

            $result = $this->db->single();

            if($result){
                $this->db->query('UPDATE petcare_cage_status SET isRemoved = 0 WHERE id = :id');
                $this->db->bind(':id' , $result->id);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }

            }else{

                $this->db->query('INSERT INTO petcare_cage_status (isRemoved) VALUES (0)');

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }
            }
           
           
        }

        public function deleteCage(){

            $this->db->query('SELECT * FROM petcare_cage_status WHERE status ="available" AND isRemoved = 0 ORDER BY id DESC LIMIT 1');

            $result = $this->db->single();

            if($result){
                $this->db->query('UPDATE petcare_cage_status SET isRemoved = 1 WHERE id = :id');
                $this->db->bind(':id' , $result->id);

                if($this->db->execute()){
                    return true;
                }else{
                    return false;
                }

            }else{
                return false;
            }
        } 


        public function updateTimeSlots($data){

            //monday morninig
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 1');
            
            $this->db->bind(':m_start' , $data['monday_m_start']);
            $this->db->bind(':m_end' , $data['monday_m_end']);
            $this->db->bind(':m_gap' , $data['monday_m_gap']);

            $this->db->execute();

            //monday afternoon
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end, intervel =:m_gap WHERE id = 2');

            $this->db->bind(':m_start' , $data['monday_a_start']);
            $this->db->bind(':m_end' , $data['monday_a_end']);
            $this->db->bind(':m_gap' , $data['monday_a_gap']);

            $this->db->execute();

            //tuesday morning
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 3');

            $this->db->bind(':m_start' , $data['tuesday_m_start']);
            $this->db->bind(':m_end' , $data['tuesday_m_end']);
            $this->db->bind(':m_gap' , $data['tuesday_m_gap']);

            $this->db->execute();

            //tuesday afternoon
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 4');

            $this->db->bind(':m_start' , $data['tuesday_a_start']);
            $this->db->bind(':m_end' , $data['tuesday_a_end']);
            $this->db->bind(':m_gap' , $data['tuesday_a_gap']);

            $this->db->execute();

            //wednesday morning
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 5');

            $this->db->bind(':m_start' , $data['wednesday_m_start']);
            $this->db->bind(':m_end' , $data['wednesday_m_end']);
            $this->db->bind(':m_gap' , $data['wednesday_m_gap']);

            $this->db->execute();

            //wednesday afternoon
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 6');

            $this->db->bind(':m_start' , $data['wednesday_a_start']);
            $this->db->bind(':m_end' , $data['wednesday_a_end']);
            $this->db->bind(':m_gap' , $data['wednesday_a_gap']);

            $this->db->execute();

            //thursday morning
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 7');

            $this->db->bind(':m_start' , $data['thursday_m_start']);
            $this->db->bind(':m_end' , $data['thursday_m_end']);
            $this->db->bind(':m_gap' , $data['thursday_m_gap']);

            $this->db->execute();

            //thursday afternoon
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 8');

            $this->db->bind(':m_start' , $data['thursday_a_start']);
            $this->db->bind(':m_end' , $data['thursday_a_end']);
            $this->db->bind(':m_gap' , $data['thursday_a_gap']);

            $this->db->execute();

            //friday morning
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 9');

            $this->db->bind(':m_start' , $data['friday_m_start']);
            $this->db->bind(':m_end' , $data['friday_m_end']);
            $this->db->bind(':m_gap' , $data['friday_m_gap']);

            $this->db->execute();

            //friday afternoon
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 10');

            $this->db->bind(':m_start' , $data['friday_a_start']);
            $this->db->bind(':m_end' , $data['friday_a_end']);
            $this->db->bind(':m_gap' , $data['friday_a_gap']);

            $this->db->execute();

            //saturday morning
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end, intervel =:m_gap WHERE id = 11');

            $this->db->bind(':m_start' , $data['saturday_m_start']);
            $this->db->bind(':m_end' , $data['saturday_m_end']);
            $this->db->bind(':m_gap' , $data['saturday_m_gap']);

            $this->db->execute();

            //saturday afternoon
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 12');

            $this->db->bind(':m_start' , $data['saturday_a_start']);
            $this->db->bind(':m_end' , $data['saturday_a_end']);
            $this->db->bind(':m_gap' , $data['saturday_a_gap']);

            $this->db->execute();

            //sunday morning
            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 13');

            $this->db->bind(':m_start' , $data['sunday_m_start']);
            $this->db->bind(':m_end' , $data['sunday_m_end']);
            $this->db->bind(':m_gap' , $data['sunday_m_gap']);

            $this->db->execute();

            //sunday afternoon

            $this->db->query('UPDATE petcare_timeslots SET start_time = :m_start , end_time =:m_end ,intervel =:m_gap WHERE id = 14');

            $this->db->bind(':m_start' , $data['sunday_a_start']);
            $this->db->bind(':m_end' , $data['sunday_a_end']);
            $this->db->bind(':m_gap' , $data['sunday_a_gap']);

            $this->db->execute();

            return true;
        }

        
        




    }