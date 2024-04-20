<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/petowner/Dashboard-petowner-appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>PetCare | Appointment</title>
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.umd.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>



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
                    </ul>
                </div>


              
               
            </div>

            <!-- appointmetn here -->

            <div class="appointment-box">
                    <div class="apppoitnment-left">
                        <div class="appointment-text-large">
                            Need an Appointment?
                        </div>
                        <div class="appointment-text-down">
                        <a style="text-decoration:none;" href="<?php echo URLROOT;?>/petowner/addAppointment"><i class='bx bx-plus-circle'></i></a>
                            <div class="appointment-text-down-small">
                                Appointment
                            </div>
                        </div>
                    </div>
                    <div class="apppoitnment-right">
                        <img src="<?php echo URLROOT;?>/public/img/dashboard/petowner-appointment.svg" alt="">
                    </div>
                </div>


                
                    <div class="bottom-data">
                       


                    <div class="users" id="appointment">
                    <div class="header">
                    <i class='bx bx-calendar'></i>
                        <h3>Appointment</h3>

                     <!-- Search Container -->

                     
                   
                     
                     <!-- HTML -->
                    <div class="date-filter-container" >
                    
                    <input type="text" id="datepicker" name="text" class="search" placeholder="Filter Dates..">
                    <i class='bx bx-calendar date-filter'></i>
                    </div>

                     
                    

                    <!-- search container over -->

                    <!-- Search Container -->

                    <div class="search-container-table">
                     <input type="text"  id="userSearch" name="text" class="search" placeholder="Search here..">
                     <i class='bx bx-search' ></i>
                    </div>

                    <!-- search container over -->


                      
                        
                        
                    </div>
                    <table>
                        <thead>
                            <tr>
                                
                                <th>Id <i class='bx bxs-sort-alt sort' data-sort="id-search"></i></th>
                                <th>Pet Name <i class='bx bxs-sort-alt sort' data-sort="profile"></th>
                                <th>Veterinarian<i class='bx bxs-sort-alt sort' data-sort="profile-three"></th>
                                <th>Date <i class='bx bxs-sort-alt sort' data-sort="date-search"></th>
                                <th>Time <i class='bx bxs-sort-alt sort' data-sort="time-search"></th>
                                <th>Species <i class='bx bxs-sort-alt sort' data-sort="species-search"></th>
                                <th>Treatment <i class='bx bxs-sort-alt sort' data-sort="treatment-search"></th>
                                <th>Type <i class='bx bxs-sort-alt sort' data-sort="type-search"></th>
                                <th>Status <i class='bx bxs-sort-alt sort' data-sort="status-search"></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">

                        

                            <?php

                            if(count($data['appointment']) == 0){

                                echo '<td class="isempty" colspan="8">No data available in table</td>';

                            }else
                            
                            
                            foreach($data['appointment'] as $appointment) : ?>

              


                            <tr data-id="<?php echo $appointment->appointment_id?>" data-profile="<?php echo $appointment->pet_name?>" data-date="<?php echo $appointment->appointment_date?>">
                                <td class="id-search"><?php echo $appointment->appointment_id?></td>
                                <td class="profile">
                                    <img src="<?php echo URLROOT;?>/public/storage/uploads/animals/<?php echo $appointment->propic?>" ><p><?php echo $appointment->pet_name?></p>
                                </td>

                                 <td>
                                    <div class="profile-three">
                                        <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $appointment->vetpic?>" >
                                    <p><a href="<?php echo URLROOT?>/petowner/viewProfile/<?php echo $appointment->vet_id; ?>"><?php echo $appointment->fname?> <?php echo $appointment->lname?></a></p>
                                    </div>
                                </td>

                                <td class="date-search"><?php echo $appointment->appointment_date?></td>
                                <td class="time-search"><?php echo $appointment->appointment_time?></td>
                                <td class="species-search"><?php echo $appointment->pet_species?></td>


                                <td class="treatment-search">
                                    
                                    <?php if($appointment->treatment_id == NULL){
                                        echo "NEW";
                                        }else{
                                            echo 'TRT-'. $appointment->treatment_id;
                                        
                                        } ?>
                                </td>



                                <td class="type-search"><?php echo $appointment->appointment_type?></td>

                                   
                                <?php
                                        if ($appointment->status === "Confirmed" || $appointment->status === "Completed" ) {
                                            echo '<td class="status-search status-green">' . $appointment->status . '</td>';
                                        } else if($appointment->status === "Pending") {
                                            echo '<td class="status-search status-yellow">' . $appointment->status . '</td>';
                                        }else{
                                            echo '<td class="status-search status-red">' . $appointment->status . '</td>';
                                        }

                                        //action restricted for reshedule appoitments
                                        
                                        if ($appointment->status === "Confirmed" || $appointment->status === "Rejected") {
                                            echo '<td class="action"> <div class="act-icon"> <a href="' . URLROOT . '/petowner/updateAppointment/' . $appointment->id . '"><i class="bx bx-edit"></i></a> </div> </td>';
                                        } else {
                                            echo '<td class="action"> ---  </td>';
                                        }

                                ?>

                                
                            </tr>

                        <?php endforeach;  ?>
                        </tbody>
                    </table>

                    <?php include __DIR__ . '/../../common/pagination_footer.php'; ?>


                </div>
 
            </div> <!-- content over -->


           



             
                                
        </main>


        <?php
            
            if(!isset($_SESSION['notification'])){
                $_SESSION['notification_title'] = "";
            }

            if ($_SESSION['notification'] == "error") {
                
                toast_notifications("Something Went Wrong!",$_SESSION['notification_msg'],"bx bx-x check-error"); 
                
            }else if($_SESSION['notification'] == "ok"){

                toast_notifications("Success!",$_SESSION['notification_msg'],"fas fa-solid fa-check check"); 
                
            }

        ?>

                      

           




    </div>

    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/appointmentTable.js"></script>

    <script>
   


      const picker = new easepick.create({
  element: "#datepicker",
  css: [
    "https://cdn.jsdelivr.net/npm/@easepick/bundle@1.2.1/dist/index.css"
  ],
  zIndex: 100,
 // autoApply: false,
  AmpPlugin: {
        resetButton: true,
        darkMode: false,
    },
   
  plugins: [
    "RangePlugin",
    "AmpPlugin",
   
  ],

  setup(picker) {
    picker.on('select', (date) => {
      var startDate = picker.getStartDate();
      var endDate = picker.getEndDate();
      console.log("Start Date:", startDate, "End Date:", endDate);

    // Convert to IST and format as "YYYY-MM-DD"
    var options = { timeZone: 'Asia/Kolkata', year: 'numeric', month: '2-digit', day: '2-digit' };
    var formattedStartDate = startDate.toLocaleString('en-IN', options).split(',')[0];
    var formattedEndDate = endDate.toLocaleString('en-IN', options).split(',')[0];

    // Convert to "YYYY-MM-DD" format
    var isoFormattedStartDate = formattedStartDate.split('/').reverse().join('-');
    var isoFormattedEndDate = formattedEndDate.split('/').reverse().join('-');

    console.log("Start FDate:", isoFormattedStartDate, "End FDate:", isoFormattedEndDate);


      userList.filter(function (item) {
       
        var itemDate = item.values().date;
        console.log(itemDate);
         return itemDate >= isoFormattedStartDate && itemDate <= isoFormattedEndDate;
         
    });

    });

    picker.on('clear', () => {
      console.log("Reset");
      userList.filter();
    });
  },
});


var itemsInList = [];

<?php foreach($data['appointment'] as $appointment) : ?>
    itemsInList.push({  date: "<?php echo $appointment->appointment_date?>" })
    <?php endforeach;  ?>





   
           
    </script>


   
    
</body>
</html>