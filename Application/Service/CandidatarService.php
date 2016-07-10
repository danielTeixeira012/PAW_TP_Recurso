<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationModelPath() . 'Candidatura.php');
$exist = SessionManager::existSession('email');
if ($exist) {
    $emailLigado = SessionManager::getSessionValue('email');
    $id = filter_input(INPUT_GET, 'idOferta', FILTER_SANITIZE_NUMBER_INT);
    $ofertaMan = new OfertaManager();
    if (!empty($ofertaMan->getOfertaByID($id)) && !$ofertaMan->VerificaOfertaExpirou($id)) {
        $manPrest = new PrestadorManager();
        $prestador = $manPrest->verifyEmail($emailLigado);
        if (!empty($prestador)) {
            $manCand = new CandidaturaManager();
            if(empty($manCand->prestadorCandidatouseSubmetida($id, $prestador[0]['idPrestador'])) && empty($manCand->prestadorCandidatouseAceitadas($id, $prestador[0]['idPrestador'])) && empty($manCand->prestadorCandidatouseRejeitadas($id, $prestador[0]['idPrestador']))){
            $can = new Candidatura('', $prestador[0]['idPrestador'], $id, 'submetida');
            $manCand->insertCandidatura($can);
            echo 'Candidatura efetuada';  
            }else{
                echo 'Já se candidatou a essa oferta';  
            }
        } else {
            echo 'Não se pode candidatar á oferta';
        }
    } else {
        echo 'A oferta não é válida';
    }
}