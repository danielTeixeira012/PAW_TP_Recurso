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
    if (!$session && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        require_once '../VerificaCookies.php';
    } else {
        header('location: ../index.php');
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Application/Styles/AdminCSS.css"/>
        <title>Area de Administrador</title>
    </head>
    <body>
        <?php require_once '../Application/Imports/Header.php'; ?>
         <section id="opcoes">
        <a href="ofertasAdmin.php">
            <article>          
                <img src="../Application/Resources/icons/Earth-Node-256GRAY.png">
                <p>Gerir Ofertas</p>
            </article>
        </a> 
        <a href="prestadoresServicosAdmin.php">
            <article>          
                <img src="../Application/Resources/icons/Employee-256GRAY.png">
                <p>Gerir Prestadores de Serviços</p>
            </article>
        </a> 
        <a href="empregadorAdmin.php">
            <article>          
                <img src="../Application/Resources/icons/Principal-01-256GRAY.png">
                <p>Gerir Empregadores</p>
            </article>
        </a>
        <a href="AddCategoria.php">
            <article>          
                <img src="../Application/Resources/icons/Add-256GRAY.png">
                <p>Adicionar Categoria</p>
            </article>
        </a>
         </section>
        <?php require_once '../Application/Imports/Footer.php'; ?>
    </body>
</html>
