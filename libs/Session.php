<?php

class Session {

    public static function init_session() {
        session_start();
    }
    public static function get_session($name) {
        return $_SESSION[$name];
    }
    public static function set_session($name,$value) {
        $_SESSION[$name] = $value;
    }
    public static function destroy_session() {
        session_destroy();
    }
    public static function sess_check($name) {
        if(isset($_SESSION[$name])) {
            return TRUE;
        }
    }

}