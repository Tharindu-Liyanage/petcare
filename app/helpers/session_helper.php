<?php

    session_start();

    if (!isset($_SESSION['signup_check'])) {
        $_SESSION['signup_check'] = false;
    }

    if (!isset($_SESSION['staff_user_added'])) {
        $_SESSION['staff_user_added'] = false;
    }

    if (!isset($_SESSION['staff_user_updated'])) {
        $_SESSION['staff_user_updated'] = false;
    }

    if (!isset($_SESSION['staff_user_removed'])) {
        $_SESSION['staff_user_removed'] = false;
    }

    if (!isset($_SESSION['notification'])) {
        $_SESSION['notification'] = null;
    }

    
    

    //flash message helper
    function toast_notification($title,$msg,$icon){

        if($_SESSION['signup_check'] === true || $_SESSION['staff_user_added'] === true || $_SESSION['staff_user_updated'] === true ||  $_SESSION['staff_user_removed'] === true){
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

        $_SESSION['signup_check'] = false;
        $_SESSION['staff_user_added'] =false;
        $_SESSION['staff_user_updated'] =false;
        $_SESSION['staff_user_removed'] =false;
        
        

        }else{
           // echo 'problem  in register session variable or directly come to login page';
            
        }
    }

    function isLoggedIn(){

        if(isset($_SESSION['user_id'] )){
            return true;
        }else{
            return false;
        }
    }

    //flash message helper
    function toast_notifications($title,$msg,$icon){

        if($_SESSION['notification'] === 'ok' ){
            echo '
        <div class="toast">
            <div class="toast-content">
                <i class="' . $icon . '"></i>
                <div class="message">
                    <span class="text text-1">' . $title . '</span>
                    <span class="text text-2">' . $msg . '</span>
                </div>
            </div>
            <i class="fa-solid fa-xmark close"></i>
            <div class="progress"></div>
        </div>';

        
       //set null
        $_SESSION['notification'] = null;

        }else if($_SESSION['notification'] === 'error'){
            echo '
            <div class="toast error">
                <div class="toast-content">
                    <i class="' . $icon . '"></i>
                    <div class="message">
                        <span class="text text-1">' . $title . '</span>
                        <span class="text text-2">' . $msg . '</span>
                    </div>
                </div>
                <i class="fa-solid fa-xmark close"></i>
                <div class="progress perror"></div>
            </div>';


            //set null  
            $_SESSION['notification'] = null;
            
        }
    }



    