<?php

class Database extends PDO {

    function __construct() {
        try {
            parent::__construct("mysql:host=127.0.0.1;dbname=deck","root","");
        } catch(Exception $e) {
            Echo 'Error with Database';
        }
    }

}