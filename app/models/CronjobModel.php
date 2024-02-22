<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

   

    class CronjobModel {
        private $db;

        public function __construct(){
            $this->db = new Database;
        }



        public function unlockTimeSlot(){

            $this->db->query('UPDATE petcare_temp_lock_timeslots SET status = 0 WHERE end_time < NOW() AND status = 1');
            
            
            if($this->db->execute()){
                return true;
    
            }else{
                return false;
            }
        }

        /*
            *this is for pet owners who forgot to book appointment for treatment their pets.
            *This will send email to pet owners 7 days before the follow up date
        */
        public function sendReminderAppointment(){

            date_default_timezone_set('Asia/Kolkata');

            /*
                *this query will get all the appointments that are not pending or confirmed and the appointment date is 7 days from now
                and get treatment id in appotinemnt table with latest appointment date accoring to treatment_id
                *if null in the treatment_id in latest appointment nothing happened normally give previous appointmenmt with treatment id, 
            */
            $this->db->query(
                
                'SELECT 
                report.*,
                petowner.id AS petownerID,
                petowner.email AS petownerEmail,
                petowner.first_name AS petownerfirstname,
                petowner.last_name AS petownerlastname,
                petowner.mobile AS petownerMobile,
                pet.pet AS petname,
                pet.pet_id_generate AS petGenID,
                staff.firstname AS vetfname,
                staff.lastname AS vetlname,
                appointment.status AS appointment_status,
                appointment.treatment_id AS appointment_treatment_id
            FROM 
                petcare_medical_reports report
            JOIN 
                petcare_pet pet ON report.pet_id = pet.id
            JOIN 
                petcare_staff staff ON report.veterinarian_id = staff.staff_id
            JOIN 
                petcare_petowner petowner ON petowner.id = report.owner_id
            LEFT JOIN (
                SELECT 
                    treatment_id,
                    MAX(appointment_date) AS latest_appointment_date
                FROM 
                    petcare_appointments appointment
                GROUP BY 
                    treatment_id
            ) latest_appointments ON latest_appointments.treatment_id = report.treatment_id
            LEFT JOIN 
                petcare_appointments appointment ON appointment.treatment_id = report.treatment_id 
                                                   AND appointment.appointment_date = latest_appointments.latest_appointment_date
            WHERE 
                (report.treatment_id, report.visit_date) IN (
                    SELECT 
                        treatment_id,
                        MAX(visit_date) AS max_visit_date
                    FROM 
                        petcare_medical_reports
                    GROUP BY 
                        treatment_id
                ) AND petowner.isRemoved = 0 AND pet.isRemoved = 0 AND appointment.pet_id = report.pet_id
                
            ');

            $petownersWhoNotBookedAppointment = $this->db->resultSet();

            
            /* 
                **Important
                    
                     //there is a logic need to work below code 
                      , when add a treatment after a new one , 
                      treatnment_id NULL so need to update that appointment with new treatment id 
                      otherwise not remind sent to petowner bcz i check appointment_treatment_id != NULL
            */

           

           

            foreach ($petownersWhoNotBookedAppointment as $results) {

                    
                    //this if check if the appointment is not pending or confirmed and the appointment date is 7 days from now and get treatment id in appotinemnt table with latest appointment date
                    if( $results->status == 'Ongoing' &&
                        $results->week_before_reminder_sent == 0 &&
                        $results->followup_date == date('Y-m-d', strtotime('+7 days')) && //add 7days to current date
                        $results->appointment_status != 'Pending' &&
                        $results->appointment_status != 'Confirmed' &&
                        $results->appointment_treatment_id != NULL //equal NULL mean pet owner already booked appointment for the new treatment
                        ){

                            $day ='7 days';
                            $this->sendEmailForAppointmentBook($results->treatment_id, $results->petownerEmail, $results->petname,$results->followup_date,$results->followup_reason,$results->petownerfirstname,$results->petownerlastname,$day);
                            $msg = "Hi $results->petownerfirstname $results->petownerlastname, just a friendly reminder that your furry friend $results->petname needs a treatment on $results->followup_date. We recommend booking an appointment now to ensure their timely care. Visit our website to book your slot!";
                            $this->sendSMSNotificaton($results,$msg);
                            
                            //update week_before_reminder_sent to 1
                            $this->db->query('UPDATE petcare_medical_reports SET week_before_reminder_sent = 1 WHERE treatment_id = :treatment_id AND visit_date = :visit_date');
                            $this->db->bind(':treatment_id', $results->treatment_id);
                            $this->db->bind(':visit_date', $results->visit_date);
                            $this->db->execute();

                            

                    }else if(
                            $results->status == 'Ongoing' &&
                            $results->day_before_reminder_sent == 0 &&
                            $results->followup_date == date('Y-m-d', strtotime('+1 days')) &&
                            $results->appointment_status != 'Pending' &&
                            $results->appointment_status != 'Confirmed' &&
                            $results->appointment_treatment_id != NULL
                            ){

                                $day ='Tommorow';
                                $this->sendEmailForAppointmentBook($results->treatment_id, $results->petownerEmail, $results->petname,$results->followup_date,$results->followup_reason,$results->petownerfirstname,$results->petownerlastname,$day);
                                $msg = "Hi $results->petownerfirstname $results->petownerlastname, a gentle nudge! Your furry friend $results->petname's treatment is tomorrow, $results->followup_date. Don't forget to book an appointment today to avoid any delays.See you soon!";
                                $this->sendSMSNotificaton($results,$msg);
                                //update day_before_reminder_sent to 1
                                $this->db->query('UPDATE petcare_medical_reports SET day_before_reminder_sent = 1 WHERE treatment_id = :treatment_id AND visit_date = :visit_date');
                                $this->db->bind(':treatment_id', $results->treatment_id);
                                $this->db->bind(':visit_date', $results->visit_date);
                                $this->db->execute();


                    }else if(
                        $results->status == 'Ongoing' &&
                        $results->day_after_reminder_sent == 0 &&
                        $results->followup_date == date('Y-m-d', strtotime('-1 days')) &&
                        $results->appointment_status != 'Pending' &&
                        $results->appointment_status != 'Confirmed' &&
                        $results->appointment_treatment_id != NULL
                        ){

                            $day ='Yesterday';

                            $this->sendEmailForAppointmentBook($results->treatment_id, $results->petownerEmail, $results->petname,$results->followup_date,$results->followup_reason,$results->petownerfirstname,$results->petownerlastname,$day);
                            $msg = "Hi $results->petownerfirstname $results->petownerlastname, we noticed that $results->petname missed their treatment scheduled for $results->followup_date. We're concerned about their well-being and would love to get them back on track.Please reschedule their treatment as soon as possible.";
                            $this->sendSMSNotificaton($results,$msg);
                            
                            //update day_after_reminder_sent
                            $this->db->query('UPDATE petcare_medical_reports SET day_after_reminder_sent = 1 WHERE treatment_id = :treatment_id AND visit_date = :visit_date');
                            $this->db->bind(':treatment_id', $results->treatment_id);
                            $this->db->bind(':visit_date', $results->visit_date);
                            $this->db->execute();

                    }

                }
                    

                   

                //this for pet owners who booked appointment for treatment their pets.

                   $this->db->query(
                
                    'SELECT 
                        appointment.*,
                        petowner.email AS petownerEmail,
                        petowner.first_name AS petownerfirstname,
                        petowner.last_name AS petownerlastname,
                        petowner.mobile AS petownerMobile,
                        pet.pet AS petname,
                        pet.pet_id_generate AS petGenID,
                        staff.firstname AS vetfname,
                        staff.lastname AS vetlname,
                        appointment.status AS appointment_status,
                        appointment.treatment_id AS appointment_treatment_id

  
                    FROM petcare_appointments appointment 
    
                    JOIN 
                        petcare_pet pet ON appointment.pet_id = pet.id
                    JOIN 
                        petcare_staff staff ON appointment.vet_id = staff.staff_id
                    JOIN 
                    petcare_petowner petowner ON petowner.id = appointment.petowner_id
                    WHERE ( appointment.status="Confirmed") AND petowner.isRemoved = 0 AND pet.isRemoved = 0'
                    
                    );

                    $petownersWhoBookedAppointment = $this->db->resultSet();

                    foreach ($petownersWhoBookedAppointment as $appointmentResults) {

                        if($appointmentResults->appointment_date == date('Y-m-d', strtotime('+1 days')) &&
                            $appointmentResults->day_before_reminder_sent == 0 ){

                             $filePath = __DIR__ . '/../views/email/appointmentReminderForBooked.php';
                             $subject = "Heads up! Tomorrow's the purrfect day for your pet's appointment!";

                             // Your original message using $appointmentResults properties directly
                            $msg = "Hi $appointmentResults->petownerfirstname $appointmentResults->petownerlastname, just a friendly heads-up that your furry friend $appointmentResults->petname has a vet appointment with us tomorrow, $appointmentResults->appointment_date at $appointmentResults->appointment_time. We're excited to see you both!";


                            //update day_before_reminder_sent
                            $this->db->query('UPDATE petcare_appointments SET day_before_reminder_sent = 1 WHERE appointment_id = :appointment_id');
                            $this->db->bind(':appointment_id', $appointmentResults->appointment_id);
                            $this->db->execute();

                            $this->sendReminderEmail( $appointmentResults, $filePath, $subject);
                            $this->sendSMSNotificaton($appointmentResults,$msg);

                        }else if($appointmentResults->appointment_date == date('Y-m-d', strtotime('-1 days')) &&
                            $appointmentResults->day_after_reminder_sent == 0 ){

                                $filePath = __DIR__ . '/../views/email/appointmentForgot.php';
                                $subject = "Missed PetCare Appointment Yesterday!!";

                                $msg = "Hi $appointmentResults->petownerfirstname $appointmentResults->petownerlastname, we noticed that $appointmentResults->petname missed their appointment with us on $appointmentResults->appointment_date. We're concerned about their well-being and would love to get them back on track. Please reschedule their appointment.";

                                //add change confirmed change to rejected
                                $this->db->query('UPDATE petcare_appointments SET status = "Rejected", day_after_reminder_sent =1 WHERE appointment_id = :appointment_id');
                                $this->db->bind(':appointment_id', $appointmentResults->appointment_id);
                                $this->db->execute();

                                $this->sendReminderEmail( $appointmentResults, $filePath, $subject);
                                $this->sendSMSNotificaton($appointmentResults,$msg);

                        }
                    }


                    //users who not booked appointment for new treatment

                    $this->db->query('SELECT 
                                            report.*,
                                            petowner.id AS petownerID,
                                            petowner.email AS petownerEmail,
                                            petowner.first_name AS petownerfirstname,
                                            petowner.last_name AS petownerlastname,
                                            petowner.mobile AS petownerMobile,
                                            pet.pet AS petname,
                                            pet.pet_id_generate AS petGenID,
                                            staff.firstname AS vetfname,
                                            staff.lastname AS vetlname,
                                            appointment.status AS appointment_status,
                                            appointment.treatment_id AS appointment_treatment_id
                                        FROM 
                                            petcare_medical_reports report
                                        JOIN 
                                            petcare_pet pet ON report.pet_id = pet.id
                                        JOIN 
                                            petcare_staff staff ON report.veterinarian_id = staff.staff_id
                                        JOIN 
                                            petcare_petowner petowner ON petowner.id = report.owner_id
                                        LEFT JOIN 
                                            petcare_appointments appointment ON appointment.treatment_id = report.treatment_id
                                        WHERE 
                                            (report.treatment_id, report.visit_date) IN (
                                                SELECT 
                                                    treatment_id,
                                                    MAX(visit_date) AS max_visit_date
                                                FROM 
                                                    petcare_medical_reports
                                                GROUP BY 
                                                    treatment_id
                                            ) 
                                            AND petowner.isRemoved = 0 
                                            AND pet.isRemoved = 0 
                                            AND appointment.pet_id IS NULL; -- Check if appointment.pet_id is NULL, indicating no matching treatment ID in appointments

                                    ');

                    $petownersWhoNotBookedAppointmentForNewTreatment = $this->db->resultSet();

                    foreach ($petownersWhoNotBookedAppointmentForNewTreatment as $results) {

                    
                        //this if check if the appointment is not pending or confirmed and the appointment date is 7 days from now and get treatment id in appotinemnt table with latest appointment date
                        if( $results->status == 'Ongoing' &&
                            $results->week_before_reminder_sent == 0 &&
                            $results->followup_date == date('Y-m-d', strtotime('+7 days'))  //add 7days to current date 
                            ){
    
                                $day ='7 days';
                                $this->sendEmailForAppointmentBook($results->treatment_id, $results->petownerEmail, $results->petname,$results->followup_date,$results->followup_reason,$results->petownerfirstname,$results->petownerlastname,$day);
                                $msg = "Hi $results->petownerfirstname $results->petownerlastname, just a friendly reminder that your furry friend $results->petname needs a treatment on $results->followup_date. We recommend booking an appointment now to ensure their timely care. Visit our website to book your slot!";
                                $this->sendSMSNotificaton($results,$msg);
                                
                                //update week_before_reminder_sent to 1
                                $this->db->query('UPDATE petcare_medical_reports SET week_before_reminder_sent = 1 WHERE treatment_id = :treatment_id AND visit_date = :visit_date');
                                $this->db->bind(':treatment_id', $results->treatment_id);
                                $this->db->bind(':visit_date', $results->visit_date);
                                $this->db->execute();
    
                                
    
                        }else if(
                                $results->status == 'Ongoing' &&
                                $results->day_before_reminder_sent == 0 &&
                                $results->followup_date == date('Y-m-d', strtotime('+1 days'))
                                ){
    
                                    $day ='Tommorow';
                                    $this->sendEmailForAppointmentBook($results->treatment_id, $results->petownerEmail, $results->petname,$results->followup_date,$results->followup_reason,$results->petownerfirstname,$results->petownerlastname,$day);
                                    $msg = "Hi $results->petownerfirstname $results->petownerlastname, a gentle nudge! Your furry friend $results->petname's treatment is tomorrow, $results->followup_date. Don't forget to book an appointment today to avoid any delays.See you soon!";
                                    $this->sendSMSNotificaton($results,$msg);
                                    //update day_before_reminder_sent to 1
                                    $this->db->query('UPDATE petcare_medical_reports SET day_before_reminder_sent = 1 WHERE treatment_id = :treatment_id AND visit_date = :visit_date');
                                    $this->db->bind(':treatment_id', $results->treatment_id);
                                    $this->db->bind(':visit_date', $results->visit_date);
                                    $this->db->execute();
    
    
                        }else if(
                            $results->status == 'Ongoing' &&
                            $results->day_after_reminder_sent == 0 &&
                            $results->followup_date == date('Y-m-d', strtotime('-1 days'))
                            ){
    
                                $day ='Yesterday';
    
                                $this->sendEmailForAppointmentBook($results->treatment_id, $results->petownerEmail, $results->petname,$results->followup_date,$results->followup_reason,$results->petownerfirstname,$results->petownerlastname,$day);
                                $msg = "Hi $results->petownerfirstname $results->petownerlastname, we noticed that $results->petname missed their treatment scheduled for $results->followup_date. We're concerned about their well-being and would love to get them back on track.Please reschedule their treatment as soon as possible.";
                                $this->sendSMSNotificaton($results,$msg);
                                
                                //update day_after_reminder_sent
                                $this->db->query('UPDATE petcare_medical_reports SET day_after_reminder_sent = 1 WHERE treatment_id = :treatment_id AND visit_date = :visit_date');
                                $this->db->bind(':treatment_id', $results->treatment_id);
                                $this->db->bind(':visit_date', $results->visit_date);
                                $this->db->execute();
    
                        }
    
                    }



        }

        public function sendEmailForAppointmentBook($treatment_id, $petownerEmail, $petname,$followup_date,$followup_reason,$petownerfirstname,$petownerlastname,$day){

            
            require __DIR__ . '/../libraries/phpmailer/vendor/autoload.php';
            try {
                // Create a new PHPMailer instance
                $mail = new PHPMailer(true);
        
                // Set mail configuration (replace with your actual details)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['MAIL_USERNAME'];
                $mail->Password = $_ENV['MAIL_PASSWORD']; // Replace with your password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
        
                // Set email sender details
                $mail->setFrom($_ENV['MAIL_USERNAME'], 'PetCare');
        
                // Add recipient address
                $mail->addAddress($petownerEmail, 'Pet Owner: ' . $petownerfirstname . ' ' . $petownerlastname);
        
                // Set subject and body
                $mail->Subject = "Woof Woof! Don't forget your furry friend's appointment reminder!";
                $mail->isHTML(true);

                $filePath = __DIR__ . '/../views/email/appointmentReminderForNotBooked.php';
                $emailContent = file_get_contents($filePath);
            

                // Replace placeholders with actual values
                $emailContent = str_replace('{pet_owner_fname}', $petownerfirstname, $emailContent);
                $emailContent = str_replace('{pet_owner_lname}',$petownerlastname, $emailContent);
                $emailContent = str_replace('{pet_name}',$petname, $emailContent);
                $emailContent = str_replace('{treatment_id}',$treatment_id, $emailContent);
                $emailContent = str_replace('{follow_up_date}',$followup_date, $emailContent);
                $emailContent = str_replace('{reason}',$followup_reason, $emailContent);
                $emailContent = str_replace('{day}',$day, $emailContent);
                

                $mail->Body = $emailContent;

        
                // Send the email
                $mail->send();
            } catch (Exception $e) {
                // Handle exceptions
                echo 'Error: ' . $mail->ErrorInfo;
            }
        
           
        }

        public function sendReminderEmail($appointmentResults, $filePath, $subject){

            require __DIR__ . '/../libraries/phpmailer/vendor/autoload.php';
            try {
                // Create a new PHPMailer instance
                $mail = new PHPMailer(true);
        
                // Set mail configuration (replace with your actual details)
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = $_ENV['MAIL_USERNAME'];
                $mail->Password = $_ENV['MAIL_PASSWORD']; // Replace with your password
                $mail->SMTPSecure = 'tls';
                $mail->Port = 587;
        
                // Set email sender details
                $mail->setFrom($_ENV['MAIL_USERNAME'], 'PetCare');
        
                // Add recipient address
                $mail->addAddress($appointmentResults->petownerEmail, 'Pet Owner: ' . $appointmentResults->petownerfirstname . ' ' . $appointmentResults->petownerlastname);
        
                // Set subject and body
                $mail->Subject = $subject;
                $mail->isHTML(true);

                
                $emailContent = file_get_contents($filePath);
            

                // Replace placeholders with actual values
                $emailContent = str_replace('{pet_owner_fname}', $appointmentResults->petownerfirstname, $emailContent);
                $emailContent = str_replace('{pet_owner_lname}',$appointmentResults->petownerlastname, $emailContent);
                $emailContent = str_replace('{pet_name}',$appointmentResults->petname, $emailContent);

                if($appointmentResults->treatment_id == NULL){

                    $emailContent = str_replace('{treatment_id}','New Treatment', $emailContent);
                }else{
                    $emailContent = str_replace('{treatment_id}','TRT-'. $appointmentResults->treatment_id, $emailContent);
                }

                $emailContent = str_replace('{appointment_date}',$appointmentResults->appointment_date, $emailContent);
                $emailContent = str_replace('{appointment_time}',$appointmentResults->appointment_time, $emailContent);
                $emailContent = str_replace('{vet_name}',$appointmentResults->vetfname . ' ' . $appointmentResults->vetlname, $emailContent);
                $emailContent = str_replace('{appointment_id}',$appointmentResults->appointment_id, $emailContent);


                if($subject === "Heads up! Tomorrow's the purrfect day for your pet's appointment!"){
                    
                        
                        $emailContent = str_replace('{appointment_status}',$appointmentResults->appointment_status, $emailContent);
                }else{
                        $emailContent = str_replace('{appointment_status}','Rejected', $emailContent);
                }


                $emailContent = str_replace('{appointment_reason}',$appointmentResults->appointment_type, $emailContent);
                

                $mail->Body = $emailContent;

        
                // Send the email
                $mail->send();
            } catch (Exception $e) {
                // Handle exceptions

        }

        }


        public function sendSMSNotificaton($Results,$msg){
             // Send SMS
             $userID = $_ENV['NOTIFY_USERID'];
             $apiKey = $_ENV['NOTIFY_APIKEY'];
 
             $sendEndpoint = "https://app.notify.lk/api/v1/send?user_id={$userID}&api_key={$apiKey}&sender_id=NotifyDEMO&to=[TO]&message=" . urlencode($msg);
             $sendEndpoint = str_replace('[TO]',$Results->petownerMobile, $sendEndpoint);
             //$sendResponse = file_get_contents($sendEndpoint);
 
        }

    }