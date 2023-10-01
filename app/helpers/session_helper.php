<?php

    session_start();

    if (!isset($_SESSION['signup_check'])) {
        $_SESSION['signup_check'] = false;
    }
    

    //flash message helper
    function toast_notification($title,$msg,$icon){

        if($_SESSION['signup_check'] === true){
            echo '
        <div class="toast">
            <div class="toast-content">
                <i class="fas fa-solid fa-check check"></i>
                <div class="message">
                    <span class="text text-1">' . $title . '</span>
                    <span class="text text-2">' . $msg . '</span>
                </div>
            </div>
            <i class="' . $icon . '"></i>
            <div class="progress"></div>
        </div>';

        unset($_SESSION['signup_check']);

        }else{
           // echo 'problem  in register session variable or directly come to login page';
            
        }

        

    }
    