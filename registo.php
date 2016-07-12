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
        <title>Registo</title>
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
                <label for="emailE">Email</label><input id="emailE" type="email" name="emailE"><p class="error"><?= isset($errorsE) && array_key_exists('emailE', $errorsE) ? $errorsE['emailE'] : '' ?></p>
                <label for="fotografiaE">Fotografia</label><input id="fotografiaE" type="file" name="fotografiaE"><p class="error"><?= isset($imgErrorsE) && array_key_exists('img', $imgErrorsE) ? $imgErrorsE['img'] : '' ?></p>
                <label for="passE">Password</label><input id="passE" type="password" name="passE"><p class="error"><?= isset($errorsE) && array_key_exists('passE', $errorsE) ? $errorsE['passE'] : '' ?></p>
                <label for="nomeE">Nome</label><input id="nomeE" type="text" name="nomeE"><p class="error"><?= isset($errorsE) && array_key_exists('nomeE', $errorsE) ? $errorsE['nomeE'] : '' ?></p>
                <label for="contactoE">Contacto</label><input id="contactoE" type="text" name="contactoE"><p class="error"><?= isset($errorsE) && array_key_exists('contactoE', $errorsE) ? $errorsE['contactoE'] : '' ?></p>
                <label for="moradaE">Morada</label><input id="moradaE" type="text" name="moradaE"><p class="error"><?= isset($errorsE) && array_key_exists('moradaE', $errorsE) ? $errorsE['moradaE'] : '' ?></p>
                <label for="codigopostalE">Codigo-Postal</label><input id="codigopostalE" type="text" name="codigopostalE"><p class="error"><?= isset($errorsE) && array_key_exists('codigopostalE', $errorsE) ? $errorsE['codigopostalE'] : '' ?></p>
                <label for="distritoE">Distrito</label><input id="distritoE" type="text" name="distritoE"><p class="error"><?= isset($errorsE) && array_key_exists('distritoE', $errorsE) ? $errorsE['distritoE'] : '' ?></p>
                <label for="concelhoE">Concelho</label><input id="concelhoE" type="text" name="concelhoE"><p class="error"><?= isset($errorsE) && array_key_exists('concelhoE', $errorsE) ? $errorsE['concelhoE'] : '' ?></p>
                <input class="button2" name="confirmE" id="confirmE" type="submit" value="CONFIRM">
            </form>
            <form id="formPrestador" action="utilizadorPrestadorServico.php" method="post" enctype="multipart/form-data">
                <label for="emailP">Email</label><input id="emailP" type="email" name="emailP" required><p class="error"><?= isset($errors) && array_key_exists('emailP', $errors) ? $errors['emailP'] : '' ?></p>
                    <label for="passP">Password</label><input id="passP" type="password" name="passP" required><p class="error"><?= isset($errors) && array_key_exists('passP', $errors) ? $errors['passP'] : '' ?></p>
                    <label for="nomeP">Nome</label><input id="nomeP" type="text" name="nomeP" required><p class="error"><?= isset($errors) && array_key_exists('nomeP', $errors) ? $errors['nomeP'] : '' ?></p>
                    <label for="contactoP">Contacto</label><input id="contactoP" type="text" name="contactoP" required><p class="error"><?= isset($errors) && array_key_exists('contactoP', $errors) ? $errors['contactoP'] : '' ?></p>
                    <label for="fotografiaP">Fotografia</label><input id="fotografiaP" type="file" name="fotografiaP" required><p class="error"><?= isset($imgErrors) && array_key_exists('img', $imgErrors) ? $imgErrors['img'] : '' ?></p>
                <label for="moradaP">Morada</label><input id="moradaP" type="text" name="moradaP" required><?= isset($errors) && array_key_exists('moradaP', $errors) ? $errors['moradaP'] : '' ?></p>
                <label for="codigopostalP">Codigo-Postal</label><input id="codigopostalP" type="text" name="codigopostalP" required><p class="error"><?= isset($errors) && array_key_exists('codigopostalP', $errors) ? $errors['codigopostalP'] : '' ?></p>
                <label for="distritoP">Distrito</label><input id="distritoP" type="text" name="distritoP" required><?= isset($errors) && array_key_exists('distritoP', $errors) ? $errors['distritoP'] : '' ?></p>
                <label for="concelhoP">Concelho</label><input id="concelhoP" type="text" name="concelhoP" required><?= isset($errors) && array_key_exists('concelhoP', $errors) ? $errors['concelhoP'] : '' ?></p>
                <input  class="button2" id="confirmP" type="submit" value="CONFIRM" name="confirmP">
            </form>
        </section>
        <?php require_once './Application/Imports/Footer.php'; ?>
    </body>
</html>
