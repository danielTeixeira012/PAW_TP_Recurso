<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'ComentariosManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$exist = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');

if ($exist && $tipo) {
    $idOferta = filter_input(INPUT_GET, 'idOferta', FILTER_SANITIZE_NUMBER_INT);
    $comentario = filter_input(INPUT_GET, 'comentario', FILTER_SANITIZE_STRING, FILTER_SANITIZE_SPECIAL_CHARS);
    $mailUser = SessionManager::getSessionValue('email');
    if (SessionManager::getSessionValue('tipoUser') === 'prestador') {
        $managerPrestador = new PrestadorManager();
        $return = $managerPrestador->verifyEmail($mailUser);
        $comment = new Comentario('', $idOferta, $comentario, $return[0]['email']);
        $managerComentario = new ComentariosManager();
        $managerComentario->insertComentario($comment);
    } else {
        if (SessionManager::getSessionValue('tipoUser') === 'empregador') {
            $managerEmpregador = new EmpregadorManager();
            $return = $managerEmpregador->verifyEmail($mailUser);
            $comment = new Comentario('', $idOferta, $comentario, $return[0]['email']);
            $managerComentario = new ComentariosManager();
            $managerComentario->insertComentario($comment);
        }
    }
    echo json_encode($managerComentario->getUltimoComentario());
}