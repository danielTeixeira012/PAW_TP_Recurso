<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'administrador') {
        header('location: ../index.php');
    }
} else {
    header('location: ../index.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="/PAW_TP/Application/Styles/FormsCSS.css"/>
        <title></title>
    </head>
    <body>
        <a  href="ofertasAdmin.php"><button class="button2">Ofertas</button></a>
        <a href="prestadoresServicosAdmin.php"><button class="button2" >Prestadores de Serviços</button></a>
        <a  href="empregadorAdmin.php"><button class="button2">Empregadores</button></a>
    </body>
</html>
