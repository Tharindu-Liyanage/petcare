<?php

    class Assistant extends Controller {

        public function __construct(){
           
            if(!isset($_SESSION['user_id'])){
                
                redirect('users/staff');

            }else{


                if($_SESSION['user_role'] != "Assistant"){

                    // Unauthorized access
                    redirect('users/staff');
                     
                }
            }

            $this->settingsModel= $this->model('Settings') ;

        }

        public function notfound(){
            $data =null;

            $this->view('error/404',$data);
        }

        public function index(){

            $data =null;
   
            
            $this->view('dashboards/assistant/index',$data);
        }

        public function appointment(){

            $data =null;
   
            
            $this->view('dashboards/assistant/appointment/appointment',$data);
        }

        public function addAppointment(){

            $data =null;
   
            
            $this->view('dashboards/assistant/appointment/addAppointment',$data);
        }

        public function petowner(){

            $data =null;
   
            
            $this->view('dashboards/assistant/petowner/petowner',$data);
        }

        public function settings(){

            $user_id = ($_SESSION['user_id']);
            $settingsData = $this->settingsModel->getSettingDetails($user_id);

            $data =[
                'settings' => $settingsData
            ];
            
            $this->view('dashboards/assistant/setting/settings',$data);
        }

    


//========================================================================================================================================================


public function updateAppointment($id){

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        
        //process form

        $_POST = filter_input_array(INPUT_POST,FILTER_SANITIZE_STRING);

        $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);
        $vets = $this->dashboardModel->getVetDetails();
        $time_slots = $this->dashboardModel->getTimeSlots();
        $holidays = $this->dashboardModel->getHolidayDetails();
        $reason = $this->dashboardModel->getAppointmentReasons();
        $treament_data = $this->dashboardModel->getTreatmentDetailsByUserIDOnlyOngoing($_SESSION['user_id']);
        $appointmentDetails = $this->dashboardModel->getAppointmentDetailsByID($id, $_SESSION['user_id']);
        
        $data= [
            'appointment_id' => $id,
            'vet_post' => trim($_POST['vet']),
            'reason_post' => trim($_POST['reason']),
            'pet_post' => trim($_POST['pet']),
            'date_post' => trim($_POST['date']),
            'time_post' => trim($_POST['time']),
            'treatment_post' => trim($_POST['treatment']),
            'pet' =>$pets,
            'time_slots' => $time_slots,
            'vet' => $vets,
            'holiday' => $holidays,
            'reason' => $reason,
            'medicalreport' =>$treament_data,
            'appointment_details' => $appointmentDetails,
            'main_err' => ''
        ];

         //checkavailability
         $isBooked = $this->dashboardModel->checkAvailability($data['time_post'], $data['date_post'], $data['vet_post']); // give true mean availbe
         $isLocked = $this->dashboardModel->checkTimeSlotIsLocked($data['time_post'], $data['date_post'], $data['vet_post']);


       // die(var_dump($data['vet_post'], $data['reason_post'], $data['pet_post'], $data['date_post'], $data['time_post'], $data['treatment_post'], $appointmentDetails));

       // ...

                // check anything new update or not
                if (
                    (int)$appointmentDetails->vet_id == (int)$data['vet_post'] &&
                    $appointmentDetails->appointment_type == $data['reason_post'] &&
                    (int)$appointmentDetails->pet_id == (int)$data['pet_post'] &&
                    $appointmentDetails->appointment_date == $data['date_post'] &&
                    $appointmentDetails->appointment_time == $data['time_post'] &&
                    (
                        is_numeric($data['treatment_post']) 
                        ? (int)$appointmentDetails->treatment_id == (int)$data['treatment_post'] 
                        : $data['treatment_post'] == "NONE"
                    )
                ) {
                    $data['main_err'] = "No changes were detected. The data remains as is.";
                
                }else if(!$isBooked){
                   
                    $data['main_err'] = "The selected time slot is already booked. Please select another time slot.";
                   
                }else if($isLocked){
                    $data['main_err'] = "The selected time slot is locked. Please select another time slot or try again later.";
                }else{

                    //selected data is holiday?
                    $isHoliday = $this->dashboardModel->getHolidayDetails();

                    $dateString = $data['date_post'];
                    $timestamp = strtotime($dateString);
                    $dayOfWeek = date('l', $timestamp);
                   //to make $daysofweek output first letter simple
                    $formattedDay = strtolower(substr($dayOfWeek, 0));


                    foreach($isHoliday as $holidays){

                            if($holidays->day == $formattedDay){
                                $isHoliday = true;
                                break;
                            }else{
                                $isHoliday = false;
                            }  
                    
                    }

                    // Current time
                    $currentDateTime = new DateTime();
                    $currentTimestamp = $currentDateTime->getTimestamp();

                    $timestamp1 = strtotime($data['time_post']);
                    $today = date('Y-m-d');



                    if($isHoliday){
                        $data['main_err'] = "The selected date is a holiday. Please select another date.";
                    }else if($timestamp1 < $currentTimestamp && ($today == $data['date_post'])){
                        $data['main_err'] = "The selected time slot is already passed. Please select another time slot.";
                    }else{
                        
                        
                        if($this->dashboardModel->updateAppointment($data)){

                            redirect('petowner/appointment');
                            
                        }else{
                            die("Something went wrong in update Appointment");
                        }
                    }
                        
                    
                    
                }
            

            // check errors
            if (empty($data['main_err'])) {
                // process the form, as there are no errors
            } else {
                // load errors
                $this->view('dashboards/petowner/appointment/updateAppointment', $data);
            }


    }else{

        $appointmentDetails = $this->dashboardModel->getAppointmentDetailsByID($id, $_SESSION['user_id']);

        if($appointmentDetails == null){   //if no data found : its mean user try to access url with wrong appointment id(intentionally)
            redirect('petowner/appointment');
        }


        $pets = $this->dashboardModel->getPetDetailsByPetownerID($_SESSION['user_id']);
        $vets = $this->dashboardModel->getVetDetails();
        $time_slots = $this->dashboardModel->getTimeSlots();
        $holidays = $this->dashboardModel->getHolidayDetails();
        $reason = $this->dashboardModel->getAppointmentReasons();
        $treament_data = $this->dashboardModel->getTreatmentDetailsByUserIDOnlyOngoing($_SESSION['user_id']);

        $data = [
            'appointment_id' => $id,
            'pet' =>$pets,
            'time_slots' => $time_slots,
            'vet' => $vets,
            'holiday' => $holidays,
            'reason' => $reason,
            'medicalreport' =>$treament_data,
            'appointment_details' => $appointmentDetails,
            'vet_err' => '',
            'reason_err' => '',
            'pet_err' => '',
            'date_err' => '',
            'time_err' => '',
            'treatment_err' => '',
            'main_err' => ''

        ];
        
        $this->view('dashboards/petowner/appointment/updateAppointment', $data);



    }    
   
}
    }