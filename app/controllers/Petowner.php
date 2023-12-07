<?php

    class Petowner extends Controller {

        public function __construct(){
           
            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Pet Owner"){

                    // Unauthorized access
                    redirect('users/login');
                     
                }
            }

            $this->dashboardModel = $this->model('Dashboard');
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/petowner/index', $data);
        }


        public function pet(){

            $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);

            $data = [
                'pet' =>$pets
            ];

            $this->view('dashboards/petowner/pet/pet',$data);
        }


        public function addPet(){

            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'pname' => trim($_POST['pname']),
                    'dob' => trim($_POST['dob']),
                    'species' => trim($_POST['species']),
                    'sex' => trim($_POST['sex']),
                    'breed' => trim($_POST['breed']),
                    'age' => trim($_POST['age']),
                    'age_err' => '',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>''
            
                ];

              
                

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please pet name';
                }

                //validate brand
                if(empty($data['dob'])){
                    $data['dob_err'] = 'Please enter DOB';
                }

                //validate address
                if(empty($data['species'])){
                    $data['species_err'] = 'Please enter Species';
                }


                if (empty($data['sex'])) {
                    $data['sex_err'] = 'Please select Sex';
                }

                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter a price';
                }

                if (empty($data['age'])) {
                    $data['age_err'] = 'Please enter Age';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['breed_err']) && empty($data['sex_err']) && empty($data['cat_err']) &&  empty($data['dob_err']) &&   empty($data['age_err'])){
                    //validated
                    
                   
                    

                    //add product

                    if($this->dashboardModel->addPetDetails($data)){
                       
                       // $_SESSION['staff_user_added'] = true;
      
                       redirect('petowner/pet');

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/petowner/pet/addPet', $data);
                    
                    

                }


            }else{

                //init data
                $data = [
                    'pname' => '',
                    'dob' => '',
                    'species' => '',
                    'sex' =>'',
                    'breed' =>'',
                    'age' =>'',
                    'age_err' => '',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>''
            
                ];

                
                //load view
                $this->view('dashboards/petowner/pet/addPet', $data);
            }
   
            
        }


        public function updatePet($id){

            
            //check for POST
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                
                //process form

                $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                //init data

                $data = [
                    'id' => $id,
                    'pname' => trim($_POST['pname']),
                    'dob' => trim($_POST['dob']),
                    'species' => trim($_POST['species']),
                    'sex' => trim($_POST['sex']),
                    'breed' => trim($_POST['breed']),
                    'age' => trim($_POST['age']),
                    'age_err' => '',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>''
            
                ];

              
                

            
                //validate pName
                if(empty($data['pname'])){
                    $data['pname_err'] = 'Please enter Pet Name';
                }

                //validate brand
                if(empty($data['dob'])){
                    $data['dob_err'] = 'Please enter DOB';
                }

                //validate address
                if(empty($data['sex'])){
                    $data['sex_err'] = 'Please select Sex';
                }


                if (empty($data['age'])) {
                    $data['age_err'] = 'Please enter Age';
                }

                if (empty($data['breed'])) {
                    $data['breed_err'] = 'Please enter breed';
                }

               

                if (empty($data['species'])) {
                    $data['species_err'] = 'Please enter Species';
                }
                

                

                //Make sure errors are empty

                if(empty($data['pname_err']) && empty($data['breed_err']) && empty($data['age_err']) && empty($data['species_err']) && empty($data['sex_err'])){
                    //validated
                    
                   
                   

                    //add product

                    if($this->dashboardModel->updatePetDetails($data)){
                       
                       // $_SESSION['staff_user_added'] = true;
                     
                       redirect('petowner/pet');
                       

                    }else{
                        die("Something went wrong");
                    }



                }else{

                    
                    //load view with errors
                    $this->view('dashboards/petowner/pet/updatePet', $data);
                    
                    

                }


            }else{

                $pet =$this->dashboardModel-> getPetDetailsByID($id);



                //init data
                $data = [
                    'id' => $id,
                    'pname' => $pet ->pet,
                    'dob' => $pet -> DOB,
                    'species' => $pet -> species,
                    'sex' => $pet -> sex,
                    'breed' => $pet -> breed,
                    'age' => $pet -> age,
                    'age_err' =>'',
                    'pname_err' => '',
                    'dob_err' => '',
                    'species_err' => '',
                    'sex_err' => '',
                    'breed_err'  =>''
            
            
                ];

                
                //load view
                $this->view('dashboards/petowner/pet/updatePet', $data);
            }
   

        }


        public function removePet($id){

            if($this->dashboardModel->removePetDetails($id)){

                //$_SESSION['staff_user_removed'] = true;
                redirect('petowner/pet');

            }else{
                die("error in user delete model");
            }
            
        }



        /*Appointment here */

        public function appointment(){

            
            $appointments = $this->dashboardModel->getAppointmentDetailsByPetOwner($_SESSION['user_id']);
            
         


        $data = [
            'appointment' =>$appointments
        ];

           
            $this->view('dashboards/petowner/appointment/appointment', $data);
        }

        public function addAppointment(){

            $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);

            $data = [
                'pet' =>$pets
            ];

            $this->view('dashboards/petowner/appointment/addAppointment', $data);
        }

        public function updateAppointment(){

            $data = null;
            $this->view('dashboards/petowner/appointment/updateAppointment', $data);
        }


        public function checkoutAppointment(){
           
           
            require __DIR__ . '/../libraries/stripe/vendor/autoload.php';
            \Stripe\Stripe::setApiKey('sk_test_51OIDiCEMWpdWcJS8G3LlaRo4qgZbpY9h0FHWQLqWZOLJEg7eVJDCQkGQLS14M2KkUuGWoiDbfdOFJbRuNR7eUNSK004utEcz6Y');
            
            
            // Create a payment session
            $paymentSession = \Stripe\Checkout\Session::create([
                'payment_method_types' => ['card'],
                'mode' => 'payment', // Set mode to 'payment' for one-time payments
                'line_items' => [[
                    'price' => 'price_1OIZwlEMWpdWcJS8zC9MFJoR', // Use the price ID, not the product ID
                    'quantity' => 1,
                    

                ]],
                'success_url' => 'http://localhost/petcare/petowner/appointment',
                'cancel_url' => 'http://localhost/petcare/petowner/',
            ]);
        
            // Redirect to the Payment Link URL
            header('Location: ' . $paymentSession->url);

        }

        public function appointmentSuccess(){

        }
        
        

        public function animalWard(){

            $data = null;
            $this->view('dashboards/petowner/animalward/animalward', $data);
        }

        public function settings(){

            $data = null;
            $this->view('dashboards/petowner/setting/settings', $data);
        }

        
}
            
        


        
    
    
 
