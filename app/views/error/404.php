<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/error/404.css">

    <link rel="apple-touch-icon" sizes="180x180" href="http://localhost/petcare/public/img/favicons/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="http://localhost/petcare/public/img/favicons/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="http://localhost/petcare/public/img/favicons/favicon-16x16.png">
    <link rel="icon" href="http://localhost/petcare/public/img/favicons/favicon.ico" type="image/x-icon">


    <title>Petcare: 404 Not Found </title>
</head>
<body>
        <header>
            <a href = "#" class = "title">404 NOT FOUND</a>
            <div class = "parent-container">
                <img class = "image" src="<?php echo URLROOT;?>/public/img/error/404_sad_cat.gif">
                <div class = "item-container">
                    <h3>Woof, Where's the Page? 404 Error</h3>
                    <p>The page you are seeking may have been removed or is currently temporarily unavailable. We apologize for any inconvenience. Please consider navigating to our homepage or contacting our support team for assistance. Thank you for your understanding.
                    </p>
                    <a href = "#" href  class = "home-page-btn" onclick="goBack()">Go Back</a>
                </div>
            </div>
        </header>
</body>

<script>
    function goBack() {
        // Use the history object to navigate back
        window.history.back();
    }
</script>
</html>