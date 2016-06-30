<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    $tipoUtilizador = SessionManager::getSessionValue('tipoUser');
    if ($tipoUtilizador === 'prestador') {
        ?>
        <section id="loginSec">
            <p>Bem vindo <?= SessionManager::getSessionValue('email') ?>  <a id="logout" href="logOut.php"><button class="button">LogOut</button></a></p>
        </section>
        <?php
    } else if ($tipoUtilizador === 'empregador') {
        ?>
        <section id="loginSec">
            <p>Bem vindo <?= SessionManager::getSessionValue('email') ?>  <a id="logout" href="logOut.php"><button class="button">LogOut</button></a></p>
        </section>
        <?php
    } else if ($tipoUtilizador === 'administrador') {
        ?>
        <section id="loginSec">
            <p>Bem vindo <?= SessionManager::getSessionValue('email') ?>  <a id="logout" href="logOut.php"><button class="button">LogOut</button></a></p>
        </section>
        <?php
    }
} else {
    ?>
    <section id="loginSec">
        <form id="registo" action="verificaLogin.php" method="post">
            <input class="inputLog" id="email" type="email" name="email" placeholder="Email" required>
            <input class="inputLog" id="pass" type="password" placeholder="Password" name="pass" required>
            <?= isset($errors) && array_key_exists('login', $errors) ? $errors['login'] : '' ?>
            <input class="button" id="login" type="submit" value="Login">       
        </form>
        <a  id="registoButton" href="registo.php" ><button class="button">Registar</button></a>
    </section>
    <?php
}
?>