<?php

//load Libraries(dotenv)
require_once  __DIR__ . '/../libraries/phpdotenv/vendor/autoload.php';

require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../libraries/Database.php';
require_once __DIR__ . '/../models/BackupModel.php';





$cronjob = new BackupModel();

$cronjob ->autoBackupDatabase();