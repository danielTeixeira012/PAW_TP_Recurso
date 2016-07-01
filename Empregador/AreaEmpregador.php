<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'empregador') {
        header('location: ../index.php');
    }
} else {
    header('location: ../index.php');
}
$empregadorMan = new EmpregadorManager();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link  rel="stylesheet" type="text/css" href="../Application/Styles/AreaPessoal.css">
        <title></title>
    </head>
    <body>
        <?php require_once '../Application/imports/Header.php' ?>
        <section id="categorias">
            <?php
            $empreg = Empregador::convertArrayToObject($empregadorMan->verifyEmail(SessionManager::getSessionValue('email'))[0]);
            ?>
            <!--Adicionar Imagem -->
            <img id="fotoPerfil" src="../<?= $empreg->getFotoPath() ?>" alt="Erro">
            <p><b>Nome:</b> <?= $empreg->getNome() ?></p>
            <p><b>Email:</b> <?= $empreg->getEmail() ?></p>
            <p><b>Contato:</b> <?= $empreg->getContato() ?></p>
            <p><b>Morada:</b> <?= $empreg->getMorada() ?></p>
            <p><b>Código Postal:</b> <?= $empreg->getCodPostal() ?></p>
            <p><b>Concelho:</b><?= $empreg->getConcelho() ?></p>
            <p><b>Distrito:</b> <?= $empreg->getDistrito() ?></p>
            <a class="button2" id="editarButton" href="EditarEmpregador.php">Editar dados...</a>
        </section>


        <section id="opcoes">
            <a href="AddOferta.php">Adicionar Oferta</a>
            <a href="EditarEmpregador.php">Editar Empregador</a>
            <a href="EditarOferta.php">Editar Oferta</a>
            <a href="OfertasPrestadorPendentes.php">Oferta Pendentes</a>
            <a href="OfertasPrestadorPublicadas.php">Oferta Publicadas</a>
            <a href="OfertasPrestadorFinalizadas.php">Oferta Finalizadas</a>
            <a href="OfertasPrestadorExpiradas.php">Oferta Expiradas</a>
        </section>

        <?php require_once '../Application/imports/Footer.php' ?>

    </body>
</html>
