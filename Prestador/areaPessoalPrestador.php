<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'prestador') {
        header('location: ../index.php');
    }
} else {
    if (!$session && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        require_once '../VerificaCookies.php';
    }
}
$prestadorMan = new PrestadorManager();
?>

<html>
    <head>
        <meta charset="UTF-8">
        <link  rel="stylesheet" type="text/css" href="../Application/Styles/AreaPessoal.css">
        <title>Area Pessoal</title>
    </head>
    <body>      
        <?php require_once __DIR__ . '/../Application/imports/Header.php'; ?>

        <section id="categorias">
            <?php
            $prest = PrestadorServico::convertArrayToObject($prestadorMan->verifyEmail(SessionManager::getSessionValue('email'))[0]);
            ?>
            <!--Adicionar Imagem -->
            <img id="fotoPerfil" src="../<?= $prest->getFotoPath() ?>" >
            <p><b>Nome:</b> <?= $prest->getNome() ?></p>
            <p><b>Email:</b> <?= $prest->getEmail() ?></p>
            <p><b>Contato:</b> <?= $prest->getContato() ?></p>
            <p><b>Morada:</b> <?= $prest->getMorada() ?></p>
            <p><b>Código Postal:</b> <?= $prest->getCodPostal() ?></p>
            <p><b>Distrito:</b> <?= $prest->getDistrito() ?></p>
            <p><b>Concelho:</b> <?= $prest->getConcelho() ?></p>
            <a id="editarButton" href="verPerfilPrestador.php"><button class="button">Editar dados...</button></a>
        </section>
        <section id="opcoes">
            <a href="ofertasTrabalhoFavoritas.php">
                <article>
                    <img src="../Application/Resources/icons/Earth-Node-256GRAY.png">
                    <p>Ofertas Favoritas</p>
                </article></a>
            <a href="ofertasTrabalhoSubmetidas.php"><article>
                    <img src="../Application/Resources/icons/User-Earth-256GRY.png">
                    <p>Ofertas Submetidas</p>
                </article></a>
            <a href="ofertasTrabalhoFinalizadas.php"><article>
                    <img src="../Application/Resources/icons/Lock-Earth-256GRAY.png">
                    <p>Ofertas Aceitado</p>
                </article></a>
        </section>
        <?php require_once '../Application/imports/Footer.php' ?>
    </body>
</html>
