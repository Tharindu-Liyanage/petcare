<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/staff.css">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/toast-notification.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <?php require_once __DIR__ . '/../../common/favicon.php'; ?>
    <title>PetCare | Blog</title>
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
                        <li><a href="<?php echo URLROOT;?>/doctor/blog" class="active">Blog</a></li>
                    </ul>
                </div>

                <div class="add-button">
             <a href="<?php echo URLROOT;?>/doctor/addBlog" ><button id="add-form-button">
                <i class='bx bx-user-plus' ></i>
                        Add Article 
                </button> </a>
            </div>

               
            </div>

           

            

            <div class="bottom-data">

                <!--start od orders-->
                <div class="users" id="blog">
                    <div class="header">
                    <i class='bx bxl-blogger' ></i>
                        <h3>Blogs</h3>
                        

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
                                
                                <th>Id</th>
                                <th>Title</th>
                                <th>Publish Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="list">

                        <?php

                        if(count($data['blog']) == 0){

                            echo '<td class="isempty" colspan="8">No data available in table</td>';

                        }else
                            
                                foreach($data['blog'] as $blog) : ?>
                                    <?php  if($_SESSION['user_id'] == $blog->author ) { ; ?>
                                    <tr>
                                        <td class="id-search">BLOG-<?php echo $blog->blogID ; ?></td>
                                        <td class="title-search">
                                        <?php echo $blog->title ; ?>
                                        </td>
                                        <td class="publish-search"><?php echo $blog->publishdate ; ?></td>
                                        <td class="action">
                                            
                                            <div class="act-icon">
                                                <a data-blog-id="<?php echo $blog->blogID?>" class="removeLink" href="<?php echo URLROOT;?>/doctor/deleteBlog/<?php echo $blog->blogID ; ?>" ><i class='bx bx-trash'></i></a>
                                                <a href="<?php echo URLROOT;?>/doctor/updateBlog/<?php echo $blog->blogID ; ?>" ><i class='bx bx-edit' ></i></a>     
                                                
                                            </div>
                                            
                                        </td>
                                    </tr>
                                    <?php  }; ?>
                                <?php endforeach ; ?>
                            


                        
                        </tbody>
                    </table>
                    <?php  include __DIR__ . '/../../common/pagination_footer.php'; ?>
                </div>
 
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

    <?php
     
     if ($_SESSION['notification'] == "error") {
           
        toast_notifications("Modification Alerts!",$_SESSION['notification_msg'],"fas fa-solid fa-xmark check-error"); 
        
    }else if($_SESSION['notification'] == "ok"){

        toast_notifications("Modification Alerts!",$_SESSION['notification_msg'],"fas fa-solid fa-check check"); 

    }

    ?>

   


    <!-- staff add model over -->


    
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/doctor/blogTable.js"></script>
    
</body>
</html>