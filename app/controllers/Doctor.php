<?php

    class Doctor extends Controller {

        public function __construct(){

            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Doctor"){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }
            $this->doctorModel = $this->model('DoctorModel');
            $this->dashboardModel = $this->model('Dashboard');
            $this->postModel = $this->model('Post');

           
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

        public function requestPastMedicalReports($pet_id,$wardOrNot){


                //get pet age
                $petDetails  =$this->doctorModel-> getPetDetailsByPetID($pet_id);
                

                //error handling if user try to access url with wrong pet id
                if($wardOrNot != "ward" && $wardOrNot != "appointment" && $wardOrNot != "emergency"){
                    redirect('doctor/notfound');
                }

                //error handling if user try to access url with wrong pet id
                if(!isset($petDetails)){
                    redirect('doctor/notfound');
                }
                    
                //get treatment details by pet id
                $treatmentDetails = $this->doctorModel->getTreatmentDetailsByPetID($pet_id);
                $closedTreatmentDetails = $this->doctorModel->getClosedTreatmentDetailsByPetID($pet_id);
                $wardDetails = $this->doctorModel->getWardTreatmentDetailsByPetID($pet_id);

                //get latest treatment id by pet id from appointment table
                $latestTreatmentID = $this->doctorModel->getLatestTreatmentID($pet_id);

                //set pet age
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


        public function addTreatment($id,$trtID){

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                 //get pet details and petowner details by pet id
            $petDetails = $this->doctorModel->getPetDetailsByPetID($id);

            //age calculation
            $petDOB = $petDetails->DOB;
            $visitDate = date("Y-m-d");
            $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);

                $data = [
                    'pet_id' => $id,
                    'trtID' => $trtID,
                    'main_err' => '',
                    'diagnosis' => $_POST['diagnosis'],
                    'treatment_plan' => $_POST['treatment-plan'],
                    'prescription' => $_POST['prescription'],
                    'examination' => $_POST['examination'],
                    'follow-up-reason' => $_POST['follow-up-reason'],
                    'instructions' => $_POST['instruction'],
                    'date' => $_POST['follow-up-date'],
                    'status' => $_POST['status'],
                    'petDetails' => $petDetails,
                    'diagnosis_err' => '',
                    'treatment_plan_err' => '',
                    'prescription_err' => '',
                    'examination_err' => '',
                    'follow-up-reason_err' => '',
                    'instructions_err' => '',
                    'date_err' => '',
                    'status_err' => '',
                    'visit_date' => date("Y-m-d"),

                ];
                
                $error_count =0;

                // Validate data
                if (empty($data['diagnosis'])) {
                    $error_count++;
                    $data['diagnosis_err'] = 'Please enter diagnosis';
                }

                if (empty($data['treatment_plan'])) {
                    $error_count++;
                    $data['treatment_plan_err'] = 'Please enter treatment plan';
                }

                if (empty($data['prescription'])) {
                    $error_count++;
                    $data['prescription_err'] = 'Please enter prescription';
                }

                if (empty($data['examination'])) {
                    $error_count++;
                    $data['examination_err'] = 'Please enter examination';
                }

                

                if (empty($data['instructions'])) {
                    $error_count++;
                    $data['instructions_err'] = 'Please enter instructions';

                }

                if (empty($data['status'])) {
                    $error_count++;
                    $data['status_err'] = 'Please select status';

                }



            
              



        
                // Make sure no errors
                if($error_count == 0){
                    // Validated

                    if (empty($data['date']) && $data['status'] == "Ongoing" && empty($data['follow-up-reason'])) {

                        //this if for if user select status as ongoing and not enter follow up date and follow up reason

                        $data['main_err'] = 'You selected status as ongoing. Please enter follow up date and a reson for follow up';
                        $data['follow-up-reason_err'] = 'Please enter follow up reason';
                        $data['date_err'] = 'Please enter follow up date';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);

                    }else if(!empty($data['date']) && $data['status'] == "Ongoing" && empty($data['follow-up-reason'])){

                        //this if for if user select status as ongoing and not enter follow up reason

                        $data['main_err'] = 'You selected status as ongoing. Please enter a reson for follow up';
                        $data['follow-up-reason_err'] = 'Please enter follow up reason';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);

                    }else if(empty($data['date']) && $data['status'] == "Ongoing" && !empty($data['follow-up-reason'])){

                        //this if for if user select status as ongoing and not enter follow up date

                        $data['main_err'] = 'You selected status as ongoing. Please select a follow up date';
                        $data['date_err'] = 'Please enter follow up date';
                        $data['status_err'] = 'Select status as ongoing';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);
                       
                    }else if(!empty($data['date']) && $data['status'] == "Closed" && !empty($data['follow-up-reason'])){

                        //this if for if user select status as closed and enter follow up date and follow up reason

                        $data['main_err'] = 'You selected status as closed. Please remove follow up date and follow up reason';
                        $data['follow-up-reason_err'] = 'Please remove follow up reason';
                        $data['date_err'] = 'Please remove follow up date';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);

                    }else if(!empty($data['date']) && $data['status'] == "Closed" && empty($data['follow-up-reason'])){

                        //this if for if user select status as closed and enter follow up date and not follow up reason

                        $data['main_err'] = 'You selected status as closed. Please remove follow up date';
                        $data['date_err'] = 'Please remove follow up date';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);
                    }else if(empty($data['date']) && $data['status'] == "Closed" && !empty($data['follow-up-reason'])){

                        //this if for if user select status as closed and not enter follow up date and follow up reason

                        $data['main_err'] = 'You selected status as closed. Please remove follow up reason';
                        $data['follow-up-reason_err'] = 'Please remove follow up reason';

                        //load with errors
                        $this->view('dashboards/doctor/treatment/addTreatment',$data);
                    }
                    
                else{
                        // Validated
                        // Execute
                        if($this->doctorModel->addTreatment($data)){
                            // Redirect to login
                            redirect('doctor/appointment');
                        } else {
                            die('Something went wrong');
                        }
                    }

                }else{

                    //main error with error counts
                    $data['main_err'] = 'Please fill all the fields. You missed '.$error_count.' fields';

                    //load erros
                    $this->view('dashboards/doctor/treatment/addTreatment',$data);

                }

                    



            }else{

            //get pet details and petowner details by pet id
            $petDetails = $this->doctorModel->getPetDetailsByPetID($id);

            //age calculation
            $petDOB = $petDetails->DOB;
            $visitDate = date("Y-m-d");
            $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);

            


                $data = [
                    'pet_id' => $id,
                    'trtID' => $trtID,
                    'main_err' => '',
                    'petDetails' => $petDetails,
                    'diagnosis' =>'',
                    'treatment_plan' => '',
                    'prescription' => '',
                    'examination' => '',
                    'follow-up-reason' =>'',
                    'instructions' => '',
                    'date' =>'',
                    'status' => '',
                ];

            

               $this->view('dashboards/doctor/treatment/addTreatment',$data); 

            }
        }



        public function addWardTreatment($id,$trtID){


            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                 //get pet details and petowner details by pet id
                $petDetails = $this->doctorModel->getPetDetailsByPetID($id);

                //age calculation
                $petDOB = $petDetails->DOB;
                $visitDate = date("Y-m-d");
                $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);

                    $data = [
                        'pet_id' => $id,
                        'trtID' => $trtID,
                        'main_err' => '',
                        'diagnosis' => $_POST['diagnosis'],
                        'treatment_plan' => $_POST['treatment-plan'],
                        'prescription' => $_POST['prescription'],
                        'examination' => $_POST['examination'],
                        'instructions' => $_POST['instruction'],
                        'status' => $_POST['status'],
                        'petDetails' => $petDetails,
                        'diagnosis_err' => '',
                        'treatment_plan_err' => '',
                        'prescription_err' => '',
                        'examination_err' => '',
                        'follow-up-reason_err' => '',
                        'instructions_err' => '',
                        'status_err' => '',

                    ];

                    //die(print_r($data));
                    
                    $error_count =0;

                    // Validate data
                    if (empty($data['diagnosis'])) {
                        $error_count++;
                        $data['diagnosis_err'] = 'Please enter diagnosis';
                    }

                    if (empty($data['treatment_plan'])) {
                        $error_count++;
                        $data['treatment_plan_err'] = 'Please enter treatment plan';
                    }

                    if (empty($data['prescription'])) {
                        $error_count++;
                        $data['prescription_err'] = 'Please enter prescription';
                    }

                    if (empty($data['examination'])) {
                        $error_count++;
                        $data['examination_err'] = 'Please enter examination';
                    }

                    

                    if (empty($data['instructions'])) {
                        $error_count++;
                        $data['instructions_err'] = 'Please enter instructions';

                    }

                    if (empty($data['status'])) {
                        $error_count++;
                        $data['status_err'] = 'Please select status';

                    }



                    if($error_count == 0){
                        // Validated

                        if($this->doctorModel->addWardTreatment($data)){
                            // Redirect to login
                            redirect('doctor/animalward');
                        } else {
                            die('Something went wrong');
                        }
                    }else{

                        //main error with error counts
                        $data['main_err'] = 'Please fill all the fields. You missed '.$error_count.' fields';

                        //load erros
                        $this->view('dashboards/doctor/treatment/addWardTreatment',$data);

                    }




            
            }else{

                 //get pet details and petowner details by pet id
                $petDetails = $this->doctorModel->getPetDetailsByPetID($id);

                //age calculation
                $petDOB = $petDetails->DOB;
                $visitDate = date("Y-m-d");
                $petDetails->DOB = $this->calculateAgeForMedicalReport($petDOB,$visitDate);
 
             
                 $data = [
                     'pet_id' => $id,
                     'trtID' => $trtID,
                     'main_err' => '',
                     'petDetails' => $petDetails,
                     'diagnosis' =>'',
                     'treatment_plan' => '',
                     'prescription' => '',
                     'examination' => '',
                     'instructions' => '',
                     'status' => '',
                 ];
 
                $this->view('dashboards/doctor/treatment/addWardTreatment',$data);

            }

            

        }






        public function appointment(){

            $appintment = $this->doctorModel->getAppointmentByVetID();
            $data =[
                'appointment' => $appintment
            ];

            $this->view('dashboards/doctor/appointment/appointment',$data);
        }

        public function animalward(){

            //get animal ward details
           $wardDetails = $this->doctorModel->getAnimalWardDetails();
           $counOfCage = $this->doctorModel->getCageCountAll();

            $data = [
                'animalward' => $wardDetails,
                'cageCount' => $counOfCage
            ];

            $this->view('dashboards/doctor/animalward/animalward',$data);
        }

        public function updateWardTreatment(){

            $data =null;

            $this->view('dashboards/doctor/animalward/updateWardTreatment',$data);
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

        public function blog(){
            $blog = $this->postModel->getPosts();
            $data = [
                'blog' => $blog
            ];
            $this->view('dashboards/doctor/blog/blog',$data);
        }

        public function updateBlog($id){

            $categories = $this->doctorModel->getBlogCategoryDetails();
            
            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                 $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                  if (isset($_FILES['blog_img'])) {
                    $uploadedFileName = $_FILES['blog_img']['name'];
                    $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                    // Generate a timestamp for uniqueness
                    $timestamp = time();

                    // Create a unique ID by concatenating values and adding the file extension
                    $uniqueImgFileName = $_POST['title'] . '_' . $_SESSION['user_id'] . '_' . $timestamp . '.' . $fileExtension;

                }

                $data = [
                    'title' => trim($_POST['title']),
                    'category' => trim($_POST['category']),
                    'user_id' => $_SESSION['user_id'],
                    'category_err' => '',
                    'content' => trim($_POST['content']),
                    'title_err' => '',
                    'content_err' => '',
                    'img' => ($_FILES['blog_img']['error'] === UPLOAD_ERR_NO_FILE) ? null : $_FILES['blog_img'],
                    'img_err' => '',
                    'categories' => $categories,
                    'uniqueImgFileName' =>$uniqueImgFileName,
                    'id' => $id
                 ];


                //  $this->view('dashboards/doctor/blog/addBlog',$data);



                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter the title';
                 }

                 if(empty($data['content'])){
                    $data['content_err'] = 'Please fill the content field';
                 }

                

                 if($data['category'] == "Select Category"){
                    $data['category_err'] = 'Please select a category';
                 }

                $allowedTypes = ['image/jpeg', 'image/png'];

                 if(empty($data['img'])){
                    $data['img_err'] = 'Please choose a Thumnail Photo';
                 }elseif(!isset($_FILES['blog_img']['type']) || ($_FILES['blog_img']['type'] && !in_array($_FILES['blog_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                 }elseif(isset($_FILES['blog_img'])){
                   
                    $dimensions = getimagesize($_FILES['blog_img']['tmp_name']);
                    $width = $dimensions[0];
                    $height = $dimensions[1];
                    
                    // Check if the image is portrait-oriented (height > width)
                    if($height > $width){
                        

                        $data['img_err'] = 'Sorry, only landscape-oriented images are allowed.';

                    } 
                }elseif($_FILES['blog_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }


               
                 
                 
                if(empty($data['title_err']) && empty($data['content_err']) && empty($data['img_err'])  &&  empty($data['category_err'])){
                    if($this->postModel->updateBlog($data)){
                       
                        redirect('doctor/blog');
                        
                        
                     }else{
                         die("Something went wrong");
                     }
                 }else{
                    
                    //load with errors
                    $this->view('dashboards/doctor/blog/updateBlog',$data);

                 }

                 

            }else{

                $post = $this->postModel->getPostById($id);

                $data = [
                    'id' => $id,
                    'title' => $post->title,
                    'category' => $post->category,
                    // 'tags' => $post->tags,
                    'img' => $post->thumbnail,
                    'content' => $post->content,
                    'title_err' => '',
                    'content_err' => '',
                    'img_err' => '',
                    'category_err' => '',
                    'categories' => $categories,
                    
                 ];


                 //validate

                 

                //  print_r($data['title_err']);
                 $this->view('dashboards/doctor/blog/updateBlog',$data);

            }



            
        }

        public function deleteBlog($id){
            // if($_SERVER['REQUEST_METHOD'] == 'POST'){
                // die ("delete");
                if($this->postModel->deleteBlog($id)){
                    
                    
                      

                }else{

                    die ('something went wrong');

                }
            // // }else{
            //     redirect('doctor/blog');
            // // }
        }

        public function addBlog(){

            //get categories
            $categories = $this->doctorModel->getBlogCategoryDetails();


            if($_SERVER['REQUEST_METHOD'] == 'POST'){

                 $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

                 

                 if (isset($_FILES['blog_img'])) {
                    $uploadedFileName = $_FILES['blog_img']['name'];
                    $fileExtension = pathinfo($uploadedFileName, PATHINFO_EXTENSION);  // Extract the file extension

                    // Generate a timestamp for uniqueness
                    $timestamp = time();

                    // Create a unique ID by concatenating values and adding the file extension
                    $uniqueImgFileName = $_POST['title'] . '_' . $_SESSION['user_id'] . '_' . $timestamp . '.' . $fileExtension;

                }

                 $data = [
                    'title' => trim($_POST['title']),
                    'category' => trim($_POST['category']),
                    'user_id' => $_SESSION['user_id'],
                    'category_err' => '',
                    'content' => trim($_POST['content']),
                    'title_err' => '',
                    'content_err' => '',
                    'img' => ($_FILES['blog_img']['error'] === UPLOAD_ERR_NO_FILE) ? null : $_FILES['blog_img'],
                    'img_err' => '',
                    'categories' => $categories,
                    'uniqueImgFileName' =>$uniqueImgFileName
                 ];



                //  $this->view('dashboards/doctor/blog/addBlog',$data);



                if(empty($data['title'])){
                    $data['title_err'] = 'Please enter the title';
                 }

                 if(empty($data['content'])){
                    $data['content_err'] = 'Please fill the content field';
                 }

          /*       $allowedTypes = ['image/jpeg', 'image/png'];

                 if(empty($data['img'])){
                    $data['img_err'] = 'Please choose a Thumnail Photo';
                 }elseif(!isset($_FILES['blog_img']['type']) || ($_FILES['blog_img']['type'] && !in_array($_FILES['blog_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                 }elseif(isset($_FILES['blog_img'])){
                   
                    $dimensions = getimagesize($_FILES['blog_img']['tmp_name']);
                    $width = $dimensions[0];
                    $height = $dimensions[1];
                    
                    // Check if the image is portrait-oriented (height > width)
                    if($height > $width){
                        

                        $data['img_err'] = 'Sorry, only landscape-oriented images are allowed.';

                    } 
                }elseif($_FILES['blog_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }


                */

                


                 if($data['category'] == "Select Category"){
                    $data['category_err'] = 'Please select a category';
                 }

                $allowedTypes = ['image/jpeg', 'image/png'];

                 if(empty($data['img'])){
                    $data['img_err'] = 'Please choose a Thumnail Photo';
                 }elseif(!isset($_FILES['blog_img']['type']) || ($_FILES['blog_img']['type'] && !in_array($_FILES['blog_img']['type'], $allowedTypes))) {
                    // Invalid file type
                    $data['img_err'] = 'Invalid file type. Please upload an image (JPEG or PNG).';
                 }elseif(isset($_FILES['blog_img'])){
                   
                    $dimensions = getimagesize($_FILES['blog_img']['tmp_name']);
                    $width = $dimensions[0];
                    $height = $dimensions[1];
                    
                    // Check if the image is portrait-oriented (height > width)
                    if($height > $width){
                        

                        $data['img_err'] = 'Sorry, only landscape-oriented images are allowed.';

                    } 
                }elseif($_FILES['blog_img']['size'] > 5 * 1024 * 1024 ){ // 5MB in bytes
                    $data['img_err'] = 'Image size must be less than 5 MB';
                }

               

             
                 //handle error in img here
                 /*
                    mandotary to upload image before post

                    1.file not upload
                    2.dimension
                    3. img type jpg or png

                    need to update method , remove tags , 
                    
                    img dir -> storage/uploads/blogs 
                    img uniquefile name insert to the db
                 */

                 
                 if(empty($data['title_err']) && empty($data['content_err']) && empty($data['img_err'])  &&  empty($data['category_err'])){
                    if($this->postModel->addBlog($data)){
                       
                        redirect('doctor/blog');
                        
                        
                     }else{
                         die("Something went wrong");
                     }
                 }else{
                    
                    //load with errors
                    $this->view('dashboards/doctor/blog/addBlog',$data);

                 }

                 

            }else{
                $data = [
                    'title' => '',
                    'category' => '',
                    'content' => '',
                    'title_err' => '',
                    'content_err' => '',
                    'category_err' => '',
                    'img_err' => '',
                    'categories' => $categories,
                 ];


                 //validate

                 

                //  print_r($data['title_err']);
                 $this->view('dashboards/doctor/blog/addBlog',$data);

            }



            
        }

        public function treatment(){
              //getTreatmentDetailsByVetID
              $treatmentDetails = $this->doctorModel->getTreatmentDetailsByVetID();
              $data = [
                  'treatment' => $treatmentDetails
              ];
            $this->view('dashboards/doctor/treatment/treatment',$data);
        }


        public function settings(){
            $data = null;
            $this->view('dashboards/doctor/setting/settings',$data);
        }

       

        

    }