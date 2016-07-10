<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationModelPath() . 'OfertaTrabalho.php');
require_once (Conf::getApplicationModelPath() . 'Candidatura.php');
$exist = SessionManager::existSession('email');


if ($exist) {
    $idCandidatura = filter_input(INPUT_GET, 'idCandidatura', FILTER_SANITIZE_NUMBER_INT);
    $idOferta = filter_input(INPUT_GET, 'idOferta', FILTER_SANITIZE_NUMBER_INT);
    $candidaturasMan = new CandidaturaManager();
    $ofertaMan = new OfertaManager();
    $oferta = $ofertaMan->getOfertaByID($idOferta);
    if (!empty($oferta)) {
        $empregadorMan = new EmpregadorManager();
        $empregador = $empregadorMan->getEmpregadorByID($oferta[0]['idEmpregador']);
        if ($empregador[0]['email'] === SessionManager::getSessionValue('email')) {
            if (!empty($candidaturasMan->getCandidaturasSubmetidasByIdOfertaAndIdCandidatura($idOferta, $idCandidatura))) {
                if ($oferta[0]['dataFim'] < $ofertaMan->getDataAtual()) {
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
                } else {
                    echo 'A candidatura ainda não expirou';
                }
            } else {
                echo 'Não é possível definir o candidato escolhido';
            }
        } else {
            echo 'Não é possível definir candidatos';
        }
    } else {
        echo 'Não é possível definir candidatos';
    }
}