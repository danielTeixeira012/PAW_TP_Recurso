<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
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
<html>
    <head>
        <meta charset="UTF-8">
        <title>Editar Perfil</title>
    </head>
    <body>
        <?php
        require_once __DIR__ . '/../Application/Validator/EditarPerfilPrestador.php';
        if (count($erros) > 0) {
            require_once __DIR__ . '/verPerfilPrestador.php';
        } else {
            $prestadorMan = new PrestadorManager();
            $emailSession = SessionManager::getSessionValue('email');
            $prestadorSession = $prestadorMan->verifyEmail($emailSession);
            if (!empty($prestadorSession)) {
                $idPrestador = $prestadorSession[0]['idPrestador'];
                $email = $prestadorSession[0]['email'];
                $fotoPath = $prestadorSession[0]['fotoPath'];
                $password = $prestadorSession[0]['password'];
                $prestadorMan = new PrestadorManager();
                $prestadorMan->updatePrestador(new PrestadorServico($idPrestador, $email, $password, $nome, $contato, $fotoPath, $morada, $codPostal, $distrito, $concelho));
                ?>
                <p>Editado com sucesso</p>
                <a href="areaPessoalPrestador.php"><button class="button">Voltar Area Pessoal</button></a>
                <?php
            }
            ?>

            <a href="areaPessoalPrestador.php"><button>Voltar</button></a>
            <?php
        }
        ?>
    </body>
</html>
