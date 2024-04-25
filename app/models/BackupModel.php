<?php

    class BackupModel{
        private $db;

        public function __construct(){
            $this->db = new Database;
        }

        public function backupDatabase()


        {

            // Determine the operating system
            $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

       
        // Construct the absolute path to the backup directory
        $backupPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'backup'. DIRECTORY_SEPARATOR;


           
            // Generate file name with current timestamp
            $backupFileName = 'backup_' . date('Y-m-d_H-i-s') . '.sql';
            $backupFilePath = $backupPath . $backupFileName;

            if ($isWindows) {

            // Build the mysqldump command using defined DB constants
            $command = "C:/xampp/mysql/bin/mysqldump --host=" . DB_HOST . " --user=" . DB_USER . " --password=" . DB_PASS . " --no-create-db --triggers --routines --events --add-drop-table --add-drop-trigger --skip-lock-tables " . " --single-transaction --extended-insert "  . DB_NAME . " > " . $backupFilePath;
 

            }else{

                $command = "mysqldump --host=" . DB_HOST . " --user=" . DB_USER . " --password=" . DB_PASS . " " . DB_NAME . " --no-create-db --triggers --routines --events --add-drop-table --add-drop-trigger --skip-lock-tables " . " --single-transaction --extended-insert "  . DB_NAME . " > " . $backupFilePath;
            }


            // Execute the command
            $output = [];
            $returnCode = -1;
            exec($command, $output, $returnCode);

            if ($returnCode !== 0) {
            
            } else {
               

                 // Set headers to force download of the backup file
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="' . basename($backupFilePath) . '"');
                header('Content-Length: ' . filesize($backupFilePath));

                // Output the backup file contents
                readfile($backupFilePath);
                unlink($backupFilePath);

               
            }

           

             
        }


        public function autoBackupDatabase(){
            // Define the backup directory
           // $backupDirectory = 'public/storage/uploads/backup';

           $isWindows = strtoupper(substr(PHP_OS, 0, 3)) === 'WIN';

            // Construct the absolute path to the backup directory
            $backupPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . 'backup'. DIRECTORY_SEPARATOR;

            

            // Generate file name with current timestamp
            $backupFileName = 'autoBackup_' . date('Y-m-d_H-i-s') . '.sql';
            $backupFilePath = $backupPath . $backupFileName;

            if ($isWindows) {

                // Build the mysqldump command using defined DB constants
                $command = "C:/xampp/mysql/bin/mysqldump --host=" . DB_HOST . " --user=" . DB_USER . " --password=" . DB_PASS . " --no-create-db --triggers --routines --events --add-drop-table --add-drop-trigger --skip-lock-tables " . " --single-transaction --extended-insert "  . DB_NAME . " > " . $backupFilePath;
     
    
                }else{
    
                    $command = "mysqldump --host=" . DB_HOST . " --user=" . DB_USER . " --password=" . DB_PASS . " " . DB_NAME . " --no-create-db --triggers --routines --events --add-drop-table --add-drop-trigger --skip-lock-tables " . " --single-transaction --extended-insert "  . DB_NAME . " > " . $backupFilePath;
                }

            // Execute the command
            $output = [];
            $returnCode = -1;
            exec($command, $output, $returnCode);

            if ($returnCode !== 0) {
                
            } else {
                
            }
        }
        


    }