<?php

class User{

    private $db;

    public function __construct(){

            $this->db = new Database;
    }


      /*
        ====================  User Model =============== 
        
          ** All database business with LOGIN , SIGNUP  here
    
          ** Return data  to  USER (Users.php) controller (app/controller/User) called method
        
        =====================================================
        */



    //login user

    public function login($email,$password){

        $this->db->query('SELECT * FROM petcare_petowner WHERE email = :email');
        $this->db->bind(':email',$email);


        $row = $this->db->single();

        if ($row) {
        $hashed_password = $row->password;

        if (password_verify($password, $hashed_password)) {
            return $row; // Password is correct; return the user data
        }
    }

    return false;

    }

    //login staff user

    public function stafflogin($email,$password){

        $this->db->query('SELECT * FROM petcare_staff WHERE email = :email');
        $this->db->bind(':email',$email);


        $row = $this->db->single();

        if ($row) {
        $hashed_password = $row->password;

        if (password_verify($password, $hashed_password)) {
            return $row; // Password is correct; return the user data
        }
    }

    return false;

    }



    //register User

    public function register($data){

        $this->db->query('INSERT INTO petcare_petowner (first_name,last_name, mobile,email,password) VALUES(:first_name, :last_name, :mobile, :email, :password)');

        //bind values
        $this->db->bind(':first_name',$data['first_name']);
        $this->db->bind(':last_name',$data['last_name']);
        $this->db->bind(':mobile',$data['mobile']);
        $this->db->bind(':email',$data['email']);
        $this->db->bind(':password',$data['password']);

        //execute
        if($this->db->execute()){
            return true;

        }else{
            return false;
        }
    }

    //find user by email
    public function findUserByEmail($email){
        $this->db->query('SELECT * FROM petcare_petowner WHERE email = :email');
        $this->db->bind(':email' , $email);

        $row = $this->db->single();

        //check row count

        if($this->db->rowCount() > 0 ){
            return true;
        }else{
            return false;
        }

    }

    public function findUserByEmailForForgotPassword($email){

        if(isset($_SESSION['User_Role']) && $_SESSION['User_Role'] == 'staff'){
            $this->db->query('SELECT * , s.phone as mobile ,s.firstname as first_name , s.lastname as last_name FROM petcare_staff s WHERE email = :email');
        }else{
            $this->db->query('SELECT * FROM petcare_petowner WHERE email = :email');
        }
        
        $this->db->bind(':email' , $email);

        $row = $this->db->single();

        return $row;

    }

    //find staff by email
    public function findStaffUserByEmail($email){
        $this->db->query('SELECT * FROM petcare_staff WHERE email = :email');
        $this->db->bind(':email' , $email);

        $row = $this->db->single();

        //check row count

        if($this->db->rowCount() > 0 ){
            return true;
        }else{
            return false;
        }

    }

  

    //find user by mobile
    public function findUserByMobile($mobile){
        $this->db->query('SELECT * FROM petcare_petowner WHERE mobile = :mobile');
        $this->db->bind(':mobile' , $mobile);

        $row = $this->db->single();

        //check row count

        if($this->db->rowCount() > 0 ){
            return true;
        }else{
            return false;
        }

    }

    //find staff by mobile
    public function findStaffByMobile($mobile){
        $this->db->query('SELECT * FROM petcare_staff WHERE phone = :mobile');
        $this->db->bind(':mobile' , $mobile);

        $row = $this->db->single();

        //check row count

        if($this->db->rowCount() > 0 ){
            return true;
        }else{
            return false;
        }

        }

        //send otp code
        public function sendOtpCode($data){

            $this->db->query('INSERT INTO petcare_otp_codes_forgot_password (user_email, otp_code, expired_at) VALUES (:email, :otp, ADDTIME(NOW(), "0:05:00"))');


          

            //bind values
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':otp',$data['otp']);
    
            //execute
            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }
        }

        //get lastest otp code by email

        public function getOtpCodeByEmail($email){

            $this->db->query('SELECT * FROM petcare_otp_codes_forgot_password WHERE user_email = :email ORDER BY created_at DESC LIMIT 1');
            $this->db->bind(':email' , $email);
    
            $row = $this->db->single();
    
            //check row count
    
            if($this->db->rowCount() > 0 ){
                return $row;
            }else{
                return false;
            }
    
        }

        //get lastest otp code user email expire time

        public function getExpireTimeOTPCode($email){

            $this->db->query('SELECT * FROM petcare_otp_codes_forgot_password WHERE user_email = :email ORDER BY created_at DESC LIMIT 1');
            $this->db->bind(':email' , $email);
    
            $row = $this->db->single();
    
            //check row count
    
            if($this->db->rowCount() > 0 ){
                return $row;
            }else{
                return false;
            }
    
        }


        //update password
        public function updatePassword($data){

            if(isset($_SESSION['User_Role']) && $_SESSION['User_Role'] == 'staff'){
                $this->db->query('UPDATE petcare_staff SET password = :password WHERE email = :email');
            }else{

            $this->db->query('UPDATE petcare_petowner SET password = :password WHERE email = :email');
                
            }

            //bind values
            $this->db->bind(':email',$data['email']);
            $this->db->bind(':password',$data['password']);

            //execute
            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }


        }

        public function tempBanUser(){

            if(isset($_SESSION['User_Role']) && $_SESSION['User_Role'] == 'staff'){
                $this->db->query('INSERT INTO petcare_temp_ban (email, role, expire_time) VALUES (:email, :role,ADDTIME(NOW(), "0:30:00"))');

                $this->db->bind(':role','staff');
                

            }else{

            $this->db->query('INSERT INTO petcare_temp_ban (email, role, expire_time) VALUES (:email, :role,ADDTIME(NOW(), "0:30:00"))');

                $this->db->bind(':role','petowner');

            }

            $this->db->bind(':email',$_SESSION['forgotUser_email']);

            //execute
            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }
            
        }

        public function isUserBan($email){

            if(isset($_SESSION['User_Role']) && $_SESSION['User_Role'] == 'staff'){
                $this->db->query('SELECT * FROM petcare_temp_ban WHERE email = :email AND role = :role ORDER BY lock_time DESC LIMIT 1');

                $this->db->bind(':role','staff');
        }else{

            $this->db->query('SELECT * FROM petcare_temp_ban WHERE email = :email AND role = :role ORDER BY lock_time DESC LIMIT 1');

            $this->db->bind(':role','petowner');
        }
        
            $this->db->bind(':email',$email);

            $row = $this->db->single();

            //check row count

            if($this->db->rowCount() > 0 ){

                $expire_time = $row->expire_time;
                $current_time = date("Y-m-d H:i:s");
                if($expire_time > $current_time){
                    return true;
                }
                else{
                    return false;
                }

            }else{
                return false;
            }

        }

       

}