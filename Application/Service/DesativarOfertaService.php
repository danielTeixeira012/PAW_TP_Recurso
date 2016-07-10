<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'FavoritosManager.php');

$exist = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');

if ($exist && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') === 'administrador') {
        $id = filter_input(INPUT_GET, 'idOferta', FILTER_SANITIZE_NUMBER_INT);
        $manOferta = new OfertaManager();
        $res = $manOferta->getOfertaByID($id);
        if (!empty($res)) {
            $manCand = new CandidaturaManager();
            $manCand->deleteCandidaturaByIdOferta($id);
            $manFav = new FavoritosManager();
            $manFav->removeFavoritosByIDOferta($id);
            //ver se é necesario apagar comentarios
            $updateCand = new OfertaTrabalho($res[0]['idOferta'], $res[0]['idCategoria'], $res[0]['tituloOferta'], $res[0]['tipoOferta'], $res[0]['informacaoOferta'], $res[0]['funcaoOferta'], $res[0]['salario'], $res[0]['requisitos'], $res[0]['regiao'], $res[0]['idEmpregador'], 'desativada', $res[0]['dataInicio'], $res[0]['dataFim']);
            $manOferta->editOferta($updateCand, $id);
            echo 'Oferta desativada';
        } else {
            echo 'A oferta não existe';
        }
    } else {
        echo 'Não pode desativar ofertas';
    }
}