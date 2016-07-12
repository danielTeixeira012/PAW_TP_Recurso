<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="Application/Styles/Index.css">
        <title>Registo</title>
    </head>
    <body>
        <?php
        require_once __DIR__ . '/Application/Validator/registoPrestadorServicoValidator.php';
        require_once __DIR__ . '/Application/Validator/UploadFotoPrestador.php';
        if (count($errors) > 0 || count($imgErrors) > 0) {
            require_once __DIR__ . '/registo.php';
        } else {
            require_once 'Application/Imports/Header.php';
            $email = filter_input(INPUT_POST, 'emailP',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'passP',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_input(INPUT_POST, 'nomeP',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $contato = filter_input(INPUT_POST, 'contactoP',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $morada = filter_input(INPUT_POST, 'moradaP',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $codigoPostal = filter_input(INPUT_POST, 'codigopostalP',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $distrito = filter_input(INPUT_POST, 'distritoP',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $concelho = filter_input(INPUT_POST, 'concelhoP',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $prestador = new PrestadorServico('', $email, sha1($password), $nome, $contato, $target_file, $morada, $codigoPostal, $distrito, $concelho);
            $prestadorManager = new PrestadorManager();
            $prestadorManager->insertPrestadorServico($prestador);
            ?>
            <h2>Prestadar Adicionado</h2>
            <p>O prestador foi adicionado, Obrigado!</p>
            <?php
            require_once 'Application/Imports/Header.php';
        }
        ?>
    </body>
</html>
