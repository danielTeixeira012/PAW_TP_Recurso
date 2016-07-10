<?php
require_once (realpath(dirname(__FILE__)) . '/Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
$email = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($email && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'prestador') {
        header('location: ../index.php');
    }
} else {
    if (!$email && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        require_once '../VerificaCookies.php';
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link  rel="stylesheet" type="text/css" href="Application/Styles/Listar.css">
        <link  rel="stylesheet" type="text/css" href="Application/Styles/verCSS.css">
        <title>Ver Candidatura</title>
    </head>
    <body>
        <?php
        require_once 'Application/imports/Header.php'; 
        $idOferta = filter_input(INPUT_GET, 'oferta',FILTER_SANITIZE_NUMBER_INT);

        $manCand = new CandidaturaManager();
        $manPrest = new PrestadorManager();
        $prest = $manPrest->verifyEmail(SessionManager::getSessionValue('email'));
        $return = $manCand->prestadorCandidatouseSubmetida($idOferta, $prest[0]['idPrestador']);

        if (!empty($return)) {
            $man = new OfertaManager();
            $manEmpregador = new EmpregadorManager();
            $manCate = new CategoriasManager();
            $res = $man->getOfertaByID($idOferta);
            $pre = $manEmpregador->getEmpregadorByID($res[0]['idEmpregador']);
            $categoria = $manCate->getCategoriaByID($res[0]['idCategoria']);
            ?>
            <section id="oferta">

                <h2>Titulo Oferta: <?= $res[0]['tituloOferta'] ?></h2>
                <p>Informação Oferta: <?= $res[0]['informacaoOferta'] ?></p>
                <p>Função Oferta: <?= $res[0]['funcaoOferta'] ?></p>
                <p>Categoria: <?= $categoria[0]['nomeCategoria']?></p>
                <p>Salario: <?= $res[0]['salario'] ?></p>
                <p>Requisitos: <?= $res[0]['requisitos'] ?></p>
                <p>Regiao: <?= $res[0]['regiao'] ?></p>
                <p>Tipo Oferta: <?= $res[0]['tipoOferta'] ?></p>
                <p>Empregador: <?= $pre[0]['email'] ?></p>

                <?php
            } else {
                ?>
                <h2>Não se candidatou a esta oferta de trabalho!</h2>
                <?php
            }
            ?>

        </section>
        <?php require_once 'Application/imports/Footer.php'; ?>
    </body>
</html>
