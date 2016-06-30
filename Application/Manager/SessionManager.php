<?php

/**
 * 
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class SessionManager {

    protected static function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function addSessionValue($key, $value) {
        self::startSession();
        if (!array_key_exists($key, $_SESSION)) {
            $_SESSION[$key] = $value;
        } else {
            throw new Exception("ERROR: SESSION ALREADY START");
        }
    }

    public static function updateSessionValue($key, $value) {
        self::startSession();
        if (array_key_exists($key, $_SESSION)) {
            $_SESSION[$key] = $value;
        } else {
            throw new Exception("ERROR: KEY DOESN'T EXISTS");
        }
    }

    public static function deleteSessionValue($key) {
        self::startSession();
        if (array_key_exists($key, $_SESSION)) {
            unset($_SESSION[$key]);
        } else {
            throw new Exception("ERROR: KEY DOESN'T EXISTS");
        }
    }

    public static function getSessionValue($key) {
        self::startSession();
        if (array_key_exists($key, $_SESSION)) {
            return $_SESSION[$key];
        } else {
            throw new Exception("ERROR: KEY DOESN'T EXISTS");
        }
    }

    public static function destroySession() {
        self::startSession();
        if (!session_status() === PHP_SESSION_NONE) {
            $_SESSION = array();
            session_destroy();
        } else {
            throw new Exception("ERROR: SESSION DOESN'T EXISTS");
        }
    }

    public static function existSession($key) {
        self::startSession();
        if (array_key_exists($key, $_SESSION)) {
            return true;
        }
        return false;
    }

}
