<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'FavoritosManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');

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
        <title></title>
        <meta http-equiv="refresh" content="3; url='areaPessoalPrestador.php'"/>
    </head>
    <body>
        <?php
        $id = filter_input(INPUT_GET, 'oferta',FILTER_SANITIZE_NUMBER_INT);
        $ManagerPrestador = new PrestadorManager();
        $resPrest = $ManagerPrestador->verifyEmail(SessionManager::getSessionValue('email'));
        $managerFavoritos = new FavoritosManager();
        $results = $managerFavoritos->verificarFavorito($id, $resPrest[0]['idPrestador']);
        $manOferta = new OfertaManager();
        $exist = $manOferta->getOfertaByID($id);
        if (!empty($exist)) {
            if (empty($results)) {
                $favorito = new Favoritos('', $resPrest[0]['idPrestador'], $id);
                $managerFavoritos->insertFavorito($favorito);
                ?>
                <h2>A oferta foi adicionada aos favoritos, está a ser redirecionado para a sua página pessoal aguarde!!</h2>
                <?php
            } else {
                ?>
                <h2>A oferta já existe nos favoritos, está a ser redirecionado para a sua página pessoal aguarde!!</h2>
                <?php
            }
        } else {
            ?>
            <h2>A oferta não existe, está a ser redirecionado para a sua página pessoal aguarde!!</h2>
            <?php
        }
        ?>
    </body>
</html>
