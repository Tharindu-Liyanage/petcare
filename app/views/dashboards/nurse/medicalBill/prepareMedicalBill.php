<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/nurse/bill.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php require_once __DIR__ . '/../../common/favicon.php'; ?>
    <title>PetCare | Medical Bill</title>

    <style>
        .users .header{
            border-bottom: 2px solid #f1f1f1;
        }

        input[type="text"], input[type="number"]{
            width: 100%;
            padding: 10px;
            border: 1px solid #f1f1f1;
            margin: 10px 0;
            border-radius: 5px;
        }

        input[type="text"]:focus, input[type="number"]:focus{
            outline: none;
            border: 1px solid var(--primary);
        }

        .bx{
            font-size: 25px;
        }

        .action-btn{
            background: none;
            border: none;
            font-size: 20px;
            cursor: pointer;
        }

        .action-btn.bin{
            color: #ff0000;
            cursor: pointer;
        }

        .action-btn.add{
            color: #1AA06D;
            cursor: pointer;
        }

        .error{
            border: 1px solid red !important;
        }

    </style>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/bill_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
            <div class="header">
                <div class="left">
                    <h1>Medical Bill</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/doctor">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/doctor/blog" class="active">Medical Bill</a></li>
                    </ul>
                </div>

                

               
            </div>

           

            

        <div class="bottom-data">

         <!--start od orders-->
         <div class="users" id="blog">
                    <div class="header">
                    <i class='bx bx-file' ></i>
                        <h3>Medical Bill</h3>
                    


        </div>

        <!-- conform are -->

              <div class="notifications-container">
        <div class="info-noti">
          <div class="flex">
            <div class="flex-shrink-0">
              <svg class="info-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
            </svg>
            </div>
            <div class="info-prompt-wrap">
              <p class="">
                Your Creating Bill for <span class="trt-id" > Ward Treatment ID <?php echo $data['trtID'];?> </span>. Please fill the below form to create the bill.
              </p>
              <ul class="app-info">
                
                <li>Pet : <span class="trt-id" ><?php echo $data['details']->genPetID?> | <?php echo $data['details']->petname?> </span></li>
                <li>Pet Owner : <span class="trt-id"><?php echo $data['details']->genPetOwnerID?> | <?php echo $data['details']->petownerfname?> <?php echo $data['details']->petownerlname?></span></li>
                <li>Ward Stay Duration : <span class="trt-id" ><?php echo $data['daysDiff'];?> Days</span></li>
              </ul>
          </div>
        </div>
        </div>
      </div>



        <!-- confirm area over-->



        <form id="myForm" action="<?php echo URLROOT?>/nurse/medicalBillCalculate/<?php echo $data['trtID']; ?>" method="POST">
  <div class="table__wrap">
    <table class="table">
      <thead class="table__header">
        <tr class="table__row">
          <th class="table__cell u-text-left">Service</th>
          <th class="table__cell u-text-center">Price</th>
          <th class="table__cell u-text-center">Action</th>
        </tr>
      </thead>

      <tbody id="tbody">
        <tr class="table__row">
          <td class="table__account table__cell">
            <input type="text" class="table__account-content table__link" placeholder="Enter Service" value="Ward Treatment service (<?php echo $data['daysDiff'];?> Days)" name="service[]" readonly>
          </td>
          <td class="table__balance table__cell u-text-right u-font-mono"> <input type="number" class="table__account-content table__link price" placeholder="Enter price" value="" name="price[]"  onchange="updateTotal()"> </td>
          <td class="table__transfer table__cell u-text-center action">
            
            <button type="button" class="action-btn add" onclick="addRow()"  title="Add Row"><i class='bx bx-plus-circle'></i></button>
          </td>
        </tr>
      </tbody>

      <tfoot>
        <tr class="table__row table__row--last">
          <td class="table__cell" align="right"></td>
          <td class="table__balance table__cell u-text-right u-font-mono" id="total">Total LKR: 00.00</td>
          <td class="table__transfer table__cell u-text-center">
            <button type="submit" id="submitBtn" class="btn">Submit</button>
          </td>
        </tr>
      </tfoot>
    </table>
  </div>
</form>
           
 
        </div> <!-- content over -->

             
                                
        </main>

            <!-- warninig model here -->

            <div id="removeModel" class="card-all-background">
             <div class="card">
                <div class="err-header">

                        <div class="image">
                            <span class="material-symbols-outlined">warning</span>                   
                        </div>

                        <div class="err-content">
                            <span class="title">Remove Blog</span>
                            <p class="message">Are you sure you want to remove this blog?</p>
                        </div>

                        <div class="err-actions">
                            <button id="confirmDelete" class="desactivate" type="button">Remove</button>
                            <button id="cancelDelete" class="cancel" type="button">Cancel</button>
                        </div>

                    </div>
                </div>
            </div>




    </div>

   


    <!-- staff add model over -->


    <script>
        // Add new row
  function addRow() {
    var tbody = document.getElementById('tbody');
    var newRow = document.createElement('tr');
    newRow.classList.add('table__row');
    newRow.innerHTML = `
      <td class="table__account table__cell">
        <input type="text" class="table__account-content table__link" name="service[]" placeholder="Enter Service">
      </td>
      <td class="table__balance table__cell u-text-right u-font-mono">
        <input type="text" class="table__account-content table__link price" name="price[]" placeholder="Enter price" onchange="updateTotal()">
      </td>
      <td class="table__transfer table__cell u-text-center action">
        <button type="button" title="Remove" class="action-btn bin" onclick="removeRow(this)"><i class='bx bx-x-circle'></i></button>
        <button type="button" class="action-btn add" onclick="addRow()" title="Add Row"><i class='bx bx-plus-circle'></i></button>
      </td>
    `;
    updateTotal();
    tbody.appendChild(newRow);
  }

  // Remove row
  function removeRow(btn) {
    var row = btn.parentNode.parentNode;
    row.parentNode.removeChild(row);
    updateTotal();
  }

  // Update total
  function updateTotal() {
    var prices = document.querySelectorAll('.price');
    var total = 0;
    prices.forEach(function(price) {
      total += parseFloat(price.value) || 0;
    });
    document.getElementById('total').textContent = 'Total LKR: ' + total.toFixed(2);
  }

  // Add event listener for form submit
document.getElementById('myForm').addEventListener('submit', function(event) {
  var submitBtn = document.getElementById('submitBtn');
  var inputs = document.querySelectorAll('.table__account-content');
  var isValid = true;

  inputs.forEach(function(input) {
    if (input.value.trim() === '') {
      input.classList.add('error');
      isValid = false;
    } else {
      input.classList.remove('error');
    }
  });

  if (!isValid) {
    event.preventDefault(); // Prevent form submission if any field is empty
  
  } else {
    console.log('Form submitted'); // Log "Form submitted" to the console
  }
});

    </script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    
</body>
</html>