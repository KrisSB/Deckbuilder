<?php

class Controller {

    function __construct() {
        $this->view = new View();
    }
    public function load_model($name){
        $model_name = $name . '_model';
        $file = 'models/' . $model_name . '.php';
        if(file_exists($file)) {
            require_once $file;
        } else {
            return false;
        }
        if(class_exists($model_name)) {
            $this->model = new $model_name();
        }
    }
}