<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

   


    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/petowner/addAppointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    




     <!-- Include Pickadate.js CSS -->
     <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/bundle.js"></script>
    

   
  





    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/appointment_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Appointment</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/petowner">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/appointment" class="active">Appointment</a></li>
                        <li> > </li> <!-- Include the ">" character within an <li> element -->
                        <li><a href="<?php echo URLROOT;?>/petowner/addAppointment" class="active">Book Appointment</a></li>
                    </ul>
                </div>

             </div>


        <div class="bottom-data">

        <div class="container-model">

                <div class="header">
                    <i class='bx bx-calendar' ></i>
                    <h3>Book Appointment</h3>       
                </div>


            <div class="progress-bar">
                <div class="step">
                    <p>Info</p>
                    <div class="bullet">
                        <span>1</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>Date</p>
                    <div class="bullet">
                        <span>2</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
                <div class="step">
                    <p>Time</p>
                    <div class="bullet">
                        <span>3</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>

                <div class="step">
                    <p>Confrimation</p>
                    <div class="bullet">
                        <span>4</span>
                    </div>
                    <div class="check fas fa-check"></div>
                </div>
               
              
            </div>

            <div class="form-outer">


                <form class="form-slide" action="<?php echo URLROOT; ?>/petowner/checkoutAppointment" method="POST">


                    <div class="page slide-page">

                        <div class="title">Appointment Info:</div>

                        <div class="error-container" id="error-pageslide-container">
                            <div class="error">
                                <div class="error__icon">
                                    <i class='bx bx-error-circle'></i>
                                </div>
                                <div class="error__title" id="error-pageslide-title"></div>
                                <div class="error__close"></div>
                            </div>
                        </div>
                       

                       <div class="input-container">

                       
                            <div class="input-field">
                                    <div class="label">First Name</div>
                                    <div class="inputForm">
                                    <i class='bx bx-purchase-tag-alt' ></i>
                                    <input id="first-name" type="text" placeholder ="Enter first Name" required />
                                    </div>
                                    <span class="invalid-feedback"></span>
                            </div>
                            

                            
                                <div class="input-field">
                                    <div class="label">Last Name</div>
                                    <div class="inputForm">
                                    <i class='bx bx-purchase-tag-alt' ></i>
                                    <input id="last-name" type="text" placeholder ="Enter last Name" required />
                                    </div>
                                    <span class="invalid-feedback"></span>
                                </div>

                               <div class="input-field">
                                    <div class="label">Select Pet</div>
                                    <div class="inputForm">
                                    <i class='bx bx-purchase-tag-alt' ></i>
                                    <Select id="pet" placeholder="Select a Pet">

                                    <option disabled selected value=" ">
                                        Select a Pet
                                    </option>


                                    <?php foreach($data['pet'] as $pet) : ?>

                                        <option value=" <?php echo $pet->id?>">
                                          Id: <?php echo $pet->id?>  | <?php echo $pet->pet?>
                                        </option>


                                    <?php endforeach; ?>


                                    </Select>
                                    </div>
                                    <span class="invalid-feedback"></span>
                                </div>
                                
                                
                       
                        </div>
                    
                 

                        

                        

                        <div class="field">
                            <button class="firstNext next">Next</button>
                        </div>
                    </div>

                    <div class="page datecheck"> <!-- second page -->


                        <div class="title">Select a Date</div>

                        <!-- date check error-->

                        <div class="error-container" id="error-datecheck-container">
                            <div class="error">
                                <div class="error__icon">
                                    <i class='bx bx-error-circle'></i>
                                </div>
                                <div class="error__title" id="error-datecheck-title"></div>
                                <div class="error__close"></div>
                            </div>
                        </div>

                        <!-- litepicker lib calender -->

                            <div class="cal"  >
                               <input type="text" id="litepicker" >
                        </div>

                        

                        <div class="field btns">
                            <button class="prev-1 prev">Previous</button>
                            <button class="next-1 next">Next</button>
                        </div>
                    </div>

                    <div class="page timecheck"> <!-- page 3 -->

                        <div class="title">Pick a Time</div>


                        <!-- date check error-->

                        <div class="error-container" id="error-timecheck-container">
                            <div class="error">
                                <div class="error__icon">
                                    <i class='bx bx-error-circle'></i>
                                </div>
                                <div class="error__title" id="error-timecheck-title"></div>
                                <div class="error__close"></div>
                            </div>
                        </div>


                        
                        <div class="time-slot-container scroll-1">
                                        
                                        <label class="time-slot">
                                            <input type="radio" id="time" name="time" value="8:00 AM">
                                            8:00 AM - 8.30 AM
                                        </label>

                                        <label class="time-slot">
                                            <input type="radio" id="time" name="time" value="8:00 AM">
                                            8:00 AM
                                        </label>

                                        <label class="time-slot">
                                            <input type="radio" id="time" name="time" value="8:00 AM">
                                            8:00 AM
                                        </label>

                                        <label class="time-slot">
                                            <input type="radio" id="time" name="time" value="8:00 AM">
                                            8:00 AM
                                        </label>

                                        <label class="time-slot">
                                            <input type="radio" id="time" name="time" value="8:00 AM">
                                            8:00 AM
                                        </label>

                                        <label class="time-slot">
                                            <input type="radio" id="time" name="time" value="8:00 AM">
                                            8:00 AM
                                        </label>

                                        <label class="time-slot">
                                            <input type="radio" id="time" name="time" value="8:00 AM">
                                            8:00 AM
                                        </label>
                                        
                                    </div>

                                    <span class="invalid-feedback"></span>
                             
    
                            
                                
                                 

                                    
                      
                        
                       
                        <div class="field btns">
                            <button class="prev-3 prev">Previous</button>
                            <button class="next-3 next">Next</button>
                        </div>


                    </div>


                    <div class="page confirmationcheck">
                        <div class="title">Appointment Confirmation</div>


                        <div class="grid">

                            <div class="col">

                                <div class="small-title">User Info</div>

                                <div class="label">Pet Id: <span id="pet-id"></span></div>
                                <div class="label">Pet Name: <span id="pet-name"></span></div>
                                <div class="label">Pet Owner: <span id="pet-owner-name"></span></div>
                                
                                

                            </div>

                            <div class="col">
                                <div class="small-title">Appointment Info</div>
                                
                                <div class="label">Veterinarin: Anna</div>
                                <div class="label">Time: <span id="time-last"></span></div>
                                <div class="label">Date: <span id="date-last"></span></div>
                                <div class="label">Price: LKR 1500</div>
                            </div>


                        </div>

                        
                            
                       
                        
                        

                        <div class="field btns">
                            <button class="prev-4 prev">Previous</button>
                            <button class="submit">Submit</button>
                        </div>
                    </div>
                
                    </div>
                </form>
            </div>
        </div> <!-- model over -->       

          
            </div> <!-- content over -->
 

             
                                
        </main>

           




    </div>

   


    <!-- staff add model over -->

   
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/appointmentSlide.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/litepicker/dist/plugins/mobilefriendly.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/calender.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/manageStaff.js"></script>
    
    
</body>
</html>