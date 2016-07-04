<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');

$erros = array();
$input = INPUT_POST;


if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'nomePrestador') && filter_input($input, 'nomePrestador') != '') {
        $name = filter_input($input, 'nomePrestador', FILTER_SANITIZE_STRING);
        if (strlen($name) < 5) {
            $erros['nomePrestador'] = 'Novo parametro deve ter pelo menos 5 caracteres no nome';
        }
    } else {
        $erros['nomePrestador'] = 'Novo parametro nome nao existe';
    }
}


if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
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
    if (!(filter_has_var($input, 'moradaPrestador') && filter_input($input, 'moradaPrestador') != '')) {
        $erros['moradaPrestador'] = 'Novo parametro morada nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (!(filter_has_var($input, 'moradaPrestador') && filter_input($input, 'moradaPrestador') != '')) {
        $erros['moradaPrestador'] = 'Novo parametro morada nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (!(filter_has_var($input, 'codigopostalPrestador') && filter_input($input, 'codigopostalPrestador') != '')) {
        $erros['codigopostalPrestador'] = 'Novo parametro codigo postal nao existe';
    } else {
        $codPostal = filter_input($input, 'codigopostalPrestador');
        $pattern = "/[0-9]{4}-[0-9]{3}/";
        if (preg_match($pattern, $codPostal) === 0) {
            $erros['codigopostalPrestador'] = 'Parametro codigo Postal incorreto';
        }
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (!(filter_has_var($input, 'distritoPrestador') && filter_input($input, 'distritoPrestador') != '')) {
        $erros['distritoPrestador'] = 'Novo parametro distrito postal nao existe';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (!(filter_has_var($input, 'concelhoPrestador') && filter_input($input, 'concelhoPrestador') != '')) {
        $erros['concelhoPrestador'] = 'Novo parametro concelho nao existe';
    }
}

