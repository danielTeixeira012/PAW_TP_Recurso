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
if (!SessionManager::existSession('email') && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        require_once 'VerificaCookies.php';
}
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
        <script src="Application/Libs/jquery-2.2.4.js"></script>
        <script src="Application/JS/ListarOfertasLocais.js"></script>
        <?php
        if (!$session) {
            ?>
            <script src="Application/JS/GuardarOfertaLocalJS.js"></script>
            <?php
        }
        ?>
    </head>
    <body>
        <?php require_once './Application/Imports/Header.php'; ?>      
        <section id="ofertasLocais">
            <table id="tableOfertasLocais">
                <tr>
                    <th>Titulo</th>
                </tr>  
            </table>
        </section>
        <?php require_once './Application/Imports/Footer.php'; ?>
    </body>
</html>
