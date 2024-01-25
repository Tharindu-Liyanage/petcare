<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/dashboard/doctor/accordination.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <title>Dashboard</title>
   </head>
   <body>

   <?php require_once __DIR__ . '/../../common/common_variable/treatment_common.php'; ?>
    <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>

    <main>

         <div class="header">
            <div class="left">
                <h1>Treatment</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/doctor">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/doctor/treatment">Treatment</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/doctor/checkBeforeTreatment" class="active">Past Reports</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">

            

<!-- staff add model here -->
<div class="add-model">

   <div class="header">
        <i class='bx bx-file'></i>
        <h3>Medical Reports</h3>       
    </div>

    <div class="content-table">

        <div class="title">
            Ongoing Medical Report
        </div>

        <div class="table-content">
            <table id="myTable" class="hover">
                <thead>
                    <tr>
                        <th>Treatment ID</th>
                        <th>Veterinarian</th>
                        <th>Visit Date</th>
                        <th>Diagnosis</th>
                        <th>Follow-Up-Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- this is 3 rows dummy values-->
                    <?php
                    if($data['treatmentDetails'] != null):
                    foreach($data['treatmentDetails'] as $treatment): ?> 
                    <tr>
                        <td>TRT-<?php echo $treatment->treatment_id;?></td>

                        <td>
                            <div class="profile-three">
                                <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $treatment->vetpic?>" >
                                <p><?php echo $treatment->vetfname?> <?php echo $treatment->vetlname?></p>
                            </div>
                        </td>

                        <td><?php echo $treatment->visit_date?></td>
                        <td><?php echo $treatment->diagnosis?></td>
                        <td><?php echo $treatment->followup_date !== null ? $treatment->followup_date : '----------'; ?></td>

                        <?php
                                        if ($treatment->status === "Ongoing" ) {
                                            echo '<td class="status-search status-green">' . $treatment->status . '</td>';
                                        } else{
                                            echo '<td class="status-search status-red">' . $treatment->status . '</td>';
                                        }
                        ?>   

                        <td class="action-reports">
                            <a href="<?php echo URLROOT;?>/doctor/viewMedicalReport/<?php echo $treatment->treatment_id;?>" title="Show Medical Report"><i class='bx bx-show' ></i></a>
                            <a href="#" title="Continue This Treatment" ><i class='bx bx-chevron-right' ></i></a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>




    </div>


    <!--2 -->

    <div class="content-table">

        <div class="title">
            Closed Medical Report
        </div>

        <div class="table-content">
            <table id="myTable2" class="hover">
                <thead>
                    <tr>
                        <th>Treatment ID</th>
                        <th>Veterinarian</th>
                        <th>Visit Date</th>
                        <th>Diagnosis</th>
                        <th>Follow-Up-Date</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- this is 3 rows dummy values-->
                
                  <?php
                    if($data['closedTreatmentDetails'] != null):
                       
                    
                   foreach($data['closedTreatmentDetails'] as $closedTreatment): ?>
                    <tr>
                        <td>TRT-<?php echo $closedTreatment->treatment_id;?></td>
                        <td>
                            <div class="profile-three">
                                <img src="<?php echo URLROOT;?>/public/storage/uploads/userprofiles/<?php echo $closedTreatment->vetpic?>" >
                                <p><?php echo $closedTreatment->vetfname?> <?php echo $closedTreatment->vetlname?></p>
                            </div>
                        </td>
                        <td><?php echo $closedTreatment->visit_date?></td>
                        <td><?php echo $closedTreatment->diagnosis?></td>
                        <td><?php echo $closedTreatment->followup_date !== null ? $closedTreatment->followup_date : '----------'; ?></td>

                        <?php
                                        if ($closedTreatment->status === "Ongoing" ) {
                                            echo '<td class="status-search status-green">' . $closedTreatment->status . '</td>';
                                        } else{
                                            echo '<td class="status-search status-red">' . $closedTreatment->status . '</td>';
                                        }
                        ?>   

                        <td class="action-reports">
                            <a href="#" title="Show Medical Report"><i class='bx bx-show' ></i></a>
                            <a href="#" title="Continue This Treatment" ><i class='bx bx-chevron-right' ></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php endif; ?>
                </tbody>
            </table>
        </div>




    </div>


    <!--3 -->

    <div class="content-table">

        <div class="title">
            Animal Ward Medical Report
        </div>

        <div class="table-content">
            <table id="myTable3" class="hover">
                <thead>
                    <tr>
                        <th>Report ID</th>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Doctor ID</th>
                        <th>Doctor Name</th>
                        <th>Report Date</th>
                        <th>View</th>
                    </tr>
                </thead>

                <tbody>
                    <!-- this is 3 rows dummy values-->
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>Max</td>
                        <td>1</td>
                        <td class="profile-three"><img src="<?php echo URLROOT; ?>/public/storage/uploads/userprofiles/user3.jpeg"> Dr. ABC</td>
                        <td>2021-09-20</td>
                        <td class="action-reports">
                            <a href="#" title="Show Medical Report"><i class='bx bx-show' ></i></a>
                            <a href="#" title="Continue This Treatment" ><i class='bx bx-chevron-right' ></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>Max</td>
                        <td>1</td>
                        <td>Dr. fef</td>
                        <td>2021-09-20</td>
                        <td><a href="<?php echo URLROOT;?>/doctor/viewMedicalReport">View</a></td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>1</td>
                        <td>Max</td>
                        <td>1</td>
                        <td>Dr. ssf</td>
                        <td>2021-09-20</td>
                        <td class="action-reports">
                            <a href="#" title="Show Medical Report"><i class='bx bx-show' ></i></a>
                            <a href="#" title="Continue This Treatment" ><i class='bx bx-chevron-right' ></i></a>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>




    </div>

 
   



        </div> <!-- model over -->
            </div> <!-- content over -->

            </main>
            </div>
                        
               

       
      
      <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

   
      <script>
        let table = new DataTable('#myTable');
        let table2 = new DataTable('#myTable2');
        let table3 = new DataTable('#myTable3');



      </script>
   </body>

</html>
