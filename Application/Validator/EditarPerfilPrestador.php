<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');

$erros = array();
$input = INPUT_POST;

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'emailP') && filter_input($input, 'emailP')) {
        $email = filter_input($input, 'emailP', FILTER_SANITIZE_EMAIL);
        if (SessionManager::existSession('email') && SessionManager::existSession('tipoUtilizador') === 'prestador') {
            if (SessionManager::getSessionValue('email') !== $email) {
                $errorsE['emailP'] = 'Email incorrecto';
            }
        }
    } else {
        $errors['emailP'] = 'Parametro email nao existe';
    }
}



if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'nomePrestador') && filter_input($input, 'nomePrestador') != '') {
        $nome = filter_input($input, 'nomePrestador', FILTER_SANITIZE_STRING);
        if (strlen($nome) < 5) {
            $erros['nomePrestador'] = 'Novo parametro deve ter pelo menos 5 caracteres no nome';
        }
    } else {
        $erros['nomePrestador'] = 'Novo parametro nome nao existe';
    }
}


if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $contato = filter_input($input, 'contactoPrestador', FILTER_SANITIZE_STRING);
    if (!(filter_has_var($input, 'contactoPrestador') && filter_input($input, 'contactoPrestador') != '')) {
        $erros['contactoPrestador'] = 'Novo parametro contacto nao existe';
    } else {
        $contato = filter_input($input, 'contactoPrestador', FILTER_SANITIZE_STRING);
        $pattern = "/9[1236][0-9]{7}|2[1-9][0-9]{7}/";
        if (preg_match($pattern, $contato) === 0) {
            $erros['contactoPrestador'] = 'Parametro contacto incorreto';
        }
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $morada = filter_input($input, 'moradaPrestador', FILTER_SANITIZE_STRING);
    if (!(filter_has_var($input, 'moradaPrestador') && filter_input($input, 'moradaPrestador') != '')) {
        $erros['moradaPrestador'] = 'Novo parametro morada nao existe';
    }
}


if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
      $codPostal = filter_input($input, 'codigopostalPrestador', FILTER_SANITIZE_STRING);
    if (!(filter_has_var($input, 'codigopostalPrestador') && filter_input($input, 'codigopostalPrestador') != '')) {
        $erros['codigopostalPrestador'] = 'Novo parametro codigo postal nao existe';
    } else {
        $codPostal = filter_input($input, 'codigopostalPrestador');
        $pattern = "/^\[0-9]{4}(-\[0-9]{3})?$/";
        if (preg_match($pattern, $codPostal) === 0 && strlen($codPostal) !== 8) {
            $erros['codigopostalPrestador'] = 'Parametro codigo Postal incorreto';
        }
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $distrito = filter_input($input, 'distritoPrestador');
    if (!(filter_has_var($input, 'distritoPrestador') && filter_input($input, 'distritoPrestador') != '')) {
        $erros['distritoPrestador'] = 'Novo parametro distrito postal nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $concelho = filter_input($input, 'concelhoPrestador');
    if (!(filter_has_var($input, 'concelhoPrestador') && filter_input($input, 'concelhoPrestador') != '')) {
        $erros['concelhoPrestador'] = 'Novo parametro concelho nao existe';
    }
}

