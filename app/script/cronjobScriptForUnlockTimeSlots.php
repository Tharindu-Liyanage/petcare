<?php

//this file executes the cronjob every 5 minutes

//load Libraries(dotenv)
require_once  __DIR__ . '/../libraries/phpdotenv/vendor/autoload.php';
  
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../libraries/Database.php';
require_once __DIR__ . '/../models/CronjobModel.php';




$cronjob = new CronjobModel();

$cronjob ->unlockTimeSlot();

