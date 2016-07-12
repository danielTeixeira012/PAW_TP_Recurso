<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'empregador') {
        header('location: ../index.php');
    }
} else {
    if (!$session && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        require_once '../VerificaCookies.php';
    } else {
        header('location: ../index.php');
    }
}
$exists = false;
$manEmpregador = new EmpregadorManager();
$manOfertas = new OfertaManager();
$manCandidaturas = new CandidaturaManager();

$id = filter_input(INPUT_GET, 'prestador',FILTER_SANITIZE_NUMBER_INT);

$logado = $manEmpregador->getEmpregadorByMail(SessionManager::getSessionValue('email'));
$idEmpregador = $logado[0]['idEmpregador'];
$ofertasPrestador = $manOfertas->getOfertaUser($idEmpregador);

//verifica se pode ver historico prestador
foreach ($ofertasPrestador as $key => $value) {
    if (!empty($manCandidaturas->prestadorCandidatouseSubmetida($value['idOferta'], $id)) || !empty($manCandidaturas->prestadorCandidatouseAceitadas($value['idOferta'], $id)) || !empty($manCandidaturas->prestadorCandidatouseRejeitadas($value['idOferta'], $id))) {
        $exists = true;
    }
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link  rel="stylesheet" type="text/css" href="../Application/Styles/Listar.css">

        <title>Ver Historico Candidato</title>
    </head>
    <body>
        <?php require_once '../Application/imports/Header.php' ?>
        <?php
        if ($exists) {
            $canMan = new CandidaturaManager();
            $candidaturasSubmetidas = $canMan->getCandidaturasSubmetidasByIdPrestador($id);
            if (!empty($candidaturasSubmetidas)) {
                ?>
                <section id="candidaturasSubmetidas">
                    <h1>Candidaturas Submetidas</h1>
                    <table>
                        <tr>
                            <th>Oferta</th>
                        </tr>
                        <?php
                        foreach ($candidaturasSubmetidas as $key => $value) {
                            $oferta = $manOfertas->getOfertaByID($value['idOferta'])
                            ?>
                            <tr>       
                                <td><?= $oferta[0]['tituloOferta'] ?></td>
                                <td class="tdButtom"><a href="../verOfertas.php?oferta=<?= $value['idOferta'] ?>"><button class="tableButton">Ver Oferta</button></a></td>                 
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </section>
            <?php
            $candidaturasAceites = $canMan->getCandidaturasAceitesOfIdPrestador($id);
            if (!empty($candidaturasAceites)) {
                ?>
                <section id="candidaturasAceites">
                    <h1>Candidaturas Aceites</h1>
                    <table>
                        <tr>
                            <th>Oferta</th>
                        </tr>
                        <?php
                        foreach ($candidaturasAceites as $key => $value) {
                            $oferta = $manOfertas->getOfertaByID($value['idOferta'])
                            ?>
                            <tr>
                                <td><?= $oferta[0]['tituloOferta'] ?></td>
                                <td class="tdButtom"><a href="../verOfertas.php?oferta=<?= $value['idOferta'] ?>"><button class="tableButton">Ver Oferta</button></a></td>                 
                            </tr>
                            <?php
                        }
                    } else {
                        ?>
                        <p>Ainda não foi aceite para nenhum trabalho</p>
                        <?php
                    }
                    ?>
                </table>
            </section>
            <?php
            $candidaturasRejeitadas = $canMan->getCandidaturasRejeitasOfIdPrestador($id);
            if (!empty($candidaturasRejeitadas)) {
                ?>
                <section id="candidaturasRejeitadas">
                    <h1>Candidaturas Rejeitadas</h1>
                    <table>
                        <tr>
                            <th>Oferta</th>
                        </tr>
                        <?php
                        foreach ($candidaturasRejeitadas as $key => $value) {
                            $oferta = $manOfertas->getOfertaByID($value['idOferta'])
                            ?>
                            <tr>
                                <td><?= $oferta[0]['tituloOferta'] ?></td>
                                <td class="tdButtom"><a href="../verOfertas.php?oferta=<?= $value['idOferta'] ?>"><button class="tableButton">Ver Oferta</button></a></td>                 

                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </section>
            <?php
        } else {
            ?>
            <p>Não pode aceder ao historico desejado</p>
            <?php
        }
        ?>
        <?php require_once '../Application/imports/Footer.php' ?>
    </body>
</html>
