<?php

require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'AdministradorManager.php');
$session = SessionManager::existSession('email');
if (!$session && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
    $managerPrestador = new PrestadorManager();
    $managerEmpregador = new EmpregadorManager();
    $managerAdministrador = new AdministradorManager();
    $email = $_COOKIE['email'];
    $password = $_COOKIE['password'];
    if ($managerPrestador->existsPrestadorServico($email, $password)) {
        $tipoUser = 'prestador';
        SessionManager::addSessionValue('email', $email);
        SessionManager::addSessionValue('tipoUser', $tipoUser);
    } else if ($managerEmpregador->existsEmpregador($email, $password)) {
        $tipoUser = 'empregador';
        SessionManager::addSessionValue('email', $email);
        SessionManager::addSessionValue('tipoUser', $tipoUser);
    } else if ($managerAdministrador->existsAdministrador($email, $password)) {
        $tipoUser = 'administrador';
        SessionManager::addSessionValue('email', $email);
        SessionManager::addSessionValue('tipoUser', $tipoUser);
    } else {
        $errors['login'] = "Dados introduzidos inválidos";
    }
}