<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationModelPath() . 'OfertaTrabalho.php');
$exist = SessionManager::existSession('email');

if ($exist) {
    $id = filter_input(INPUT_GET, 'idOferta');
    $ofertasMan = new OfertaManager();
    $oferta = $ofertasMan->getOfertaByID($id);
    $data = date("Y-m-d");

    if ($oferta[0]['dataLimite'] <= $data) {
        echo 'A data de finalização indicada já foi ultrapassada altere-a e volte a tentar';
    } else {
        $of = OfertaTrabalho::convertArrayToObject($oferta[0]);
        $of->setStatusO('publicada');
        $ofertasMan->editOferta($of, $id);
        echo 'Oferta Publicada';
    }
}