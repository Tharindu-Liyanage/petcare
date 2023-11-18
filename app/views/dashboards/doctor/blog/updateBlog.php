<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/temp/Dashboard-vet-blog-add.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>
</head>
<body>



<?php require_once __DIR__ . '/../../common/common_variable/blog_common.php'; ?>
<?php include __DIR__ . '/../../common/dashboard-top-side-bar.php'; ?>


       

        <main>
        <div class="header">
                <div class="left">
                    <h1>Blog</h1>
                    <ul class="breadcrumb">
                        <li><a href="<?php echo URLROOT;?>/doctor">
                           Dashboard
                        </a></li>  
                        >
                        <li><a href="<?php echo URLROOT;?>/doctor/blog">Blog</a></li> 

                        <li><a href="<?php echo URLROOT;?>/doctor/updateBlog" class="active"> > Update Article</a></li>
                    </ul>
                </div>



               
            </div>

           

            

            <div class="box">
                    <div class="title-line">
                        <i class='bx bxs-file-plus'></i>
                        <div class="title-line-text">Update Article</div>
                    </div>
                    <div class="bottom-part">
                        <div class="left">
                            <div class="article-title">
                                <div class="article-title-text">Article Title </div>
                                <div class="article-title-box">
                                    <i class='bx bx-pencil' ></i>
                                    <input type="text"  value="Adopting a Pet">
                                </div>
                            </div>
                            <div class="select-category">
                                <div class="select-category-text"> Select Category </div>
                                <div class="select-category-box">
                                    <i class='bx bxs-dashboard' ></i>
                                    
                                    <select id="my-selection" class="selection-dropdown">
                                        <option value="option1"  selected>Pet Adoption</option>
                                        <option value="option2">Health Tips</option>
                                        <option value="option3">petcare</option>
                                        <option value="option4">Nutrition & Diet</option>
                                    </select>
                                </div>
                            </div>
                            <div class="tags">
                                <div class="tags-text"> Tags </div>
                                <div class="tags-box">
                                    <i class='bx bx-purchase-tag' ></i>
                                    <select id="my-selection" class="selection-dropdown">
                                        <option value="option1" >All Categories</option>
                                        <option value="option2" selected>Pet Adopt</option>
                                        <option value="option3">petcare</option>
                                        <option value="option4">Nutrition & Diet</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="right">
                            <div class="thumbnail">
                                <div class="thumbnail-text"> Thumbnail</div>
                                <div class="thumbnail-box">
                                    <i class='bx bx-notepad' ></i>
                                    <input type="text" value="petadopt.jpg">
                                </div>
                                
                            </div>
                            <div class="content1">
                                <div class="content1-text"> Content </div>
                                <div class="content1-box">
                                    <i class='bx bx-pencil' ></i>
                                    <textarea name="content-input" id="" cols="30" rows="10">Pet adoption is a wonderful way to add a new furry friend to your family. There are millions of animals in shelters and rescue groups waiting for their forever homes. When you adopt a pet, you are giving them a second chance at a happy life.</textarea>
                                </div>
                                
                            </div>
                        </div>
                    </div>

                    <div class="footer">
                        <div class="button-set">
                            <button class="reset-button">Reset</button>
                            <button class="update-button">Update</button>
                        </div>
                    </div>
                </div>

             
                                
        </main>

           




    </div>

    

   


    <!-- staff add model over -->


    

    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/manageStaff.js"></script>
    
</body>
</html>