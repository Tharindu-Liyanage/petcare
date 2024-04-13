<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/petowner/Dashboard-petowner-appointment.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/appointment.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/dashboard/petowner/medicalReport.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>

    <style>
   
        td{
            user-select: none;
        }

        .download-btn{
            text-align: center;
            margin-top: 20px;
           
        }

        .download-btn .btn{
            display:flex;
            align-items: center;
            padding: 10px 20px;
            background-color: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
        }

        


  </style>


</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/bill_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>View My Ward Medical Bills</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/petowner">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/medicalbill" >My Orders</a></li>
                        >
                        <li><a href="<?php echo URLROOT;?>/petowner/viewMedicalBill/<?php echo $data['id'];?>" class="active">Medical Bills</a></li>
                    </ul>
                </div>


              
               
            </div>

            <!-- Medical report here -->

           

                
                    <div class="bottom-data">

                    <!-- new code here -->

                    

            <div style=" margin:auto;font-size:100%;font-weight:400;line-height:1.4;color:#000;">
            <table id="invoice-table" style="max-width:670px;margin:50px auto 10px;background-color:#fff;padding:50px;-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px;-webkit-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);-moz-box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24);box-shadow:0 1px 3px rgba(0,0,0,.12),0 1px 2px rgba(0,0,0,.24); border-top: solid 10px green;">
                <thead>
                <tr>
                    <th style="text-align:left; font-size:40px;"><img style="max-width: 80px;" src="<?php echo URLROOT;?>/public/img/logo/logo-croped.png" alt="PetCare-Logo"> PetCare</th>
                    <!--<th style="text-align:right;font-weight:400;"><?php// echo $data['cartDetails']->order_date;?></th> -->
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td style="height:35px;"></td>
                </tr>
                <tr>
                    <td  colspan="2" style="border: solid 1px #ddd; padding:10px 20px;">
                    <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:150px">Payment status</span><b style="color:green;font-weight:normal;margin:0"><?php echo $data['paymentDetails']->payment_status ?></b></p>
                    <p style="font-size:14px;margin:0 0 6px 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">AWT-ID</span><?php echo $data['paymentDetails'] -> ward_treatment_id ?></p>
                    <p style="font-size:14px;margin:0 0 0 0;"><span style="font-weight:bold;display:inline-block;min-width:146px">Total amount</span>LKR <?php echo $data['totalPrice'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td style="height:35px;"></td>
                </tr>
                <tr bgcolor="#F5F8FA">
                    <td style="width:50%;padding:20px;vertical-align:top">
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px">Name</span> <?php echo $_SESSION['user_fname'] .' '. $_SESSION['user_lname'] ?></p>
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Email</span><?php echo $_SESSION['user_email'] ?></p>

                    </td>
                    <td style="width:50%;padding:20px;vertical-align:top">
                    <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Address</span><?php echo $_SESSION['user_address'] ?></p>
                                <p style="margin:0 0 10px 0;padding:0;font-size:14px;"><span style="display:block;font-weight:bold;font-size:13px;">Phone</span><?php echo $_SESSION['user_mobile'] ?></p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="font-size:20px;padding:30px 15px 0 15px;">Product Items</td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:15px;">
                    
                    <?php foreach($data['services'] as $service) : ?>

                        <p style="font-size:14px;margin:0;padding:10px;border:solid 1px #ddd;font-weight:bold;">
                        <span style="display:block;font-size:13px;font-weight:normal;"><?php echo $service->service ?></span> LKR <?php  echo $service->price ?>
                    </p>

                    <?php endforeach; ?>


                    </td>
                </tr>
                </tbody>
                <tfooter >
                <tr bgcolor="#EAF0F6">
                        <td colspan="2" align="center" style="padding: 30px 30px;">
                            <h2>Thank You for Choosing PetCare &hearts;</h2>
                            <p> We appreciate your decision to trust PetCare for your pets well-being. Our commitment is to provide exceptional care and service. </p>
                            <a href="http://localhost/petcare/home">Visit Our Site</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center" style="padding: 30px 30px;">
                            <p style="color:#99ACC2"> &copy; 2023-present PetCare. All rights reserved. </p>
                            <!--  <a class="subtle-link" href="#"> Unsubscribe </a>      -->
                        </td>
                    </tr>
                </tfooter>
            </table>

                <!-- donwload button here-->
                <div id="downloadPdf" class="download-btn">
                    <a class="btn" > <i class='bx bx-download' ></i> Download Invoice</a>
                </div>
            </div>


                    <!-- new code over -->
                       
                    </div>

                    

        </main>
    </div>

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js" integrity="sha512-GsLlZN/3F2ErC5ifS5QtgpiJtWd43JWSuIgh7mbzZ8zBps+dvLusV+eNQATqgA/HdeKFVgA5v3S/cIrLF7QnIg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>

    <script>

    const filename = '<?php echo $_SESSION['user_fname'] ?>' + ' - ' + 'AWT-ID-<?php echo $data['paymentDetails'] -> ward_treatment_id ?>' + '.pdf';


        document.getElementById('downloadPdf').addEventListener('click', function () {
    // Select the element that you want to convert to PDF
    const element = document.getElementById('invoice-table');

     // Specify the filename for the downloaded PDF
   
   
        html2pdf(element, { filename: filename });
    });
    </script>
    
</body>
</html>