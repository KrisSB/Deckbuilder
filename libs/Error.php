<?php

class Error {

    function __construct() {
        
    }
    public static function page_not_exist() {
        echo "Error, the page you are looking for does not exist";
        exit;
    }

}