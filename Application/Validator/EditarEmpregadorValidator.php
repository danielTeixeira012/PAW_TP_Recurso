<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');

$errorsE = array();
$input = INPUT_POST;

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'emailE') && filter_input($input, 'emailE') != '') {
        $email = filter_input($input, 'emailE', FILTER_SANITIZE_EMAIL);

        if(SessionManager::existSession('email') && SessionManager::existSession('tipoUtilizador') === 'empregador'){
            if(SessionManager::getSessionValue('email') !== $email){
                 $errorsE['emailE'] = 'Email incorrecto';
            }       
        }
    } else {
        $errorsE['emailE'] = 'Parametro email nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'nomeE') && filter_input($input, 'nomeE') != '') {
        $nome = filter_input($input, 'nomeE', FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
        if (strlen($nome) < 5) {
            $errorsE['nomeE'] = 'Pelo menos 5 caracteres no nome';
        }
    } else {
        $errorsE['nomeE'] = 'Parametro name nao existe';
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

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'contactoE') && filter_input($input, 'contactoE') != '') {
        $contato = filter_input($input, 'contactoE', FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
        $pattern = "/^\9[1236][0-9]{7}|2[1-9][0-9]{7}?$/";
        if (preg_match($pattern, $contato) === 0 && strlen($contato) !== 9) {
            $errorsE['contactoE'] = 'Parametro contacto incorreto';
        }
    } else {
        $errorsE['contactoE'] = 'Parametro contacto nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $morada = filter_input($input, 'moradaE', FILTER_SANITIZE_STRING.FILTER_SANITIZE_SPECIAL_CHARS);
    if (!(filter_has_var($input, 'moradaE') && filter_input($input, 'moradaE') != '')) {
        $errorsE['moradaE'] = 'Novo parametro morada nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $distrito = filter_input($input, 'distritoE', FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
    if (!(filter_has_var($input, 'distritoE') && filter_input($input, 'distritoE') != '')) {
        $errorsE['distritoE'] = 'Novo parametro distrito nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
     $concelho = filter_input($input, 'concelhoE', FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS);
    if (!(filter_has_var($input, 'concelhoE') && filter_input($input, 'concelhoE') != '')) {
        $errorsE['concelhoE'] = 'Novo parametro concelho nao existe';
    }
}