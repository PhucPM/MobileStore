<?php

class Session {

    public function __construct() {
        $this->init();
    }

    public static function init() {
        @session_start();
    }

    public static function set($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get($key) {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function destroy() {
        session_destroy();
    }

}