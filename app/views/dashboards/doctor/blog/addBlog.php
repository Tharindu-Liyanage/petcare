<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/dashboard-nav-css.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/admin/addStaff.css">
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/public/css/dashboard/doctor/postBlog.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <title>Dashboard</title>

    <style>
        .form{
            display: block !important;
            padding: 30px 200px !important;
        }

        canvas {
            width: 100%;
            height: 100%;
            border: 1px solid #ddd;
            border-radius: 5px;


            }
    </style>

 

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

                        <li><a href="<?php echo URLROOT;?>/doctor/addBlog" class="active"> > Add Blog</a></li>
                    </ul>
                </div>



               
            </div>

           

            
            <div class="bottom-data">

            

<!-- staff add model here -->
<div class="add-model">

   <div class="header">
    <i class='bx bx-file'></i>
        <h3>Post a Blog</h3>       
    </div>

    
        <div class="form-container">
 
    <form class="form" method="post"  enctype="multipart/form-data" action="<?php echo URLROOT; ?>/doctor/addBlog">

      

    <div class="column">

        <div class="flex-column">

                            <label>Title</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['title_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bx-edit-alt'></i>
                            <input type="text" class="input" name="title" placeholder="Enter title" value="<?php echo $data['title']?>">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>

                        <div class="flex-column">
                            <label>Category</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['category_err'])) ? 'is-invalid' : '' ; ?>">
                            <i class='bx bxs-dashboard' ></i>
                        <select name="category" id="my-selection" class="selection-dropdown">
                                        <option value="Select Category" selected>Select Category</option>
                                        <?php foreach($data['categories'] as $category) : ?>
                                        <option <?php if($data['category'] == $category->id) echo 'selected' ; ?> value="<?php echo $category->id; ?>"><?php echo $category->category_name; ?></option>
                                        <?php endforeach; ?>
                                        
                                    </select>
                        </div>
                        <span class="invalid-feedback"><?php echo $data['category_err']; ?></span>

                        <!--   <div class="name-text">Name</div>
                                                    <div class="inputForm <?php echo (!empty($data['firstname_err'])) ? 'is-invalid' : '' ; ?>">
                                                        <i class='bx bx-dollar' ></i>
                                                        <input type="text" name="fname" class="input text-box firstname-textbox" placeholder="Anna" value="<?php echo $data['settings']->firstname; ?>">
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['lastname_err']; ?></span>
                                                    <div class="inputForm <?php echo (!empty($data['lastname_err'])) ? 'is-invalid' : '' ; ?>">
                                                        <i class='bx bx-dollar' ></i>
                                                        <input type="text" name="lname" class="input text-box lastname-textbox" placeholder="Marie" value="<?php echo $data['settings']->lastname; ?>">
                                                    </div>
                                                    <span class="invalid-feedback"><?php echo $data['lastname_err']; ?></span> -->

                       

                        

    </div> <!-- column tag close -->

    <div class="column">

                    


                        <div class="flex-column">
                            <label>Upload Tumbnail</label>
                        </div>
                        <div class="inputForm <?php echo (!empty($data['img_err'])) ? 'is-invalid' : '' ; ?>">
                        <i class='bx bx-image-alt'></i>
                            <input id="finput" type="file" class="input" name="blog_img" accept="image/*" onchange="upload()">
                        </div>
                        <span class="invalid-feedback"><?php echo $data['img_err']; ?></span>

                        <div class="img-preivew" style="display:none;" id="img-preivew">

                            <div class="flex-column">
                                <label>Image Preview</label>
                            </div>
                            <canvas id="canv1"></canvas>

                        </div>


                        <div class="flex-column">
                            <label>Content</label>
                        </div>
                        
                        
                        <textarea class="<?php echo (!empty($data['content_err'])) ? 'is-invalid' : '' ; ?>" name="content" id="content"   placeholder="Type here"><?php echo $data['content']; ?></textarea>
                        
                        <span class="invalid-feedback"><?php echo $data['content_err']; ?></span>
                        
                </div> <!-- column close -->

               

                <div class="button-form">
                            <button type="reset"  class="button-submit">Reset</button> 
                            <button type="submit" id="button-submit" class="button-submit">Post</button>
                         </div>
                

            </form>
            </div>

            </div> <!-- model over -->
            </div> <!-- content over -->

            </main>

           

        


    </div>

   

    


    <!-- staff add model over -->



    <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
    <script>

    function upload(){
    //img-preivew to display block
    document.getElementById("img-preivew").style.display = "block";
    var imgcanvas = document.getElementById("canv1");
    var fileinput = document.getElementById("finput");
    var image = new SimpleImage(fileinput);
    image.drawTo(imgcanvas);
    }

    </script>
    

    <script src="<?php echo URLROOT; ?>/public/js/toast-notification.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/main.js"></script>
    <script src="<?php echo URLROOT; ?>/public/js/dashboard/manageStaff.js"></script>
    
</body>
</html>