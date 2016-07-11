<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'ComentariosManager.php');
require_once (Conf::getApplicationManagerPath() . 'FavoritosManager.php');
$exist = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');

if ($exist && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') === 'administrador') {
        $id = filter_input(INPUT_GET, 'idEmpregador', FILTER_SANITIZE_NUMBER_INT);
        $manEmp = new EmpregadorManager();
        $manOfer = new OfertaManager();
        $manCom = new ComentariosManager();
        $resOfer = $manOfer->getOfertaUser($id);
        if (!empty($resOfer)) {
            $manCand = new CandidaturaManager();
            $manFav = new FavoritosManager();
            foreach ($resOfer as $key => $value) {
                $manCand->deleteCandidaturaByIdOferta($value['idOferta']);
                $manCom->removeComentariosByIDOferta($value['idOferta']);
                $manFav->removeFavoritosByIDOferta($value['idOferta']);
            }
        }
        $manOfer->deleteOfertasByIdEmpregador($id);
        $manEmp->deleteEmpregadorById($id);
        echo 'Eliminado';
    }else{
        echo 'Não pode eliminar Empregadores';
    }
}