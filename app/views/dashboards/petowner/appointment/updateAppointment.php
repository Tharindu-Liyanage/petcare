<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/dashboard/petowner/updateAppointment.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                        <li><a href="<?php echo URLROOT;?>/petowner/appointment" >Appointment</a></li>
                        <li> > </li> <!-- Include the ">" character within an <li> element -->
                        <li><a href="<?php echo URLROOT;?>/petowner/updateAppointment/<?php echo $data['appointment_id'];?>" class="active">Update Appointment</a></li>
                    </ul>
                </div>


              
               
            </div>
            
            <div class="bottom-data">

            <!-- appointmetn add here -->

            <div class="add-model">

        <div class="header">
        <i class='bx bx-calendar-edit' ></i>
                <h3>Update Appointment</h3>       
            </div>

            


            <form class="form" method="post"  action="<?php echo URLROOT; ?>/petowner/updateAppointment/<?php echo $data['appointment_id']; ?>">

                
               <?php
                    if (!empty($data['main_err'])) {
                        echo '<div class="error-container" id="error-pageslide-container">
                                <div class="error">
                                    <div class="error__icon">
                                        <i class="bx bx-error-circle"></i>
                                    </div>
                                    <div class="error__title" id="error-pageslide-title">' . $data['main_err'] . '</div>
                                    <div class="error__close"></div>
                                </div>
                            </div>';
                    }
                    ?>


           <div class="columns-container">

            <div class="column">

                <div class="flex-column">
                                    <label>Select a Pet</label>
                                </div>
                                <div class="inputForm <?php echo (!empty($data['pet_err'])) ? 'is-invalid' : '' ; ?>">
                                    <i class='bx bx-purchase-tag-alt' ></i>
                                    <select id="pet" name="pet">



                                    <?php foreach($data['pet'] as $pet) : ?>

                                        <option value="<?php echo $pet->id?>" <?php if($data['appointment_details']->pet_id == $pet->id) echo "selected "; ?>>
                                          <?php echo $pet->pet_id_generate?>  | <?php echo $pet->pet?>
                                        </option>


                                    <?php endforeach; ?>


                                    </select>
                                </div>
                                <span class="invalid-feedback"></span>

                                <div class="flex-column">
                                    <label>Select a Date</label>
                                </div>
                                <div class="inputForm"  <?php echo (!empty($data['date_err'])) ? 'is-invalid' : '' ; ?>>
                                <i class='bx bx-calendar' ></i>
                                    <input name="date" type="date" id="datepicker" class="input " placeholder="Select Date" value="<?php echo $data['appointment_details']->appointment_date; ?>">
                                </div>
                                <span class="invalid-feedback"></span>

                                <div class="flex-column">
                                    <label>Select a Veterinarian </label>
                                </div>
                                <div class="inputForm <?php echo (!empty($data['vet_err'])) ? 'is-invalid' : '' ; ?>">
                                <i class='bx bx-male-female' ></i>
                                    <select id="vetSelect" name="vet">
                                        
                                        <?php foreach($data['vet'] as $vet) : ?>

                                        <option value="<?php echo $vet->staff_id?>" <?php if($data['appointment_details']->vet_id == $vet->staff_id) echo "selected "; ?>>
                                        <?php echo $vet->firstname?> <?php echo $vet->lastname?>  
                                        </option>


                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <span class="invalid-feedback"></span>

                                

            </div> <!-- column tag close -->

            <div class="column">

                            <div class="flex-column">
                                    <label>Select a Treatment </label>
                                </div>
                                <div class="inputForm <?php echo (!empty($data['treatment_err'])) ? 'is-invalid' : '' ; ?>">
                                <i class='bx bxs-capsule'></i>
                                     <select id="treatment" name="treatment">

                                  

                                    <option   value="NONE" <?php if($data['appointment_details']->treatment_id == NULL) echo "selected "; ?>>
                                    New Treatment
                                    </option>


                                    <?php foreach($data['medicalreport'] as $treatment) : ?>

                                        <option value="<?php echo $treatment->treatment_id?>" <?php if($data['appointment_details']->treatment_id == $treatment->treatment_id) echo "selected "; ?>>
                                          TRT-<?php echo $treatment->treatment_id?> 
                                        </option>


                                    <?php endforeach; ?>


                                    </select>
                                </div>
                                <span class="invalid-feedback"></span>


                                <div class="flex-column">
                                    <label>Time</label>
                                </div>
                                <div class="inputForm <?php echo (!empty($data['time_err'])) ? 'is-invalid' : '' ; ?>">
                                <i class='bx bx-time'></i>
                                    <select id="timeSlotsSelect" name="time">
                                        <option value="" disable>Please Select a Date First</option>
                                    
                                            
                                    </select>
                                    
                                </div>
                                <span class="invalid-feedback"></span>


                                <div class="flex-column">
                                    <label>Reason</label>
                                </div>
                                <div class="inputForm  <?php echo (!empty($data['reson_err'])) ? 'is-invalid' : '' ; ?>">
                                <i class='bx bx-question-mark' ></i>
                                    <select id="reason" name="reason">

                                    


                                    <?php foreach($data['reason'] as $reasons) : ?>

                                        <option value="<?php echo $reasons->reason_name?>" <?php if($data['appointment_details']->appointment_type == $reasons->reason_name) echo "selected "; ?> >
                                          <?php echo $reasons->reason_name?> 
                                        </option>


                                    <?php endforeach; ?>
                                    <option value="other">Other</option>
                                   
                                    </select>

                                   

                                </div>
                                <span class="invalid-feedback"></span>

                                


                                
                                


                    

                        </div> <!-- column close -->

                        </div>

                        <div class="button-form">
                                    <button type="reset"  class="button-submit">Reset</button> 
                                    <button type="submit" id="button-submit" class="button-submit">Update</button>
                                </div>
                        

                    </form>

            </div> <!-- model over -->
        </div>

           



             
                                
        </main>

           




    </div>

   


    <!-- staff add model over -->


    

    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/updateAppointment.js"></script>

    <script>
         <?php foreach ($data['time_slots'] as $time_slot) : ?>

            
            
                <?php if ($time_slot->day == 'monday' && $time_slot->part_of_day == 'morning') : ?>
                    const mondayMorningStartTime = '<?php echo $time_slot->start_time; ?>';
                    const mondayMorningEndTime = '<?php echo $time_slot->end_time; ?>';
                    const mondayTimeInterval = '<?php echo $time_slot->intervel; ?>';

                <?php elseif ($time_slot->day == 'monday' && $time_slot->part_of_day == 'afternoon') : ?>
                    const mondayAfternoonStartTime = '<?php echo $time_slot->start_time; ?>';
                    const mondayAfternoonEndTime = '<?php echo $time_slot->end_time; ?>';

                <?php elseif ($time_slot->day == 'tuesday' && $time_slot->part_of_day == 'morning') : ?>
                    const tuesdayMorningStartTime = '<?php echo $time_slot->start_time; ?>';
                    const tuesdayMorningEndTime = '<?php echo $time_slot->end_time; ?>';
                    const tuesdayTimeInterval = '<?php echo $time_slot->intervel; ?>';

                <?php elseif ($time_slot->day == 'tuesday' && $time_slot->part_of_day == 'afternoon') : ?>
                    const tuesdayAfternoonStartTime = '<?php echo $time_slot->start_time; ?>';
                    const tuesdayAfternoonEndTime = '<?php echo $time_slot->end_time; ?>';

                <?php elseif ($time_slot->day == 'wednesday' && $time_slot->part_of_day == 'morning') : ?>
                    const wednesdayMorningStartTime = '<?php echo $time_slot->start_time; ?>';
                    const wednesdayMorningEndTime = '<?php echo $time_slot->end_time; ?>';
                    const wednesdayTimeInterval = '<?php echo $time_slot->intervel; ?>';

                <?php elseif ($time_slot->day == 'wednesday' && $time_slot->part_of_day == 'afternoon') : ?>
                    const wednesdayAfternoonStartTime = '<?php echo $time_slot->start_time; ?>';
                    const wednesdayAfternoonEndTime = '<?php echo $time_slot->end_time; ?>';

                <?php elseif ($time_slot->day == 'thursday' && $time_slot->part_of_day == 'morning') : ?>
                    const thursdayMorningStartTime = '<?php echo $time_slot->start_time; ?>';
                    const thursdayMorningEndTime = '<?php echo $time_slot->end_time; ?>';
                    const thursdayTimeInterval = '<?php echo $time_slot->intervel; ?>';

                <?php elseif ($time_slot->day == 'thursday' && $time_slot->part_of_day == 'afternoon') : ?>
                    const thursdayAfternoonStartTime = '<?php echo $time_slot->start_time; ?>';
                    const thursdayAfternoonEndTime = '<?php echo $time_slot->end_time; ?>';

                <?php elseif ($time_slot->day == 'friday' && $time_slot->part_of_day == 'morning') : ?>
                    const fridayMorningStartTime = '<?php echo $time_slot->start_time; ?>';
                    const fridayMorningEndTime = '<?php echo $time_slot->end_time; ?>';
                    const fridayTimeInterval = '<?php echo $time_slot->intervel; ?>';

                <?php elseif ($time_slot->day == 'friday' && $time_slot->part_of_day == 'afternoon') : ?>
                    const fridayAfternoonStartTime = '<?php echo $time_slot->start_time; ?>';
                    const fridayAfternoonEndTime = '<?php echo $time_slot->end_time; ?>';

                <?php elseif ($time_slot->day == 'saturday' && $time_slot->part_of_day == 'morning') : ?>
                    const saturdayMorningStartTime = '<?php echo $time_slot->start_time; ?>';
                    const saturdayMorningEndTime = '<?php echo $time_slot->end_time; ?>';
                    const saturdayTimeInterval = '<?php echo $time_slot->intervel; ?>';
                    

                <?php elseif ($time_slot->day == 'saturday' && $time_slot->part_of_day == 'afternoon') : ?>
                    const saturdayAfternoonStartTime = '<?php echo $time_slot->start_time; ?>';
                    const saturdayAfternoonEndTime = '<?php echo $time_slot->end_time; ?>';

                <?php elseif ($time_slot->day == 'sunday' && $time_slot->part_of_day == 'morning') : ?>
                    const sundayMorningStartTime = '<?php echo $time_slot->start_time; ?>';
                    const sundayMorningEndTime = '<?php echo $time_slot->end_time; ?>';
                    const sundayTimeInterval = '<?php echo $time_slot->intervel; ?>';

                <?php elseif ($time_slot->day == 'sunday' && $time_slot->part_of_day == 'afternoon') : ?>
                    const sundayAfternoonStartTime = '<?php echo $time_slot->start_time; ?>';
                    const sundayAfternoonEndTime = '<?php echo $time_slot->end_time; ?>';

                <?php endif; ?>

                <?php endforeach; ?>


               const selectedTime = <?php echo json_encode($data['appointment_details']->appointment_time); ?>;
        </script>
    
</body>
</html>