<?php
  /*
   * Base Controller
   * Loads the models and views
   */
  class Controller {
    // Load model
    public function model($model){

      $modelPath = '../app/models/' . $model . '.php';


      // Require model file
    
      require_once '../app/models/' . $model . '.php';

      // Instatiate model
      return new $model();

      

         


    }

    // Load view
    public function view($view, $data = []){
      // Check for view file
      if(file_exists('../app/views/' . $view . '.php')){
        require_once '../app/views/' . $view . '.php';
      } else {
        // View does not exist
        header("Location: " . URLROOT . "/errorhandler/notfound");
      }
    }
  }