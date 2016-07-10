<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationModelPath() . 'OfertaTrabalho.php');
$exist = SessionManager::existSession('email');

$idOferta = filter_input(INPUT_GET, 'idOferta', FILTER_SANITIZE_NUMBER_INT);
$ofertasMan =new OfertaManager();
$oferta =  $ofertasMan->getOfertaByID($idOferta);

echo json_encode($oferta);
