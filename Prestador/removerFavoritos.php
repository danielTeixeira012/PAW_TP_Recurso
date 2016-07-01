<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationModelPath() . 'Candidatura.php');

$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if($session && $tipo){
    if(SessionManager::getSessionValue('tipoUser') !== 'prestador'){
        header('location: ../index.php');
    }
}else{
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="refresh" content="3; url='../index.php'"/>
        <title></title>
    </head>
    <body>
        <?php
            $remove = false;
            $id = filter_input(INPUT_GET, 'oferta');
            $ManagerPrestador = new PrestadorManager();
            $resPrest = $ManagerPrestador->verifyEmail(SessionManager::getSessionValue('email'));
            $ManagerCandidatura = new CandidaturaManager();
            $res = $ManagerCandidatura->getCandidaturas();
            foreach ($res as $key => $value) {
                if($res[$key]['idPrestador'] === $resPrest[0]['idPrestador'] && $res[$key]['idOferta'] === $id){
                    $ManagerCandidatura->deleteCandidatura($res[$key]['idCandidatura']);
                    $remove = true;
                }
            }
            if($remove){
                ?>
                <h2>Oferta removida dos favoritos, está a ser redirecionado para a sua página pessoal aguarde!!</h2>
                <?php
            }
            else{
                ?>
                <h2>A oferta não existe nas suas ofertas favoritas, está a ser redirecionado para a sua página pessoal aguarde!!</h2>
                <?php
            }
            ?>
    </body>
</html>
