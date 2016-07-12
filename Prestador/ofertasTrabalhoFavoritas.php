<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'FavoritosManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'prestador') {
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
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link  rel="stylesheet" type="text/css" href="../Application/Styles/AreaPessoal.css">
        <title>Ofertas Favoritas</title>
    </head>
    <body>      
        <?php require_once __DIR__ . '/../Application/imports/Header.php'; ?>

        <section id="categorias">
            <?php
            $prestadorMan = new PrestadorManager();
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

            <?php
            $man = new PrestadorManager();
            $res = $man->verifyEmail(SessionManager::getSessionValue('email'));
            $manFav = new FavoritosManager();
            $return = $manFav->getFavoritosByIDPrestador($res[0]['idPrestador']);
            if (!empty($return)) {
                $ofertaMan = new OfertaManager();
                ?>
                <table>
                    <tr>
                        <th>Titulo</th>
                    </tr>
                    <?php
                    foreach ($return as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $ofertaMan->getOfertaByID($value['idOferta'])[0]['tituloOferta'] ?>
                            <td class="tdButtom"><a href="../verOfertas.php?oferta=<?= $value['idOferta'] ?>"><button class="tableButton">Ver Oferta</button></a></td>
                            <td class="tdButtom"><a href="removerFavoritos.php?oferta=<?= $value['idOferta'] ?>"><button class="tableButton">Remover Favorito</button></a></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table> 
                <?php
            } else {
                ?>
                <p>Não ofertas de trabalho marcadas como favoritas</p>
                <?php
            }
            ?>
        </section>
        <a href="areaPessoalPrestador.php"><button>Voltar</button></a>
    </body>
</html>
