<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationModelPath() . 'Candidatura.php');
$exist = SessionManager::existSession('email');

if ($exist) {
    $emailLigado = SessionManager::getSessionValue('email');
    $id = filter_input(INPUT_GET, 'idOferta');
    $ManPrest = new PrestadorManager();
    $prestador = $ManPrest->verifyEmail($emailLigado);
    $can = new Candidatura('', $prestador[0]['idPrestador'], $id, 'submetida');
    $ManCand = new CandidaturaManager();
    $ManCand->insertCandidatura($can);
    echo 'Candidatura efetuada';
}