<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');


$errorsE = array();
$input = INPUT_POST;

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'emailE') && filter_input($input, 'emailE')) {
        $email = filter_input($input, 'emailE', FILTER_SANITIZE_EMAIL);
        $manager = new EmpregadorManager();
        $exist = $manager->verifyEmail($email);
        $manager1 = new PrestadorManager();
        $exist1 = $manager1->verifyEmail($email);
        /**
         * verificar se o email tambem existe na outro tipo de utilizador
         */
        if ((!empty($exist) && $exist[0]['email'] === $email) || (!empty($exist1) && $exist1[0]['email'] === $email)) {
            $errorsE['emailE'] = 'Email já existe';
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorsE['emailE'] = 'Email incorrecto';
        }
    } else {
        $errorsE['emailE'] = 'Parametro email nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'nomeE') && filter_input($input, 'nomeE') != '') {
        $nome = filter_input($input, 'nomeE', FILTER_SANITIZE_STRING);
        if (strlen($nome) < 5) {
            $errorsE['nomeE'] = 'Pelo menos 5 caracteres no nome';
        }
    } else {
        $errorsE['nomeE'] = 'Parametro name nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'passE') && filter_input($input, 'passE') != '') {
        $password = filter_input($input, 'passE', FILTER_SANITIZE_STRING);
        if (strlen($password) < 5) {
            $errorsE['passE'] = 'Pelo menos 5 caracter na password';
        }
    } else {
        $errorsE['passE'] = 'Parametro password nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'contactoE') && filter_input($input, 'contactoE') != '') {
        $contato = filter_input($input, 'contactoE', FILTER_SANITIZE_STRING);
        $pattern = "/9[1236][0-9]{7}|2[1-9][0-9]{7}/";
        if (preg_match($pattern, $contato) === 0) {
            $errorsE['contactoE'] = 'Parametro contacto incorreto';
        }
    } else {
        $errorsE['contactoE'] = 'Parametro contacto nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'codigopostalE') && filter_input($input, 'codigopostalE') != '') {
        $codPostal = filter_input($input, 'codigopostalE', FILTER_SANITIZE_STRING);
        $pattern = "/^\[0-9]{4}(-\[0-9]{3})?$/";
        if (preg_match($pattern, $codPostal) === 0 && strlen($codPostal) !== 8) {
            $errorsE['codigopostalE'] = 'Parametro codigo Postal incorreto';
        }
    } else {
        $errorsE['codigopostalE'] = 'Parametro codido Postal nao existe';
    }
}
