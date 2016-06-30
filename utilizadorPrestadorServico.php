<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registo</title>
    </head>
    <body>
        <?php
        require_once __DIR__ . '/Application/Validator/registoPrestadorServicoValidator.php';
        require_once __DIR__ . '/Application/Validator/UploadFotoPrestador.php';
        if (count($errors) > 0 || count($imgErrors) > 0) {
            require_once __DIR__ . '/registo.php';
        } else {
            $email = filter_input(INPUT_POST, 'emailP');
            $password = filter_input(INPUT_POST, 'passP');
            $nome = filter_input(INPUT_POST, 'nomeP');
            $contato = filter_input(INPUT_POST, 'contactoP');
            $morada = filter_input(INPUT_POST, 'moradaP');
            $codigoPostal = filter_input(INPUT_POST, 'codigopostalP');
            $distrito = filter_input(INPUT_POST, 'distritoP');
            $concelho = filter_input(INPUT_POST, 'concelhoP');
            $prestador = new PrestadorServico('', $email, sha1($password), $nome, $contato, $target_file, $morada, $codigoPostal, $distrito, $concelho);
            $prestadorManager = new PrestadorManager();
            $prestadorManager->insertPrestadorServico($prestador);
            ?>
            <h2>Prestadar Adicionado</h2>
            <p>O prestador foi adicionado, Obrigado!</p>
            <a href="index.php"><input type="submit" value="Pagina Inicial"></a> 
            <?php
        }
        ?>
    </body>
</html>
