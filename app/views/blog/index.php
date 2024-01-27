<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>

    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/blog/blog.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" /> <!--Animate On Scroll Library -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
   
</head>
    <body>
        <!-- start of header -->
        <div class="header">
            hii
        </div>


        <!-- end of header -->
        <div class="title-part">
            <div class="left-heading">
                <div class="heading1">Blog</div>
                <div class="heading2">Latest News</div>
                <div class="heading3">Your pet's health and wellbeing are our top priority.</div>
                <button class="btn book-now-btn">Book Now</button>
            </div>
            <div class="right-heading">
                <img src="" alt="">
                <h4>image here</h4>
            </div>
        </div>
        <div class="middle-part">
                <?php foreach($data['posts'] as $posts) : ?>
                <div class="blog-card">
                    <div class="thumbnail">
                        <img src="" alt="">
                    </div>
                    <div class="blog-title"><?php echo $posts->title ;?></div>
                    <div class="blog-date"><?php echo $posts->publishdate ; ?></div>
                    <div class="blog-body">
                        <p><?php echo $posts->content; ?></p>
                    </div>
                    <button class="read-more-btn">READ MORE</button>
                </div>
                <?php endforeach; ?>

                <?php foreach($data['posts'] as $posts) : ?>
                <div class="blog-card">
                    <div class="thumbnail">
                        <img src="" alt="">
                    </div>
                    <div class="blog-title"><?php echo $posts->title ;?></div>
                    <div class="blog-date"><?php echo $posts->publishdate ; ?></div>
                    <div class="blog-body">
                        <p><?php echo $posts->content; ?></p>
                    </div>
                    <button class="read-more-btn">READ MORE</button>
                </div>
                <?php endforeach; ?>

                <?php foreach($data['posts'] as $posts) : ?>
                <div class="blog-card">
                    <div class="thumbnail">
                        <img src="" alt="">
                    </div>
                    <div class="blog-title"><?php echo $posts->title ;?></div>
                    <div class="blog-date"><?php echo $posts->publishdate ; ?></div>
                    <div class="blog-body">
                        <p><?php echo $posts->content; ?></p>
                    </div>
                    <button class="read-more-btn">READ MORE</button>
                </div>
                <?php endforeach; ?>
        </div>

    
        <!-- start of footer -->
        <div class="footer">
            
        </div>

        <!-- end of footer -->
    </body>
</html>