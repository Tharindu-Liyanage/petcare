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
                <img class = "image" src="<?php echo URLROOT;?>/public/img/error/404.svg">
                <div class = "item-container">
                    <h3>I have a bad news for you</h3>
                    <p>The page are looking  for might be removed or is
                    temporarily unavailable
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