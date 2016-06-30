<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');
use Config as Conf;
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');

require_once './Application/Validator/LoginValidator.php';
if (count($errors) == 0) {
    SessionManager::addSessionValue('email', $email);
    SessionManager::addSessionValue('tipoUser', $tipoUser);
}

if (count($errors) > 0) {
    require_once './login.php';
} else {
    header("location: index.php");
}