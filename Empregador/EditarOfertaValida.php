<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
$empregador = SessionManager::existSession('email');
$idOferta = filter_input(INPUT_GET, 'altOfer');
$errors = array();
$input = INPUT_POST;
require_once __DIR__ . '/../Application/Validator/OfertaValidator.php';

if (count($errorsO) > 0) {
    $idOferta = filter_input(INPUT_POST, 'idOferta',FILTER_SANITIZE_NUMBER_INT);
    require_once __DIR__ . '/EditarOferta.php';
} else {
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="../Application/styles/FormsCSS.css"/>
            <title>Editar Oferta</title>
        </head>
        <body>
            <?php require_once __DIR__ . '/../Application/imports/Header.php'; ?>
            <?php
            $exist = false;
            $ofertasMan = new OfertaManager();
            $empregadorMan = new EmpregadorManager();
            $idEmpregador = $empregadorMan->verifyEmail(SessionManager::getSessionValue('email'))[0]['idEmpregador'];
            $idOfertaAlt = filter_input(INPUT_POST, 'idOferta');
            $ofertas = $ofertasMan->getOfertaByID($idOfertaAlt);
            if (!empty($ofertas)) {
                if ($ofertas[0]['idEmpregador'] === $idEmpregador) {
                    if (!$ofertasMan->VerificaOfertaExpirou($idOfertaAlt) || !$ofertasMan->VerificaOfertaPendente($idOfertaAlt)) {
                        $ofertasMan->editOferta(new ofertaTrabalho($idOfertaAlt, $categoria, $titulo, $tipo, $informacao, $funcao, $salario, $requisitos, $regiao, $idEmpregador, $status, $dataInicio, $dataFim), $idOfertaAlt);
                        ?>
                        <p class="message">Editado com sucesso</p>
                        <a href="AreaEmpregador.php"><button class="button">Voltar Área Pessoal</button></a>

                        <?php
                    } else {
                        ?>
                        <p class="message">A oferta já expirou</p>
                        <a href="AreaEmpregador.php"><button class="button">Voltar Área Pessoal</button></a>
                        <?php
                    }
                } else {
                    ?>
                    <p class="message">A oferta não foi editada</p>
                    <a href="AreaEmpregador.php"><button class="button">Voltar Área Pessoal</button></a>
                    <?php
                }
            }
            ?>

            <?php
        }
        ?>
        <?php require_once __DIR__ . '/../Application/imports/Footer.php'; ?>
    </body>
</html>
