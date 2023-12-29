<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="<?php echo URLROOT;?>/public/css/error/404.css">
    <title>Petcare:Error 404</title>
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