<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$exist = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');

if ($exist && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') === 'administrador') {
        $id = filter_input(INPUT_GET, 'idOferta');
        $manOferta = new OfertaManager();
        $res = $manOferta->getOfertaByID($id);
        $data = date("Y-m-d");
        if ($data > $res[0]['dataLimite']) {
            echo 'Oferta não ativa, data limite expirada';
        } else {
            $updateCand = new OfertaTrabalho($res[0]['idOferta'], $res[0]['idCategoria'], $res[0]['tituloOferta'], $res[0]['tipoOferta'], $res[0]['informacaoOferta'], $res[0]['funcaoOferta'], $res[0]['salario'], $res[0]['requisitos'], $res[0]['regiao'], $res[0]['idEmpregador'], 'publicada', $res[0]['dataLimite']);
            $manOferta->editOferta($updateCand, $id);
            echo 'Oferta ativada';
        }
    } else {
        echo '';
    }
}
