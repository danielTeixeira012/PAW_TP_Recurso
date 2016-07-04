<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationModelPath() . 'OfertaTrabalho.php');
require_once (Conf::getApplicationModelPath() . 'Candidatura.php');
$exist = SessionManager::existSession('email');


if ($exist) {
    $idCandidatura = filter_input(INPUT_GET, 'idCandidatura');
    $idOferta = filter_input(INPUT_GET, 'idOferta');
    $candidaturasMan = new CandidaturaManager();
    $candidaturas = $candidaturasMan->getCandidaturasSubmetidasByIdOferta($idOferta);
    foreach ($candidaturas as $key => $value) {
        $cand = Candidatura::convertArrayToObject($value);
        if ($cand->getIdCandidatura() == $idCandidatura) {
            $cand->setStatusCandidatura('aceitada');
            $candidaturasMan->editCandidatura($cand, $idCandidatura);
            //update de submetida para aceite
        } else {
            //update de submetida para rejeitada
            $cand->setStatusCandidatura('rejeitada');
            $candidaturasMan->editCandidatura($cand, $idCandidatura);
        }
    }
    echo 'Candidaturas Avaliadas';
}