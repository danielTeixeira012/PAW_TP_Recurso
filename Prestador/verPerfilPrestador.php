<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'prestador') {
        header('location: ../index.php');
    }
} else {
    header('location: ../index.php');
}
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Application/styles/FormsCSS.css"/>
        <title>Ver Perfil</title>
    </head>
    <body>
        <?php require_once __DIR__ . '/../Application/imports/Header.php'; ?>
        <?php
        if ($session) {
            $mail = SessionManager::getSessionValue('email');
            $manager = new PrestadorManager();
            $user = $manager->verifyEmail($mail);
            ?>
            <section id="form">
                <a  href="areaPessoalPrestador.php"><button class="button2">Voltar</button></a>
                <form id="formOferta" action="editarPerfil.php" method="post">
                    <h2>Perfil do Prestador Serviço <?= SessionManager::getSessionValue('email') ?></h2>
                    <img src="../<?= $user[0]['fotoPath'] ?>" alt="Erro"/>

                    <label for="emailPrestador">Email</label><input readonly id="emailPrestador" type="email" name="emailPrestador" value="<?= $user[0]['email'] ?>">
                    <label for="passPrestador">Password</label><input id="passPrestador" type="password" name="passPrestador" value="<?= $user[0]['password'] ?>"> <p class="error"><?= isset($erros) && array_key_exists('passPrestador', $erros) ? $erros['passPrestador'] : '' ?></p>
                    <label for="nomePrestador">Nome</label><input id="nomePrestador" type="text" name="nomePrestador" value="<?= $user[0]['nome'] ?>"> <p class="error"><?= isset($erros) && array_key_exists('nomePrestador', $erros) ? $erros['nomePrestador'] : '' ?></p>
                    <label for="contactoPrestador">Contacto</label><input id="contactoPrestador" type="tel" name="contactoPrestador" value="<?= $user[0]['contato'] ?>"> <p class="error"><?= isset($erros) && array_key_exists('contactoPrestador', $erros) ? $erros['contactoPrestador'] : '' ?></p>
                    <label for="moradaPrestador">Morada</label><input id="moradaPrestador" type="text" name="moradaPrestador" value="<?= $user[0]['morada'] ?>"> <p class="error"><?= isset($erros) && array_key_exists('moradaPrestador', $erros) ? $erros['moradaPrestador'] : '' ?></p>
                    <label for="codigopostalPrestador">Codigo-Postal</label><input id="codigopostalPrestador" type="text" name="codigopostalPrestador" value="<?= $user[0]['codPostal'] ?>"> <p class="error"><?= isset($erros) && array_key_exists('codigopostalPrestador', $erros) ? $erros['codigopostalPrestador'] : '' ?></p>
                    <label for="distritoPrestador">Distrito</label><input id="distritoPrestador" type="text" name="distritoPrestador" value="<?= $user[0]['distrito'] ?>"> <p class="error"><?= isset($erros) && array_key_exists('distritoPrestador', $erros) ? $erros['distritoPrestador'] : '' ?></p>
                    <label for="concelhoPrestador">Concelho</label><input id="concelhoPrestador" type="text" name="concelhoPrestador" value="<?= $user[0]['concelho'] ?>"> <p class="error"><?= isset($erros) && array_key_exists('concelhoPrestador', $erros) ? $erros['concelhoPrestador'] : '' ?></p>

                    <input type="submit" value="Guardar novos dados">
                </form>         

            </section>
            <?php
        }
        ?>

        <?php require_once __DIR__ . '/../Application/imports/Footer.php'; ?>
    </body>
</html>
