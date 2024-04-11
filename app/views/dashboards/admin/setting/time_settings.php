<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/settings.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>Dashboard</title>
   </head>

   <style>

    .time-slots-container{
        display: flex;
        flex-direction: column;
       
    }

    .time-slots{
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
    }

    .time-slot{
        display: flex;
        align-items: center;
        gap:20px;
    }

    .time-slot label{
        margin-bottom: 5px;
        width: 150px;
        text-wrap:nowrap;
    }

    .time-slot input{
        width: 100%;
        padding: 5px;
        margin-bottom: 10px;
    }

    .time-slot input[type="time"]{
        padding: 5px;
    }

    .icon-status{
        display:flex;
        align-items: center;
    }

    .gap{
        display:grid;
        align-items:center;
    }

    .gap input{
        width: 50% !important;  
        flex-grow:0 !important; 
    }




   </style>
   <body>

   <?php require_once __DIR__ . '/../../common/common_variable/setting_common.php'; ?>
   <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


        <main>
                        <div class="header">
                            <div class="left">
                                <h1>Settings</h1>
                                <ul class="breadcrumb">
                                    <li><a href="<?php echo URLROOT?>/admin/">
                                        Dashboard
                                    </a></li>  
                                    >
                                    <li><a href="<?php echo URLROOT?>/admin/settings/all" class=""> Settings</a></li>
                                    >
                                    <li><a href="<?php echo URLROOT?>/admin/settings/password" class="active"> Change Password</a></li>
                                </ul>
                            </div>
                            
                        </div>



        <form class="container"   method="POST" action="<?php echo URLROOT?>/admin/settings/time" id="myForm">     <!--start of form-->
                                    
                                    <div class="content-box">
                                        <div class="inner-content active">                 <!-- start of inner content1 (Myprofile)-->
                                            <div class="personal-info">                 <!-- personal info-->
                                                <div class="large">
                                                    Change Appointment Time
                                                </div>
                                                <div class="line2">
                                                    <div class="small">
                                                    You can change the appointment time here upcomming 7 days.
                                                    <div><span class="invalid-feedback"><?php echo $data['main_err'];?></span></div>
                                                        
                                                    </div>
                                                    <button type="reset" class="cancel-btn" onclick="window.location.href = '<?php echo URLROOT; ?>/admin/settings/time';">Cancel</button>
                                                    <button id="submit" class="save-changes-btn">Update</button>
                                                </div>
                                            </div>


                                            
                                            <div class="input-field">
                                                <div class="title">
                                                    Monday (<?php echo getNextDayDate('monday'); ?>)
                                                    <div><span class="invalid-feedback"><?php echo $data['monday_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    
                                                    
                                                      
                                                    <div class="time-slots-container">
                                                        <!-- morning start,end and afternoon start and end -->
                                                        <div class="time-slots">

                                                            

                                                            <div class="time-slot">
                                                            
                                                                <label for="start">Morning Start Time:</label>
                                                                <input type="time" id="am" onchange="checkAM(this)" name="monday_m_start" value="<?php echo $data['monday_m_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <!--<i class='bx bxs-sun'></i> -->
                                                                <label for="end">Morning End Time:</label>
                                                                <input type="time" id="am" onchange="checkAM(this)"  name="monday_m_end" value="<?php echo $data['monday_m_end']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="time-slots">

                                                            <div class="time-slot">
                                                                <label for="start"> Afternoon Start Time:</label>
                                                                <input type="time" id="pm" onchange="checkPM(this)" name="monday_a_start" value="<?php echo $data['monday_a_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <label for="end">Aftenoon End Time:</label>
                                                                <input type="time" id="pm" onchange="checkPM(this)" name="monday_a_end" value="<?php echo $data['monday_a_end']; ?>">
                                                            </div>

                                                        </div>

                                                        
                                                    </div>

                                                    <div class="gap">
                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['monday_m_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="monday_m_gap" value="<?php echo $data['monday_m_gap']; ?>">
                                                            </div>

                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['monday_a_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="monday_a_gap" value="<?php echo $data['monday_a_gap']; ?>">
                                                            </div>
                                                    </div>  

                                                    
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>
                                            


                                            
                                            <div class="input-field">
                                                <div class="title">
                                                    Tuesday (<?php echo getNextDayDate('tuesday'); ?>)
                                                    <div><span class="invalid-feedback"><?php echo $data['tuesday_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    
                                                    
                                                      
                                                    <div class="time-slots-container">
                                                        <!-- morning start,end and afternoon start and end -->
                                                        <div class="time-slots">

                                                            

                                                            <div class="time-slot">
                                                            
                                                                <label for="start">Morning Start Time:</label>
                                                                <input type="time" id="am" onchange="checkAM(this)" name="tuesday_m_start" value="<?php echo $data['tuesday_m_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <!--<i class='bx bxs-sun'></i> -->
                                                                <label for="end">Morning End Time:</label>
                                                                <input type="time" id="am" name="tuesday_m_end" value="<?php echo $data['tuesday_m_end']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="time-slots">

                                                            <div class="time-slot">
                                                                <label for="start"> Afternoon Start Time:</label>
                                                                <input type="time" id="pm" name="tuesday_a_start" value="<?php echo $data['tuesday_a_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <label for="end">Aftenoon End Time:</label>
                                                                <input type="time" id="pm" name="tuesday_a_end" value="<?php echo $data['tuesday_a_end']; ?>">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="gap">
                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['tuesday_m_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="tuesday_m_gap" value="<?php echo $data['tuesday_m_gap']; ?>">
                                                            </div>

                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['tuesday_a_err'])) ? 'is-invalid' : '' ; ?>" type="text" name ="tuesday_a_gap" value="<?php echo $data['tuesday_a_gap']; ?>">
                                                            </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>


                                            <div class="input-field">
                                                <div class="title">
                                                    Wednesday (<?php echo getNextDayDate('wednesday'); ?>)
                                                    <div><span class="invalid-feedback"><?php echo $data['wednesday_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    
                                                    
                                                      
                                                    <div class="time-slots-container">
                                                        <!-- morning start,end and afternoon start and end -->
                                                        <div class="time-slots">

                                                            

                                                            <div class="time-slot">
                                                            
                                                                <label for="start">Morning Start Time:</label>
                                                                <input type="time" id="am" onchange="checkAM(this)" name="wednesday_m_start" value="<?php echo $data['wednesday_m_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <!--<i class='bx bxs-sun'></i> -->
                                                                <label for="end">Morning End Time:</label>
                                                                <input type="time" id="am" name="wednesday_m_end" value="<?php echo $data['wednesday_m_end']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="time-slots">

                                                            <div class="time-slot">
                                                                <label for="start"> Afternoon Start Time:</label>
                                                                <input type="time" id="pm" name="wednesday_a_start" value="<?php echo $data['wednesday_a_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <label for="end">Aftenoon End Time:</label>
                                                                <input type="time" id="pm" name="wednesday_a_end" value="<?php echo $data['wednesday_a_end']; ?>">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="gap">
                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['wednesday_m_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="wednesday_m_gap" value="<?php echo $data['wednesday_m_gap']; ?>">
                                                            </div>

                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['wednesday_a_err'])) ? 'is-invalid' : '' ; ?>" type="text" name ="wednesday_a_gap" value="<?php echo $data['wednesday_a_gap']; ?>">
                                                            </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>


                                            <div class="input-field">
                                                <div class="title">
                                                    Thursday (<?php echo getNextDayDate('thursday'); ?>)
                                                    <div><span class="invalid-feedback"><?php echo $data['thursday_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    
                                                    
                                                      
                                                    <div class="time-slots-container">
                                                        <!-- morning start,end and afternoon start and end -->
                                                        <div class="time-slots">

                                                            

                                                            <div class="time-slot">
                                                            
                                                                <label for="start">Morning Start Time:</label>
                                                                <input type="time" id="am" onchange="checkAM(this)" name="thursday_m_start" value="<?php echo $data['thursday_m_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <!--<i class='bx bxs-sun'></i> -->
                                                                <label for="end">Morning End Time:</label>
                                                                <input type="time" id="am" name="thursday_m_end" value="<?php echo $data['thursday_m_end']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="time-slots">

                                                            <div class="time-slot">
                                                                <label for="start"> Afternoon Start Time:</label>
                                                                <input type="time" id="pm" name="thursday_a_start" value="<?php echo $data['thursday_a_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <label for="end">Aftenoon End Time:</label>
                                                                <input type="time" id="pm" name="thursday_a_end" value="<?php echo $data['thursday_a_end']; ?>">
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="gap">
                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['thursday_m_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="thursday_m_gap" value="<?php echo $data['thursday_m_gap']; ?>">
                                                            </div>

                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['thursday_a_err'])) ? 'is-invalid' : '' ; ?>" type="text" name ="thursday_a_gap" value="<?php echo $data['thursday_a_gap']; ?>">
                                                            </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>


                                            <div class="input-field">
                                                <div class="title">
                                                    Friday (<?php echo getNextDayDate('friday'); ?>)
                                                    <div><span class="invalid-feedback"><?php echo $data['friday_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    
                                                    
                                                      
                                                    <div class="time-slots-container">
                                                        <!-- morning start,end and afternoon start and end -->
                                                        <div class="time-slots">

                                                            

                                                            <div class="time-slot">
                                                            
                                                                <label for="start">Morning Start Time:</label>
                                                                <input type="time" id="am" onchange="checkAM(this)" name="friday_m_start" value="<?php echo $data['friday_m_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <!--<i class='bx bxs-sun'></i> -->
                                                                <label for="end">Morning End Time:</label>
                                                                <input type="time" id="am" name="friday_m_end" value="<?php echo $data['friday_m_end']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="time-slots">

                                                            <div class="time-slot">
                                                                <label for="start"> Afternoon Start Time:</label>
                                                                <input type="time" id="pm" name="friday_a_start" value="<?php echo $data['friday_a_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <label for="end">Aftenoon End Time:</label>
                                                                <input type="time" id="pm" name="friday_a_end" value="<?php echo $data['friday_a_end']; ?>">
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="gap">
                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['friday_m_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="friday_m_gap" value="<?php echo $data['friday_m_gap']; ?>">
                                                            </div>

                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['friday_a_err'])) ? 'is-invalid' : '' ; ?>" type="text" name ="friday_a_gap" value="<?php echo $data['friday_a_gap']; ?>">
                                                            </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Saturday (<?php echo getNextDayDate('saturday'); ?>)
                                                    <div><span class="invalid-feedback"><?php echo $data['saturday_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    
                                                    
                                                      
                                                    <div class="time-slots-container">
                                                        <!-- morning start,end and afternoon start and end -->
                                                        <div class="time-slots">

                                                            

                                                            <div class="time-slot">
                                                            
                                                                <label for="start">Morning Start Time:</label>
                                                                <input type="time" id="am" onchange="checkAM(this)" name="saturday_m_start" value="<?php echo $data['saturday_m_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <!--<i class='bx bxs-sun'></i> -->
                                                                <label for="end">Morning End Time:</label>
                                                                <input type="time" id="am" name="saturday_m_end" value="<?php echo $data['saturday_m_end']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="time-slots">

                                                            <div class="time-slot">
                                                                <label for="start"> Afternoon Start Time:</label>
                                                                <input type="time" id="pm" name="saturday_a_start" value="<?php echo $data['saturday_a_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <label for="end">Aftenoon End Time:</label>
                                                                <input type="time" id="pm" name="saturday_a_end" value="<?php echo $data['saturday_a_end']; ?>">
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="gap">
                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['saturday_m_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="saturday_m_gap" value="<?php echo $data['saturday_m_gap']; ?>">
                                                            </div>

                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['saturday_a_err'])) ? 'is-invalid' : '' ; ?>" type="text" name ="saturday_a_gap" value="<?php echo $data['saturday_a_gap']; ?>">
                                                            </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                            <div class="input-field">
                                                <div class="title">
                                                    Sunday (<?php echo getNextDayDate('sunday'); ?>)
                                                    <div><span class="invalid-feedback"><?php echo $data['sunday_err'];?></span></div>
                                                </div>
                                                
                                                <div class="input">
                                                    
                                                    
                                                      
                                                    <div class="time-slots-container">
                                                        <!-- morning start,end and afternoon start and end -->
                                                        <div class="time-slots">

                                                            

                                                            <div class="time-slot">
                                                            
                                                                <label for="start">Morning Start Time:</label>
                                                                <input type="time" id="am" onchange="checkAM(this)" name="sunday_m_start" value="<?php echo $data['sunday_m_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <!--<i class='bx bxs-sun'></i> -->
                                                                <label for="end">Morning End Time:</label>
                                                                <input type="time" id="am" name="sunday_m_end" value="<?php echo $data['sunday_m_end']; ?>">
                                                            </div>

                                                        </div>

                                                        <div class="time-slots">

                                                            <div class="time-slot">
                                                                <label for="start"> Afternoon Start Time:</label>
                                                                <input type="time" id="pm" name="sunday_a_start" value="<?php echo $data['sunday_a_start']; ?>">
                                                            </div>

                                                            <div class="time-slot">
                                                                <label for="end">Aftenoon End Time:</label>
                                                                <input type="time" id="pm" name="sunday_a_end" value="<?php echo $data['sunday_a_end']; ?>">
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="gap">
                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['sunday_m_err'])) ? 'is-invalid' : '' ; ?>" type="text" name="sunday_m_gap" value="<?php echo $data['sunday_m_gap']; ?>">
                                                            </div>

                                                            <div class="div">
                                                                <label for="end">Time Gap:</label>
                                                                <input class="<?php echo (!empty($data['sunday_a_err'])) ? 'is-invalid' : '' ; ?>" type="text" name ="sunday_a_gap" value="<?php echo $data['sunday_a_gap']; ?>">
                                                            </div>
                                                    </div>

                                                    
                                                </div>
                                            </div>
                                            <div class="border-bottom"></div>

                                         
                                        </div>                 <!-- end of inner content 1 (My profile)-->

                                    </div>                              
                        
        </form>       <!-- end of form -->

<?php
        function getNextDayDate($dayName) {
    // Get the current day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
    $currentDayOfWeek = date('N'); // N returns 1 (Monday) through 7 (Sunday)

    // Define an array to map day names to their corresponding numeric representation
    $daysOfWeek = [
        'monday' => 1,
        'tuesday' => 2,
        'wednesday' => 3,
        'thursday' => 4,
        'friday' => 5,
        'saturday' => 6,
        'sunday' => 7
    ];

    // Convert the input day name to lowercase for case-insensitive comparison
    $lowercaseDayName = strtolower($dayName);

    // Determine the numeric representation of the desired day
    $desiredDayOfWeek = $daysOfWeek[$lowercaseDayName];

    // Calculate the difference in days between the current day and the desired day
    $daysToAdd = ($desiredDayOfWeek >= $currentDayOfWeek) ? ($desiredDayOfWeek - $currentDayOfWeek) : (7 - ($currentDayOfWeek - $desiredDayOfWeek));

    // Calculate the date of the desired day within the next 7 days
    $nextDate = date('Y-m-d', strtotime("+$daysToAdd days"));

    return $nextDate;
}

?>

<script>

let isvalidAM = true; // Variable to track validation status for AM times
let isvalidPM = true; // Variable to track validation status for PM times

// Select all elements with id "am" and "pm" (assuming these are input elements)
let amInputs = document.querySelectorAll('#am');
let pmInputs = document.querySelectorAll('#pm');
let subButton = document.getElementById('submit');

// Function to validate and handle input change for elements with id "am"
function checkAM() {
    amInputs.forEach(input => {
        validateTimeAM(input);
    });
}

// Function to validate and handle input change for elements with id "pm"
function checkPM() {
    pmInputs.forEach(input => {
        validateTimePM(input);
    });
}

// Function to validate time input and apply appropriate class based on AM/PM for "am" inputs
function validateTimeAM(input) {
    let time = input.value;
    console.log('Input Time:', time);
    // Special case: Check if the input time is exactly "12:00 PM"
    if (time == "12:00" || time == "12:00:00") {


       input.classList.remove('is-invalid'); // Remove error class for AM time
        return;
        
    } else {
        let timeArray = time.split(':');
        let hour = parseInt(timeArray[0]);
        let ampm = hour >= 12 ? 'PM' : 'AM';

        if (ampm === 'PM') {
            input.classList.add('is-invalid'); // Add error class for PM time
            isvalidAM = false; // Set validation flag to false for AM times
        } else {
            input.classList.remove('is-invalid'); // Remove error class for AM time
        }
    }
}

// Function to validate time input and apply appropriate class based on AM/PM for "pm" inputs
function validateTimePM(input) {
    let time = input.value;
    let timeArray = time.split(':');
    let hour = parseInt(timeArray[0]);
    let ampm = hour >= 12 ? 'PM' : 'AM';

    if (ampm === 'AM') {
        input.classList.add('is-invalid'); // Add error class for AM time
        isvalidPM = false; // Set validation flag to false for PM times
    } else {
        input.classList.remove('is-invalid'); // Remove error class for PM time
    }
}

// Function to update submit button state based on overall validation status
function updateSubmitButtonState() {
    // Reset validation flags before checking again
    isvalidAM = true;
    isvalidPM = true;

    // Check AM and PM inputs for validation
    checkAM();
   checkPM();

    // Enable or disable submit button based on validation status
    if (isvalidAM && isvalidPM) {
        subButton.disabled = false; // Enable submit button if both AM and PM are valid
    } else {
        subButton.disabled = true; // Disable submit button if either AM or PM is invalid
    }
}

// Attach event listeners to input elements for change events
amInputs.forEach(input => {
    input.addEventListener('change', updateSubmitButtonState);
});

pmInputs.forEach(input => {
    input.addEventListener('change', updateSubmitButtonState);
});

   
</script>


    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/setting.js"></script>

   </body>
</html>