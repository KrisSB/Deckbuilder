<?php

class View {
    
    public $name;
    
    function __construct() {
        
    }
    public function render($folder,$name) {
        $this->name = $folder;
        require_once 'views/header.php';
        require_once 'views/' . $folder . '/' . $name . '.php';
        require_once 'views/footer.php';
        
    }
    public function require_page($name) {
        require_once 'views/' . $name . '.php';
    }

}