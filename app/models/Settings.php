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

                $this->db->query('UPDATE petcare_staff SET firstname = :firstname , lastname = :lastname , address = :address WHERE staff_id = :id');

            }else{

                $this->db->query('UPDATE petcare_staff SET firstname = :firstname , lastname = :lastname , address = :address , profileImage = :filename WHERE staff_id = :id');
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

        
        




    }