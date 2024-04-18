<?php

    class Nurse extends Controller {

        public function __construct(){

            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Nurse"){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }
            $this->settingsModel= $this->model('Settings') ;
            $this->doctorModel = $this->model('DoctorModel');
            $this->dashboardModel = $this->model('Dashboard');
            $this->postModel = $this->model('Post');
            $this->nurseModel = $this->model('NurseModel');
        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $greetingmsg = $this->getWelcomeGreeting();
            //$appointmentDetails = $this->getCurrentAppointment();

            $data = [
                'greetingmsg' => $greetingmsg,
                //'appointmentDetails' =>$appointmentDetails,
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


        

       

        public function requestPastMedicalReports($pet_id,$wardOrNot){

            
            

                    
                //get treatment details by pet id
                $treatmentDetails = $this->doctorModel->getTreatmentDetailsByPetID($pet_id);
                $closedTreatmentDetails = $this->doctorModel->getClosedTreatmentDetailsByPetID($pet_id);
                $wardDetails = $this->doctorModel->getWardTreatmentDetailsByPetID($pet_id);

                //get latest treatment id by pet id from appointment table
                $latestTreatmentID = $this->doctorModel->getLatestTreatmentID($pet_id);

                //get pet age
                $petDetails  =$this->doctorModel-> getPetDetailsByPetID($pet_id);
                $petDOB = $petDetails->DOB;
                $visitDate = date("Y-m-d");
                $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);

                $data = [
                    'treatmentDetails' => $treatmentDetails,
                    'closedTreatmentDetails' => $closedTreatmentDetails,
                    'latestTreatmentID' => $latestTreatmentID,
                    'petDetails' => $petDetails,
                    'pet_id' => $pet_id,
                    'wardDetails' => $wardDetails,
                    'wardOrNot' => $wardOrNot
                ];
    
                $this->view('dashboards/doctor/treatment/checkBeforeTreatment',$data);

        }

        public function viewMedicalReport($id){
                
                $medicalReport = $this->doctorModel->getTreatmentDetailsByTreatmentID($id);
                //hospital info from dashboard model 
                $hospitalInfo = $this->dashboardModel->getPetCareDetails();  
                
                if($medicalReport == null){   //if no data found : its mean user try to access url with wrong treatment id(intentionally)
                    redirect('doctor/appointment');
                }
    
                foreach ($medicalReport as $treament) {
                    // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                    $petDOB = isset($treament->DOB) ? $treament->DOB : null;
                    $visitDate = isset($treament->visit_date) ? $treament->visit_date : null;
            
                    $treament->petAge = $this->calculateAgeForMedicalReport($petDOB,$visitDate);
                }
               
    
                $data = [
                    'medicalreportview' => $medicalReport,
                    'petcareInfo' => $hospitalInfo
                ];
    
                $this->view('dashboards/doctor/treatment/viewMedicalReport',$data);
        }

        public function viewWardMedicalReport($id){
                
            $medicalReport = $this->doctorModel->getWardTreatmentDetailsByTreatmentID($id);
            //hospital info from dashboard model 
            $hospitalInfo = $this->dashboardModel->getPetCareDetails();  
            
            if($medicalReport == null){   //if no data found : its mean user try to access url with wrong treatment id(intentionally)
                redirect('doctor/animalward');
            }

            foreach ($medicalReport as $treament) {
                // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                $petDOB = isset($treament->DOB) ? $treament->DOB : null;
                $visitDate = isset($treament->lastupdate) ? $treament->lastupdate : null;
        
                $treament->petAge = $this->calculateAgeForMedicalReport($petDOB,$visitDate);
            }
           

            $data = [
                'medicalreportview' => $medicalReport,
                'petcareInfo' => $hospitalInfo
            ];

            $this->view('dashboards/doctor/treatment/viewWardMedicalReport',$data);
    }

        public function calculateAgeForMedicalReport($birthdate,$visitDate) {

            /* Age cannot be changed in Report so get different between birthDate and VisitDate */

            // Create a DateTime object from the birthdate
            $birthdate = new DateTime($birthdate);
            
            // Get the current date
            $visitDate = new DateTime($visitDate);
            
            // Calculate the difference in years and months
            $ageInterval = $visitDate->diff($birthdate);
        
            $years = $ageInterval->y;
            $months = $ageInterval->m;
            $days = $ageInterval->d;
        
            // Build the age string
            $ageString = '';
            if ($years > 0) {
                $ageString .= "$years" . " Years ";
            }
            if ($months > 0) {
                $ageString .= "$months" . " Months";
            }
            if ($days > 0 && $months == 0 && $years == 0) {
                $ageString .= "$days" . " Days";
            }
        
            return $ageString;
        }





       


        public function animalward(){

            //get animal ward details
            $wardDetails = $this->doctorModel->getAnimalWardDetails();
            $counOfCage = $this->doctorModel->getCageCountAll();
            $dischargeDetails = $this->doctorModel->getDischargePets();
 
             $data = [
                 'animalward' => $wardDetails,
                 'cageCount' => $counOfCage,
                 'dischargeDetails' => $dischargeDetails
             ];
 
             $this->view('dashboards/doctor/animalward/animalward',$data);
        }

        

        public function addmitPet($petid,$reason){

            $reason_text = str_replace('-', ' ', $reason);

            $data =[
                'petid' => $petid,
                'reason' => $reason_text
            ];

           //addmit pet to the ward
              $this->doctorModel->addmitPetToWard($data);
              

            redirect('doctor/animalward');

        }

        public function pet(){
            
            //get all pet details
            $petDetails = $this->doctorModel->getAllPetDetails();

            //age calculation by calculateAge function
            foreach ($petDetails as $pet) {
                // Assuming 'DOB' is the property name, replace it with the correct property name if needed
                $petDOB = isset($pet->DOB) ? $pet->DOB : null;
                $pet->DOB = $this->calculateAge($petDOB);
            }


            $data = [
                'pet' => $petDetails
            ];


            $this->view('dashboards/doctor/pet/pet',$data);
        }


        public function calculateAge($birthdate) {
            // Create a DateTime object from the birthdate
            $birthdate = new DateTime($birthdate);
            
            // Get the current date
            $currentDate = new DateTime();
            
            // Calculate the difference in years, months, and days
            $ageInterval = $currentDate->diff($birthdate);
        
            $years = $ageInterval->y;
            $months = $ageInterval->m;
            $days = $ageInterval->d;
        
            // Build the age string
            $ageString = '';
            if ($years > 0) {
                $ageString .= "$years" . " Years ";
            }
            if ($months > 0 ) {
                $ageString .= "$months" . " Months ";
            }
            if ($days > 0 && $months == 0 && $years == 0) {
                $ageString .= "$days" . " Days";
            }
        
            return $ageString;
        }

       

      


        public function settings(){
            $data = null;
            $this->view('dashboards/doctor/setting/settings',$data);
        }

        public function medicalBillCalculate($trtID){

            //is server req post?
            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                //sanitize post array
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                $data = [
                    'trtID' => $trtID,
                    'services' => $_POST['service'],
                    'prices' =>$_POST['price'],
                    
                ];

                //prepare medical bill

                $this->nurseModel->prepareMedicalBill($data);

                redirect('nurse/medicalBill');

            }else{

            
                ///get addmit and discharge date
                $addmitDischargeDate = $this->nurseModel->getAddmitDischargeDate($trtID);

                //difference between addmit and discharge date
                $admitDate = new DateTime($addmitDischargeDate->admit_date);
                $dischargeDate = new DateTime($addmitDischargeDate->discharge_date);
                $interval = $admitDate->diff($dischargeDate);
                $days = $interval->format('%a');

                if($days == 0){
                    $days = 1;
                }


                $data = [
                    'daysDiff' => $days,
                    'details' => $addmitDischargeDate,
                    'trtID' => $trtID
                ];
                $this->view('dashboards/nurse/medicalBill/prepareMedicalBill',$data);

            }
        }

        public function medicalBill(){
            

            $medicalBillDetails = $this->nurseModel->getDischargeDetails();

            $data = [
                'bill' => $medicalBillDetails
            ];


            $this->view('dashboards/nurse/medicalBill/medicalBill',$data);
        }

        

    }