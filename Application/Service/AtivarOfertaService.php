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
        $id = filter_input(INPUT_GET, 'idOferta', FILTER_SANITIZE_NUMBER_INT);
        $manOferta = new OfertaManager();
        $res = $manOferta->getOfertaByID($id);
        $data = $manOferta->getDataAtual();
        if (!empty($res)) {
            if ($data > $res[0]['dataFim']) {
                echo 'Oferta não ativa, data limite expirada';
            } else {
                $updateCand = new OfertaTrabalho($res[0]['idOferta'], $res[0]['idCategoria'], $res[0]['tituloOferta'], $res[0]['tipoOferta'], $res[0]['informacaoOferta'], $res[0]['funcaoOferta'], $res[0]['salario'], $res[0]['requisitos'], $res[0]['regiao'], $res[0]['idEmpregador'], 'ativada', $res[0]['dataInicio'], $res[0]['dataFim']);
                $manOferta->editOferta($updateCand, $id);
                echo 'Oferta ativada';
            }
        } else {
            echo 'A oferta não existe';
        }
    } else {
        echo 'Não pode ativar a oferta';
    }
}
