<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'AdministradorManager.php');


$errors = array();
$input = INPUT_POST;

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'email') && filter_input($input, 'email') != '' && filter_has_var($input, 'pass') && filter_input($input, 'pass')) {
        if (filter_input($input, 'email', FILTER_SANITIZE_EMAIL)) {
            $email = filter_input($input, 'email');
            $password = filter_input($input, 'pass');
            $remember =  filter_input($input, 'remember');
            $managerPrestador = new PrestadorManager();
            $managerEmpregador = new EmpregadorManager();
            $managerAdministrador = new AdministradorManager();
            if ($managerPrestador->existsPrestadorServico($email, sha1($password))) {
                $tipoUser = 'prestador';
            } else if ($managerEmpregador->existsEmpregador($email, sha1($password))) {
                $tipoUser = 'empregador';
            } else if ($managerAdministrador->existsAdministrador($email, sha1($password))) {
                $tipoUser = 'administrador';
            } else {
                $errors['login'] = "Dados introduzidos inválidos";
            }
        }
    } else {

        $errors['email'] = "erro";
    }
}
