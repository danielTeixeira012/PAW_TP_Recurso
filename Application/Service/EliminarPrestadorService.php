<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'FavoritosManager.php');
require_once (Conf::getApplicationManagerPath() . 'ComentariosManager.php');
$exist = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');

if ($exist && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') === 'administrador') {
        $id = filter_input(INPUT_GET, 'idPrestador', FILTER_SANITIZE_NUMBER_INT);
        $managerPrest = new PrestadorManager();
        $managerCand = new CandidaturaManager();
        $managerCand->deleteCandidaturaByIdPrestador($id);
        $manFavs = new FavoritosManager();
        $manFavs->removeFavoritosByIDPrestador($id);
        $manComts = new ComentariosManager();
        $manComts->removeComentariosByAutor($managerPrest->getPrestadorByid($id)[0]['email']);
        $managerPrest->deletePrestadorById($id);
        echo 'Eliminado';
    }else{
        echo 'Não pode eliminar prestadores';
    }
}

