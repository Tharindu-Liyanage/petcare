<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/dashboard/petowner/updateAppointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/doctor/doctor-addTreatment.css">
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
                    <h1>Treatment</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/doctor">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/doctor/treatment" >Treatment</a></li>
                        <li> > </li> <!-- Include the ">" character within an <li> element -->
                        <li><a href="<?php echo URLROOT;?>/doctor/addTreatment/<?php// echo $data['id'];?>" class="active">Add Treatment</a></li>
                    </ul>
                </div>


              
               
            </div>
            
            <div class="bottom-data">

            <!-- appointmetn add here -->

            <div class="add-model">

        <div class="header">
        <i class='bx bx-capsule' ></i>
                <h3>Add Treatment</h3>       
            </div>

            


            <form class="form" method="post"  action="<?php echo URLROOT; ?>/doctor/addTreatment/<?php echo $data['pet_id']; ?>/<?php echo $data['trtID']; ?>">

                
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

                    <div class="title">
                        Pet Info :
                    </div>

                    <div class="fields">

                    <?php if ($data['trtID'] == "new") : ?>

                            <div class="input-field">
                                <label>Pet ID</label>
                                <input type="text" name="pet_id" value="<?php echo $data['petDetails']->pet_id_generate; ?>" readonly>
                            </div>
                            

                            <div class="input-field">
                                <label>Pet Owner ID</label>
                                <input type="text" name="po_id" value="<?php echo $data['petDetails']->petownerid; ?>" readonly>
                            </div>

                            <div class="input-field">
                                <label>Pet Name</label>
                                <input type="text" name="pet-name" value="<?php echo $data['petDetails']->pet; ?>" readonly>
                            </div>

                            <div class="input-field">
                                <label>Pet Owner Name</label>
                                <input type="text" name="pet-name" value="<?php echo $data['petDetails']->petownerfname.' '.$data['petDetails']->petownerlname;  ?>" readonly>
                            </div>

                            <div class="input-field">
                                <label>Treatment ID</label>
                                <input type="text" name="pet-name" value="<?php echo $data['trtID']; ?>" readonly>
                            </div>

                            <div class="input-field">
                                <label>Age</label>
                                <input  type="text" name="age" value="<?php echo $data['petDetails']->DOB; ?>" readonly>
                            </div>

                        <?php else : ?>

                            <div class="input-field">
                                <label>Pet ID</label>
                                <input type="text" name="pet_id" value="<?php echo $data['petDetails']->pet_id_generate; ?>">
                            </div>
                            

                            <div class="input-field">
                                <label>Pet Owner ID</label>
                                <input type="text" name="po_id" value="<?php echo $data['petDetails']->petownerid; ?>" readonly>
                            </div>

                            <div class="input-field">
                                <label>Pet Name</label>
                                <input type="text" name="pet-name" value="<?php echo $data['petDetails']->pet; ?>" readonly>
                            </div>

                            <div class="input-field">
                                <label>Pet Owner Name</label>
                                <input type="text" name="pet-name" value="<?php echo $data['petDetails']->petownerfname.' '.$data['petDetails']->petownerlname;  ?>" readonly>
                            </div>

                            <div class="input-field" >
                                <label>Treatment ID</label>
                                <input type="text" name="pet-name" value="TRT-<?php echo $data['trtID']; ?>" readonly >
                            </div>

                            <div class="input-field">
                                <label>Age</label>
                                <input  type="text" name="age" value="<?php echo $data['petDetails']->DOB; ?>" readonly>
                            </div>

                        <?php endif; ?>

                            
                    </div>

                    <div class="title">
                        Pet Diagnosis Summary :
                    </div>

                     <div class="fields">

                            <div class="input-field">
                                <label>Diagnosis</label>
                                <textarea class="<?php if(!empty($data['diagnosis_err'])) echo 'is-invalid'; ?>" name="diagnosis" rows="5" placeholder="Type here..."><?php echo $data['diagnosis']; ?></textarea>
                            </div>
                            
                            

                            <div class="input-field">
                                <label>Treatment Plan</label>
                                <textarea class="<?php if(!empty($data['treatment_plan_err'])) echo 'is-invalid'; ?>" name="treatment-plan" rows="5" placeholder="Type here..."><?php echo $data['treatment_plan']; ?></textarea>
                            </div>
                            

                            <div class="input-field">
                                <label>Prescription</label>
                                <textarea class="<?php if(!empty($data['prescription_err'])) echo 'is-invalid'; ?>" name="prescription" rows="5" placeholder="Type here..."><?php echo $data['prescription']; ?></textarea>
                            </div>
                            

                            <div class="input-field">
                                <label>Physical Examination</label>
                                <textarea class="<?php if(!empty($data['examination_err'])) echo 'is-invalid'; ?>" name="examination" rows="5" placeholder="Type here..."><?php echo $data['examination']; ?></textarea>
                            </div>
                            
                    </div>


                    <div class="title">
                        Follow Up Information :
                    </div>

                     <div class="fields">

                            <div class="input-field">
                                <label>Follow Up Reason</label>
                                <textarea class="<?php if(!empty($data['follow-up-reason_err'])) echo 'is-invalid'; ?>" name="follow-up-reason" rows="5" placeholder="Type here..."><?php echo $data['follow-up-reason']; ?></textarea>
                            </div>
                

                            <div class="input-field">
                                <label>Instructions</label>
                                <textarea class="<?php if(!empty($data['instructions_err'])) echo 'is-invalid'; ?>" name="instruction" rows="5" placeholder="Type here..." ><?php echo $data['instructions']; ?></textarea>
                            </div>


                            <div class="input-field">
                                <label>Follow Up Date</label>
                                <input class="<?php if(!empty($data['date_err'])) echo 'is-invalid'; ?>"  id="datepicker" type="date" name="follow-up-date" value="<?php echo $data['date']; ?>">
                            </div>


                            <div class="input-field">
                                <label>Status</label>
                                <select name ="status" class="<?php if(!empty($data['main_err'])) echo 'is-invalid'; ?>">
                                    <option value="" default>Select a Status</option>
                                    <option value="Ongoing" <?php if($data['status'] == "Ongoing") echo 'selected'; ?> >Ongoing</option>
                                    <option value="Closed" <?php if($data['status'] == "Closed") echo 'selected'; ?>>Closed</option>
                                </select>
                            </div>

                            
                    </div>



         

                        <div class="button-form">
                                    <button type="reset"  class="button-submit">Reset</button> 
                                    <button type="submit" id="button-submit" class="button-submit">Add</button>
                        </div>
                        

                    </form>

            </div> <!-- model over -->
        </div>

           



             
                                
        </main>

           




    </div>

   


    <!-- staff add model over -->


    

    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>

    <script>
        var today = new Date();
//yesterday.setDate(yesterday.getDate() - 1);
var currentDate = new Date();

const picker = new easepick.create({
    element: document.getElementById('datepicker'),
    plugins: ['LockPlugin',"AmpPlugin"],
    zIndex: 100,
    AmpPlugin: {
        resetButton: true,
        darkMode: false,
    },
    LockPlugin: {
        minDate: today,
    },
    css: [
      'https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css',
    ],

});
    </script>
 

    
</body>
</html>