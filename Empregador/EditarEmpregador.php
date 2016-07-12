<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;
require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'empregador') {
        header('location: ../index.php');
    }
} else {
    if (!$session && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        require_once '../VerificaCookies.php';
    }else{
       header('location: ../index.php'); 
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Application/styles/FormsCSS.css"/>
        <title>Editar Empregador</title>
    </head>
    <body>
        <?php require_once '../Application/imports/Header.php'?>
        <?php
            require_once __DIR__ . '/../Application/Validator/EditarEmpregadorValidator.php';
            $empregadorMan = new EmpregadorManager();
            $empregador = $empregadorMan->verifyEmail(SessionManager::getSessionValue('email'))[0];
             ?>
        <section id="form">
            <h2>Perfil Empregador <?= SessionManager::getSessionValue('email') ?></h2>
            <form id="formOferta" action="EditarEmpregadorValida.php" method="post">
                <img src="../<?= $empregador['fotoPath']?>"> 
                <label for="emailE">Email</label><input readonly id="emailE" type="email" name="emailE" value="<?= $empregador['email'] ?>"><p class="error"><?= isset($errorsE) && array_key_exists('emailE', $errorsE) ? $errorsE['emailE'] : '' ?></p>
                <label for="nomeE">Nome</label><input id="nomeE" type="text" name="nomeE" value="<?= $empregador['nome'] ?>"><p class="error"><?= isset($errorsE) && array_key_exists('nomeE', $errorsE) ? $errorsE['nomeE'] : '' ?></p>
                <label for="contactoE">Contacto</label><input id="contactoE" type="tel" name="contactoE" value="<?= $empregador['contato'] ?>"><p class="error"><?= isset($errorsE) && array_key_exists('contactoE', $errorsE) ? $errorsE['contactoE'] : '' ?></p>
                <label for="moradaE">Morada</label><input id="moradaE" type="text" name="moradaE" value="<?= $empregador['morada'] ?>"><p class="error"><?= isset($errorsE) && array_key_exists('moradaE', $errorsE) ? $errorsE['moradaE'] : '' ?></p>
                <label for="codigopostalE">Codigo-Postal</label><input id="codigopostalE" type="text" name="codigopostalE" value="<?= $empregador['codPostal'] ?>"><p class="error"><?= isset($errorsE) && array_key_exists('codigopostalE', $errorsE) ? $errorsE['codigopostalE'] : '' ?></p>
                <label for="distritoE">Distrito</label><input id="distritoE" type="text" name="distritoE" value="<?= $empregador['distrito'] ?>"><p class="error"><?= isset($errorsE) && array_key_exists('distritoE', $errorsE) ? $errorsE['distritoE'] : '' ?></p>
                <label for="concelhoE">Concelho</label><input id="concelhoE" type="text" name="concelhoE" value="<?= $empregador['concelho'] ?>"><p class="error"><?= isset($errorsE) && array_key_exists('concelhoE', $errorsE) ? $errorsE['concelhoE'] : '' ?></p>
                <input class="buttonForm" id="confirmE" type="submit" value="Editar Empregador">
            </form>
            
        </section>
        
       <?php require_once '../Application/imports/Footer.php'?> 
        
    </body>
</html>
