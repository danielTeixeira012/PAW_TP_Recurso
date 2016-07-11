<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
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
        <link  rel="stylesheet" type="text/css" href="../Application/styles/AreaPessoal.css">
        <title>Adicionar Oferta</title>
    </head>
    <body>
        <?php
        require_once '../Application/Validator/OfertaValidator.php';
        if (count($errorsO) > 0) {
            require_once __DIR__ . '/AddOferta.php';
        } else {
            require_once '../Application/Imports/Header.php';
            $ofertasMan = new OfertaManager();
            $empregadorMan = new EmpregadorManager();
            $idEmpregador = $empregadorMan->verifyEmail(SessionManager::getSessionValue('email'))[0]['idEmpregador'];
            $ofertasMan->insertOferta(new ofertaTrabalho('', $categoria, $titulo, $tipo, $informacao, $funcao, $salario, $requisitos, $regiao, $idEmpregador, 'ativada', $dataInicio, $dataFim));
            ?>
            <h2>Oferta submetida com sucesso</h2>

            <?php
            require_once '../Application/Imports/Footer.php';
        }
        ?>
    </body>
</html>
