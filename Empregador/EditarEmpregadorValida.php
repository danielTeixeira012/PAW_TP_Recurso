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
        <meta http-equiv="refresh" content="3; url='AreaEmpregador.php'"/>
        <title></title>
    </head>
    <body>
        <?php
        require_once __DIR__ . '/../Application/Validator/EmpregadorValidator.php';
        if (count($errorsE) > 0) {
            require_once './EditEmpregador.php';
        } else {
            $empregadorMan = new EmpregadorManager();
            $idEmpregador = $empregadorMan->verifyEmail(SessionManager::getSessionValue('email'))[0]['idEmpregador'];
            $email = filter_input(INPUT_POST, 'emailE');
            $fotoPath = filter_input(INPUT_POST, 'fotografiaE');
            $password = filter_input(INPUT_POST, 'passE');
            $nome = filter_input(INPUT_POST, 'nomeE');
            $contato = filter_input(INPUT_POST, 'contactoE');
            $morada = filter_input(INPUT_POST, 'moradaE');
            $codPostal = filter_input(INPUT_POST, 'codigopostalE');
            $distrito = filter_input(INPUT_POST, 'distritoE');
            $concelho = filter_input(INPUT_POST, 'concelhoE');
            $prestadorMan = new EmpregadorManager();
            $prestadorMan->updateEmpregador(new Empregador($idEmpregador, $email, $fotoPath, $password, $nome, $contato, $morada, $codPostal, $distrito, $concelho), $idEmpregador);
            ?>
            <p>Editado com sucesso, está a ser redirecionado para a sua página pessoal aguarde!!</p>


            <?php
        }
        ?>

    </body>
</html>
