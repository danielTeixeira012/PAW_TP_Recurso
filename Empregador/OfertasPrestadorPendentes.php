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
        <title></title>
        <link  rel="stylesheet" type="text/css" href="../Application/styles/AreaPessoal.css">
    </head>
    <body>

        <?php require_once '../Application/imports/Header.php'; ?>

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
            <a id="editarButton" href="EditarEmpregador.php"><button class="button">Editar dados...</button></a>
        </section>


        <section id="opcoes">

            <?php
            $database = new OfertaManager();
            $empregadorMan = new EmpregadorManager();

            $userEmail = SessionManager::getSessionValue('email');
            $id = $empregadorMan->getIdByMail($userEmail)[0]['idEmpregador'];
            $ofertas = $database->getOfertasPendentesUser($id);

            if (!empty($ofertas)) {
                ?>

                <table>
                    <tr>
                        <th>Titulo</th>

                    </tr>
                    <?php
                    foreach ($ofertas as $key => $value) {
                        ?>
                        <tr id="<?= $value['idOferta'] ?>"> 
                            <td><p><?= $value['tituloOferta'] ?></p></td>
<!--                            <td><a href="../verOfertas.php?oferta=<?= $value['idOferta'] ?>"><img class="imageButton" src="../Application/Resources/icons/view.png" alt="Ver"></a></td>
                            <td><a href="EditarOferta.php?altOfer=<?= $value['idOferta'] ?>"><img class="imageButton" src="../Application/Resources/icons/edit.png" alt="Editar"></a></td>
                            -->
                            <td class="tdButtom"><a href="../verOfertas.php?oferta=<?= $value['idOferta'] ?>"><button class="tableButton">Ver Oferta</button></a></td>
                            <td class="tdButtom"><a href="EditarOferta.php?altOfer=<?= $value['idOferta'] ?>"><button class="tableButton">Editar Oferta</button></a></td>                         
                        </tr>

                        <?php
                    }
                    ?>
                </table>   
                <?php
            } else {
                ?>
                <p>Não existem ofertas Pendentes</p>
                <?php
            }
            ?>




        </section>
        <?php require_once '../Application/imports/Footer.php' ?>

    </body>
</html>

