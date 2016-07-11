<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
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
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link  rel="stylesheet" type="text/css" href="../Application/styles/AreaPessoal.css">
        <script src="../Application/Libs/jquery-2.2.4.js"></script>
        <script src="../Application/JS/AceitarCandidaturaJS.js"></script>
    </head>
    <body>

        <?php require_once '../Application/imports/Header.php'; ?>

        <section id="categorias">
            <?php
            $empregadorMan = new EmpregadorManager();
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
            <a id="editarButton" href="EditEmpregador.php"><button class="button">Editar dados...</button></a>
        </section>

        <section id="opcoes">           
            <?php
            $candidaturasMan = new CandidaturaManager();
            $ofertaMan = new OfertaManager();
            $EmpregadorMan = new EmpregadorManager();
            $idOferta = filter_input(INPUT_GET, 'oferta',FILTER_SANITIZE_NUMBER_INT);


            $oferta = $ofertaMan->getOfertaByID($idOferta);
            if (!empty($oferta)) {
                $empregador = $EmpregadorMan->getEmpregadorByID($oferta[0]['idEmpregador']);
                $ofertaExpirou = $ofertaMan->VerificaOfertaExpirou($idOferta);
                if ($empregador[0]['email'] === SessionManager::getSessionValue('email')) {
                    $candidaturas = $candidaturasMan->getCandidaturasSubmetidasByIdOferta($idOferta);
                    if (!empty($candidaturas) && $ofertaExpirou) {
                        $manP = new PrestadorManager();
                        $manO = new OfertaManager();
                        ?>
                        <table>
                            <tr>
                                <th>Prestador</th> 
                                <th>Oferta</th>

                            </tr>
                            <?php
                            foreach ($candidaturas as $key => $value) {
                                
                                ?>
                                <tr data-idCandidatura="<?= $value['idCandidatura'] ?>" data-idOferta="<?= $value['idOferta'] ?>">
                                    <td><?= $manP->getPrestadorByid($value['idPrestador'])[0]['email']?></td>
                                    <td><?= $manO->getOfertaByID($value['idOferta'])[0]['tituloOferta'] ?></td>                          
                                    <td class="tdButtom"><a  href="VerHistoricoCandidato.php?prestador=<?= $value['idPrestador'] ?>"><button class="tableButton">Ver Prestador</button></a></td>
                                    <td class="tdButtom" data-idCandidatura="<?= $value['idCandidatura'] ?>" data-idOferta="<?= $value['idOferta'] ?>" class="tdButtom"><button class="aceitarButton">Aceitar</button></td>
                                </tr>

                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    } else {
                        ?>
                        <p>Não existem candidaturas que necessitem de defenição de candidato de imediato</p>
                        <?php
                    }
                } else {
                    ?>
                    <p>A oferta que escolheu não é válida</p>
                    <?php
                }
            } else {
                ?>
                <p>A oferta que escolheu não é válida</p>
                <?php
            }
            ?>




        </section>

        <?php require_once '../Application/imports/Footer.php' ?>

    </body>
</html>
