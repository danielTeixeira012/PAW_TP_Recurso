<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');
use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Registo</title>
    </head>
    <body>
        <?php
        require_once __DIR__ . '/Application/Validator/registoEmpregadorValidator.php';
        require_once __DIR__ . '/Application/Validator/UploadFotoEmpregador.php';
        if (count($errorsE) > 0 || count($imgErrorsE) > 0) {
            require_once __DIR__ . '/registo.php';
        } else {
            $email = filter_input(INPUT_POST, 'emailE',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $password = filter_input(INPUT_POST, 'passE',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $nome = filter_input(INPUT_POST, 'nomeE',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $contato = filter_input(INPUT_POST, 'contactoE',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $morada = filter_input(INPUT_POST, 'moradaE',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $codPostal = filter_input(INPUT_POST, 'codigopostalE',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $distrito = filter_input(INPUT_POST, 'distritoE',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $concelho = filter_input(INPUT_POST, 'concelhoE',FILTER_SANITIZE_STRING,FILTER_SANITIZE_SPECIAL_CHARS);
            $empregador = new Empregador('', $email, $target_fileE, sha1($password), $nome, $contato, $morada, $codPostal, $distrito, $concelho);
            $manager = new EmpregadorManager();
            $manager->insertPrestadorServico($empregador);
            ?>
            <h2>Empregador Adicionado</h2>
            <p>O Empregador foi adicionado, Obrigado!</p>
            <a href="index.php"><input type="submit" value="Pagina Inicial"></a> 
            <?php
        }
        ?>
    </body>
</html>
