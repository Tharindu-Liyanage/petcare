<?php

class User{

    private $db;

    public function __construct(){

            $this->db = new Database;
    }

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

}