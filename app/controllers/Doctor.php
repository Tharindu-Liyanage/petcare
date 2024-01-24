<?php

    class Doctor extends Controller {

        public function __construct(){

            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Doctor" && $_SESSION['user_role'] != "Nurse"  ){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }
            $this->doctorModel = $this->model('DoctorModel');
            $this->dashboardModel = $this->model('Dashboard');
            $this->settingsModel= $this->model('Settings') ;
           
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $greetingmsg = $this->getWelcomeGreeting();
            $appointmentDetails = $this->getCurrentAppointment();

            $data = [
                'greetingmsg' => $greetingmsg,
                'appointmentDetails' =>$appointmentDetails,
            ];
   
            
            $this->view('dashboards/doctor/index', $data);
        }

        public function getWelcomeGreeting(){
            
              

            $currentTime = date('H:i:s'); // Get the current time in 24-hour format

            if ($currentTime >= '00:00:00' && $currentTime < '12:00:00') {
                return "Good morning!";
            } elseif ($currentTime >= '12:00:00' && $currentTime < '17:00:00') {
                return "Good afternoon!";
            } elseif ($currentTime >= '17:00:00' && $currentTime < '20:00:00') {
                return "Good evening!";
            } else {
                return "Good night!";
            }
        

        }


        public function getCurrentAppointment(){

            $time_slots = $this->dashboardModel->getTimeSlots();
            

            $am_pm = date('a');
            if ($am_pm == 'am') {
                $itisAM = true;
            } else {
                $itisAM = false;
            }

            $dateString = date('Y-m-d');
            $timestamp = strtotime($dateString);
            $dayOfWeek = date('l', $timestamp);
           //to make $daysofweek output first letter simple
            $formattedDay = strtolower(substr($dayOfWeek, 0));

            foreach($time_slots as $timeslots){

                if($timeslots->day == $formattedDay && $itisAM == true && $timeslots->part_of_day == "morning" ){

                    $timeIntervel = $timeslots->intervel;

                    // Convert the time string to a unix timestamp eg:- 30 min to 00:30:00

                    $hours = floor($timeIntervel / 60);
                    $minutes = $timeIntervel % 60;
                    $seconds = 0;

                    // Format the result
                    $time_format = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    break;

                }else if($timeslots->day == $formattedDay && $itisAM == false && $timeslots->part_of_day == "afternoon" ){
                    
                    $timeIntervel = $timeslots->intervel;

                    // Convert the time string to a unix timestamp eg:- 30 min to 00:30:00

                    $hours = floor($timeIntervel / 60);
                    $minutes = $timeIntervel % 60;
                    $seconds = 0;

                    // Format the result
                    $time_format = sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
                    break;

                } 
            

              
        
            }

            
    
            $appointmentDetails = $this->doctorModel->getCurrentAppointmentDB($time_format);

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
              //  $jsonData = json_encode($appointmentDetails);

                // Send the JSON response
              //  header('Content-Type: application/json');
             //   echo $jsonData;
            
                $jsonData = json_encode($appointmentDetails);
              

                // Send the JSON response
               header('Content-Type: application/json');
               echo $jsonData;
        
                
            }else{
                return $appointmentDetails;
            }
           

        }

        public function pastReports(){
                
                $data =null;
    
                $this->view('dashboards/doctor/treatment/checkBeforeTreatment',$data);
        }





        public function appointment(){

            $appintment = $this->doctorModel->getAppointmentByVetID();
            $data =[
                'appointment' => $appintment
            ];

            $this->view('dashboards/doctor/appointment/appointment',$data);
        }

        public function animalward(){

            $data =null;

            $this->view('dashboards/doctor/animalward/animalward',$data);
        }

        public function updateWardTreatment(){

            $data =null;

            $this->view('dashboards/doctor/animalward/updateWardTreatment',$data);
        }

        public function admitPatient(){

            $data =null;

            $this->view('dashboards/doctor/animalward/admitPatient',$data);

        }

        public function pet(){
            $data = null;
            $this->view('dashboards/admin/pet/pet',$data);
        }

        public function blog(){
            $data = null;
            $this->view('dashboards/doctor/blog/blog',$data);
        }

        public function addBlog(){
            $data = null;
            $this->view('dashboards/doctor/blog/addBlog',$data);
        }

        public function updateBlog(){
            $data = null;
            $this->view('dashboards/doctor/blog/updateBlog',$data);
        }

        public function treatment(){
            $data = null;
            $this->view('dashboards/doctor/treatment/treatment',$data);
        }


        public function settings(){
            $user_id = ($_SESSION['user_id']);
            $settingsData = $this->settingsModel->getSettingDetails($user_id);

            $data =[
                'settings' => $settingsData
            ];
            $this->view('dashboards/doctor/setting/settings',$data);
        }

        

    }