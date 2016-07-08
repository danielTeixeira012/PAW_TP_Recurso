<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');
use Config as Conf;

require_once __DIR__ . '/Application/Validator/registoPrestadorServicoValidator.php';
require_once __DIR__ . '/Application/Validator/registoEmpregadorValidator.php';
require_once __DIR__ . '/Application/Validator/UploadFotoEmpregador.php';
require_once __DIR__ . '/Application/Validator/UploadFotoPrestador.php';
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
        <title></title>
        <script src="Application/JS/registoJS.js"></script>
        <link rel="stylesheet"  href="Application/Styles/registoCSS.css">
    </head>
    <body>
        <?php require_once './Application/Imports/Header.php'; ?>
        <section id="form">
            <section>
                <p id="tipoUtilizador">Escolha o tipo Utilizador:</p>
                <label id="empregador">Empregador</label><input id="tipoEmpregador" type="radio" value="empregador" name="tipoUtilizador">
                <label id="prestador">Prestador de serviços</label><input id="tipoPrestador" type="radio" value="prestador" name="tipoUtilizador">
            </section>  
            <form id="formEmpregador" action="utilizadorEmpregador.php" method="post" enctype="multipart/form-data">
                <label for="emailE">Email</label><input id="emailE" type="email" name="emailE"><?= isset($errorsE) && array_key_exists('emailE', $errorsE) ? $errorsE['emailE'] : '' ?>
                <label for="fotografiaE">Fotografia</label><input id="fotografiaE" type="file" name="fotografiaE"><?= isset($imgErrorsE) && array_key_exists('img', $imgErrorsE) ? $imgErrorsE['img'] : '' ?>
                <label for="passE">Password</label><input id="passE" type="password" name="passE"><?= isset($errorsE) && array_key_exists('passE', $errorsE) ? $errorsE['passE'] : '' ?>
                <label for="nomeE">Nome</label><input id="nomeE" type="text" name="nomeE"><?= isset($errorsE) && array_key_exists('nomeE', $errorsE) ? $errorsE['nomeE'] : '' ?>
                <label for="contactoE">Contacto</label><input id="contactoE" type="text" name="contactoE"><?= isset($errorsE) && array_key_exists('contactoE', $errorsE) ? $errorsE['contactoE'] : '' ?>
                <label for="moradaE">Morada</label><input id="moradaE" type="text" name="moradaE">
                <label for="codigopostalE">Codigo-Postal</label><input id="codigopostalE" type="text" name="codigopostalE"><?= isset($errorsE) && array_key_exists('codigopostalE', $errorsE) ? $errorsE['codigopostalE'] : '' ?>
                <label for="distritoE">Distrito</label><input id="distritoE" type="text" name="distritoE">
                <label for="concelhoE">Concelho</label><input id="concelhoE" type="text" name="concelhoE">
                <input class="button2" name="confirmE" id="confirmE" type="submit" value="CONFIRM">
            </form>
            <form id="formPrestador" action="utilizadorPrestadorServico.php" method="post" enctype="multipart/form-data">
                <label for="emailP">Email</label><input id="emailP" type="email" name="emailP" required><?= isset($errors) && array_key_exists('emailP', $errors) ? $errors['emailP'] : '' ?>
                <label for="passP">Password</label><input id="passP" type="password" name="passP" required><?= isset($errors) && array_key_exists('passP', $errors) ? $errors['passP'] : '' ?>
                <label for="nomeP">Nome</label><input id="nomeP" type="text" name="nomeP" required><?= isset($errors) && array_key_exists('nomeP', $errors) ? $errors['nomeP'] : '' ?>
                <label for="contactoP">Contacto</label><input id="contactoP" type="text" name="contactoP" required><?= isset($errors) && array_key_exists('contactoP', $errors) ? $errors['contactoP'] : '' ?>
                <label for="fotografiaP">Fotografia</label><input id="fotografiaP" type="file" name="fotografiaP" required><?= isset($imgErrors) && array_key_exists('img', $imgErrors) ? $imgErrors['img'] : '' ?>
                <label for="moradaP">Morada</label><input id="moradaP" type="text" name="moradaP" required>
                <label for="codigopostalP">Codigo-Postal</label><input id="codigopostalP" type="text" name="codigopostalP" required><?= isset($errors) && array_key_exists('codigopostalP', $errors) ? $errors['codigopostalP'] : '' ?>
                <label for="distritoP">Distrito</label><input id="distritoP" type="text" name="distritoP" required>
                <label for="concelhoP">Concelho</label><input id="concelhoP" type="text" name="concelhoP" required>
                <input  class="button2" id="confirmP" type="submit" value="CONFIRM" name="confirmP">
            </form>
        </section>
        <?php require_once './Application/Imports/Footer.php'; ?>
    </body>
</html>
