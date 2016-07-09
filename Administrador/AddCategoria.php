<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
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
        <link rel="stylesheet" type="text/css" href="../Application/styles/FormsCSS.css"/>
        <script src="../Application/JS/OfertaLS_JS.js"></script> 
        <title></title>
    </head>
    <body>
        <?php require_once '../Application/imports/Header.php' ?>
        <?php
        require_once __DIR__ . '/../Application/Validator/CategoriaValidator.php';
        ?>
        <section id="form">
            <form id="formOferta" action="AddCategoriaValida.php" method="post" enctype="multipart/form-data">
                <label for="nomeCat">Nome:</label><input id="tituloOferta" name="nomeCat" required><p class="error"><?= isset($errors) && array_key_exists('nomeCat', $errors) ? $errors['nomeCat'] : '' ?></p>
                <label for="fotografiaCat">Fotografia:</label><input id="fotografiaCat" type="file" name="fotografiaCat" required><?= isset($errors) && array_key_exists('fotografiaCat', $errors) ? $errors['fotografiaCat'] : '' ?>
                <input class="buttonForm" id="submeter" type="submit" value="submeter" name="submeter">

            </form>
        </section>
        <?php require_once '../Application/imports/Footer.php' ?>
    </body>
</html>
