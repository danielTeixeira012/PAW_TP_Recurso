<?php

require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');

require_once './Application/Validator/LoginValidator.php';
if (count($errors) == 0) {
    SessionManager::addSessionValue('email', $email);
    SessionManager::addSessionValue('tipoUser', $tipoUser);
    if($remember == 'on'){
    setcookie('email', $email, time() + (86400 * 50));
    setcookie('password', sha1($password), time() + (86400 * 50));
    }
    header("location: index.php");
} else {
    require_once './index.php';
}