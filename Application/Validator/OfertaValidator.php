<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');

$errorsO = array();
$input = INPUT_POST;

$manOferta =  new OfertaManager();
$categoria = filter_input($input, 'categoriaO');
$tipo = filter_input($input, 'tipoO');
$status = filter_input($input, 'statusO');

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'dataInicio') && filter_input($input, 'dataInicio') != '') {
        $data = $manOferta->getDataAtual();
        $dataInicio = filter_input($input, 'dataInicio');
        if($dataInicio < $data){
                  $errorsO['dataInicio'] = 'A data de início já passou';  
        } 
    } else {
        $errorsO['dataInicio'] = 'A data não é válida';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'dataFim') && filter_input($input, 'dataFim') != '') {
        $dataFim = filter_input($input, 'dataFim');
        if($dataFim < $dataInicio){
               $errorsO['dataFim'] = 'A data limite é inferior á data de Início';
           }
        if($dataFim <= $data){       
                  $errorsO['dataFim'] = 'A data limite já passou';
  
        }
    } else {
        $errorsO['dataFim'] = 'O data não é válida';
    }
}


if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'tituloO') && filter_input($input, 'tituloO') != '') {
        $titulo = filter_input($input, 'tituloO');
    } else {
        $errorsO['tituloO'] = 'O título é inválido';
    }
}

//TipoOferta

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'infoO') && filter_input($input, 'infoO') != '') {
        $informacao = filter_input($input, 'infoO');
    } else {
        $errorsO['infoO'] = 'A informação é inválida';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'funcO') && filter_input($input, 'funcO') != '') {
        $funcao = filter_input($input, 'funcO');
    } else {
        $errorsO['funcO'] = 'A função é inválida';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'regi') && filter_input($input, 'regi') !== '') {
        $regiao = filter_input($input, 'regi');
    } else {
        $errorsO['regi'] = 'A região é inválida';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    $tempSal = str_replace(',', '.', filter_input($input, 'sal'));
    if (filter_has_var($input, 'sal') && filter_input($input, 'sal') != '' && filter_var($tempSal, FILTER_VALIDATE_FLOAT)) {
        $salario = $tempSal;
    } else {
        $errorsO['sal'] = 'Insira um salário numérico válido';
    }
}

if (filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST') {
    if (filter_has_var($input, 'req') && filter_input($input, 'req') != '') {
        $requisitos = filter_input($input, 'req');
    } else {
        $errorsO['req'] = 'Os requisitos são inválidos';
    }
}
