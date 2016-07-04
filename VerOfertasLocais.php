<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'FavoritosManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
if ($session) {
    header('location: index.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Application/Styles/Listar.css">
        <title></title>
    </head>
    <body>
        <?php require_once './Application/Imports/Header.php'; ?>
        <?php
        if (!$session) {
            ?>
            <section id="ofertaLocais"/>
                <?php
            } else {
                
            }
            ?>
            <?php require_once './Application/Imports/Footer.php'; ?>
    </body>
</html>
