<?php
    // Load Config

    date_default_timezone_set('Asia/Kolkata');

    use Dotenv\Dotenv;
    
    $dotenv = Dotenv::createImmutable(__DIR__ . '/../..');
    $dotenv->load();

    //DB Params
    define('DB_HOST','localhost');
    define('DB_USER', 'root');
    define('DB_PASS','');
    define('DB_NAME','petcareDB');


    // App root
    define('APPROOT', dirname(dirname(__FILE__)));
    // URL Root
    define('URLROOT','http://localhost/petcare');

    //storage path

    define('STORAGE_PATH', 'http://localhost/petcare/public/storage');


    // Site Name
    define('SITENAME', 'PetCare');
