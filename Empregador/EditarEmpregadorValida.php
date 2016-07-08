<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$empregador = SessionManager::existSession('email');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Application/styles/FormsCSS.css"/>
        <title></title>
    </head>
    <body>
        <?php require_once '../Application/imports/Header.php'?>
        <?php
        require_once __DIR__ . '/../Application/Validator/EditarEmpregadorValidator.php';
        if (count($errorsE) > 0) {
            require_once './EditarEmpregador.php';
        } else {
            $empregadorMan = new EmpregadorManager();
            $emailSession = SessionManager::getSessionValue('email');
            $empegadorSession = $empregadorMan->verifyEmail($emailSession);
            if (!empty($empegadorSession)){
                $idEmpregador = $empegadorSession[0]['idEmpregador'];
                $email = $empegadorSession[0]['email'];
                $fotoPath = $empegadorSession[0]['fotoPath'];
                $password = $empegadorSession[0]['password']; 
                $empregadorMan = new EmpregadorManager();
                $empregadorMan->updateEmpregador(new Empregador($idEmpregador, $email, $fotoPath, $password, $nome, $contato, $morada, $codPostal, $distrito, $concelho), $idEmpregador);
                ?>
                <p>Editado com sucesso</p>
                <a href="AreaEmpregador.php"><button class="button">Voltar Area Pessoal</button></a>
                    <?php
            } else {
                ?>
                <p>Não foi editado</p>
                <a href="EditarEmpregador.php"><button class="button">Voltar ao Editar...</button></a>
                    <?php
            }
        }
        ?>
                  <?php require_once '../Application/imports/Footer.php'?> 
    </body>
</html>
