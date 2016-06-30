<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'empregador') {
        header('location: ../index.php');
    }
} else {
    header('location: ../Login.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        
        <title></title>
    </head>
    <body>
        <?php require_once '../Application/Imports/Header.php'; ?>
        <a href="AddOferta.php">Adicionar Oferta</a>
        <a href="EditarEmpregador.php">Editar Empregador</a>
        <a href="EditarOferta.php">Editar Oferta</a>
        <a href="OfertasPrestadorPendentes.php">Oferta Pendentes</a>
        <a href="OfertasPrestadorPublicadas.php">Oferta Publicadas</a>

           <?php require_once '../Application/Imports/Footer.php'; ?>
    </body>
</html>
