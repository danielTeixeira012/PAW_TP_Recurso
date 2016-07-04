<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
$idOferta = filter_input(INPUT_GET, 'oferta');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'empregador') {
        header('location: ../index.php');
    }
} else {
    header('location: ../index.php');
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
            
            $candidaturas = $candidaturasMan->getCandidaturasSubmetidasByIdOferta($idOferta);
            if (!empty($candidaturas)) {
                ?>
                <table>
                    <tr>
                        <th>Candidatura</th>
                        <th>Prestador</th> 
                        <th>Oferta</th>

                    </tr>
                    <?php
                    foreach ($candidaturas as $key => $value) {
                        ?>
                        <tr data-idCandidatura="<?= $value['idCandidatura'] ?>" data-idOferta="<?= $value['idOferta'] ?>">
                            <td><?= $value['idCandidatura'] ?></td>
                            <td><?= $value['idPrestador'] ?></td>
                            <td><?= $value['idOferta'] ?></td>
                            <td><a href="VerHistoricoCandidato.php?prestador=<?= $value['idPrestador'] ?>"><img class="imageButton" src="../Application/Resources/icons/viewPrest.png" alt="Ver Prestador"></a></td>
                            <td><a class="aceitarButton" id="aceitarButton"><button class="button">Aceitar</button></a></td>
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
                ?>

           


        </section>

        <?php require_once '../Application/imports/Footer.php' ?>

    </body>
</html>
