<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'FavoritosManager.php');
require_once (Conf::getApplicationManagerPath() . 'ComentariosManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$exist = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');


if ($exist && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') === 'administrador') {
        $id = filter_input(INPUT_GET, 'idOferta',FILTER_SANITIZE_NUMBER_INT);
        $manFav = new FavoritosManager();
        $manFav->removeFavoritosByIDOferta($id);
        $manComts = new ComentariosManager();
        $manComts->removeComentariosByIDOferta($id);
        $manCand = new CandidaturaManager();
        $manCand->deleteCandidaturaByIdOferta($id);
        $manOferta = new OfertaManager();
        $manOferta->deleteOfertasByIdOferta($id);
        echo 'Oferta eliminada';
    } else {
        echo 'Não pode eliminar ofertas';
    }
}