<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
      <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css">
      <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/petowner/medicalReport.css">
      <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
      <?php require_once __DIR__ . '/../../common/favicon.php'; ?>
      <title>PetCare | Treatment</title>
   </head>
   <body>

   <?php require_once __DIR__ . '/../../common/common_variable/medicalreport_common.php'; ?>
    <?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>

    <main>

         <div class="header">
            <div class="left">
                <h1>Medical Report</h1>
                <ul class="breadcrumb">
                    <li><a href="<?php echo URLROOT;?>/petowner">Dashboard</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/doctor/treatment">Treatment</a></li>
                    <li> > </li> <!-- Include the ">" character within an <li> element -->
                    <li><a href="<?php echo URLROOT;?>/doctor/viewMedicalReport" class="active">Show Medical Report</a></li>
                </ul>
            </div>
        </div>

        <div class="bottom-data">

            

    <!-- staff add model here -->
    <div class="add-model">

        <div class="header">
        <i class='bx bx-file'></i>
                <h3>PetCare Medical Report</h3>       
        </div>

        <div class="splide" role="group" aria-label="Splide Basic HTML Example">
            <div class="splide__track">

            <ul class="splide__list">

            <?php foreach($data['medicalreportview'] as $medicalreport) : ?>

              

                <li class="splide__slide">


                        <!-- report Start -->
                        <div id="report" class="report">
                            <div class="report-header">

                                <div class="report-logo">
                                    <img src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png">
                                    <span>PetCare</span>
                                </div>

                            

                                <div class="report-title">
                                    
                                    <div class="title"><span>Medical Report</span></div>
                                    <div class="title-date"><span>Date</span>: <?php echo $medicalreport->visit_date?></div>
                                    <div class="title-date"><span>Treatment ID</span>: TRT-<?php echo $medicalreport->treatment_id?></div>
                                    
                                </div>

                            </div>

                            <div class="report-content">

                                <div class="main-title fw-500">
                                        Contact Infomation
                                </div>

                                    <div class="report-info-both">

                                        <div class="hospital-info">
                                            <div class="title fw-500 fs-large">Veterinarian Hospital Info:</div>
                                            <div class="hospital-name">PetCare Hospital</div>
                                            <div class="hospital-address"><?php echo $data['petcareInfo'][0]->hospital_address?></div>
                                            <div class="hospital-contact"><?php echo $data['petcareInfo'][0]->hospital_contact?></div>
                                            <div class="hospital-contact"><?php echo $data['petcareInfo'][0]->hospital_email?></div>
                                            

                                        </div>

                                    

                                        <div class="petowner-info">

                                            <div class="title fw-500 fs-large">Pet Owner:</div>
                                            <div><span class="fw-500">Id: </span><?php echo $medicalreport->genIdPetOwner?></div>
                                            <div><span class="fw-500">Name: </span><?php echo $medicalreport->petownerfname.' ' .$medicalreport->petownerlname;?></div>
                                            <div><span class="fw-500">Address: </span><?php echo  $medicalreport->petowneraddress?></div>
                                            <div><span class="fw-500">Mobile: </span>+<?php echo $medicalreport->petownerphone ?></div>
                                            
                                        </div>
                                    </div>

                                <div class="main-title fw-500">
                                        Treatment Information
                                </div>

                                <div class="report-treatment-info">

                                    <div class="title fw-500 fs-large">Pet Info:</div>

                                    <div class="pet-info">

                                        
                                            <div><span class="fw-500">Id: </span><?php echo $medicalreport->genIdPet?></div>
                                            <div><span class="fw-500">Name: </span><?php echo $medicalreport->pet?></div>
                                            <div><span class="fw-500">Age: </span><?php echo $medicalreport->petAge?></div>
                                            <div><span class="fw-500">Breed: </span><?php echo $medicalreport->breed?></div>
                                            <div><span class="fw-500">Sex: </span><?php echo $medicalreport->petsex?></div>
                                            <div><span class="fw-500">Species: </span><?php echo $medicalreport->species?></div>
                    
                                    </div>

                                    

                                    <div class="title fw-500 fs-large">Pet Diagnostic Summary:</div>

                                    <div class="Pet-diagnostic-summary">

                                        
                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Diagnosis: </div>
                                            <div class="summury-content"><?php echo $medicalreport->diagnosis?></div>
                                        </div>

                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Treatment Plan: </div>
                                            <div class="summury-content"><?php echo $medicalreport->treatment_plan?></div>
                                        </div>

                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Prescription: </div>
                                            <div class="summury-content"><?php echo $medicalreport->prescription?></div>
                                        </div>

                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Physical Examination: </div>
                                            <div class="summury-content"><?php echo $medicalreport->physical_examination?></div>
                                        </div>

                                        
                                    </div>


                                    <div class="title fw-500 fs-large">Visit Details and Follow-up Information:</div>

                                    <div class="Pet-diagnostic-summary">

                                        
                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Visit Date: </div>
                                            <div class="summury-content"><?php echo $medicalreport->visit_date?></div>
                                        </div>

                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Veterinarian Name: </div>
                                            <div class="summury-content"><?php echo $medicalreport->vetfname . ' ' . $medicalreport->vetlname?></div>
                                        </div>

                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Follow-up Date: </div>
                                            <div class="summury-content"><?php echo $medicalreport->followup_date !== null ? $medicalreport->followup_date : 'None'; ?></div>

                                        </div>

                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Follow-up Reason: </div>
                                            <div class="summury-content"><?php echo $medicalreport->followup_reason !== null ? $medicalreport->followup_reason : 'None'; ?></div>

                                        </div>

                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Status: </div>
                                            <div class="summury-content"> <?php echo $medicalreport->status?></div>
                                        </div>

                                        <div class="topic"> 
                                            <div class="summury-title fw-500">Instruction: </div>
                                            <div class="summury-content"> <?php echo $medicalreport->instruction?></div>
                                        </div>

                                        
                                    </div>



                                </div>

                            
                        
                            </div>

                        </div> <!-- report over -->

                </li>

                <?php endforeach;  ?>
                </ul>

                </div>
               
            </div> <!-- splide over -->

           
            <footer class="modal-container-footer">
                <button type="button" class="button is-ghost" onclick="window.history.back()">Back</button>
                    <button  id="downloadPdf" class="button is-primary"><i class='bx bx-download' ></i> Download</button>
            </footer>
    </div> <!-- model over -->


</div> <!-- content over -->

</main>
</div>

<script>
     const filename = '<?php echo $medicalreport->petname?>' + ' - ' + 'TRT-<?php echo $medicalreport->treatment_id?>' + '.pdf';

</script>
               

       
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
<script src="<?php echo URLROOT; ?>/public/js/dashboard/petowner/viewMedicalReport.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
</body>

</html>