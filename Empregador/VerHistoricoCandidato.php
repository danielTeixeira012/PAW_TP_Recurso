<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
$email = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if($email && $tipo){
    if(SessionManager::getSessionValue('tipoUser') !== 'empregador'){
        header('location: ../index.php');
    }
}else{
    header('location: ../index.php');
}
$exists = false; 
$manEmpregador = new EmpregadorManager();
$manOfertas = new OfertaManager();
$manCandidaturas =  new CandidaturaManager();

$id = filter_input(INPUT_GET, 'prestador');

$logado = $manEmpregador->getEmpregadorByMail(SessionManager::getSessionValue('email'));
$idEmpregador = $logado[0]['idEmpregador'];
$ofertasPrestador = $manOfertas->getOfertaUser($idEmpregador);

//verifica se pode ver historico prestador
foreach ($ofertasPrestador as $key => $value) {
    if(!empty($manCandidaturas->prestadorCandidatouseSubmetida($value['idOferta'], $id))||!empty($manCandidaturas->prestadorCandidatouseAceitadas($value['idOferta'], $id))||  !empty($manCandidaturas->prestadorCandidatouseRejeitadas($value['idOferta'], $id))){
        $exists = true;
    }   
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        if($exists){
        $canMan = new CandidaturaManager();
        $candidaturasSubmetidas = $canMan->getCandidaturasSubmetidasByIdPrestador($id);
        if (!empty($candidaturasSubmetidas)) {
            ?>
            <h1>Candidaturas Submetidas</h1>
            <table>
            <?php
            foreach ($candidaturasSubmetidas as $key => $value) {
                ?>
                    <tr>
                        <td><?= $value['idOferta'] ?></td>
                    </tr>
        <?php
    }
}
?>
        </table>

            <?php
            $candidaturasAceites = $canMan->getCandidaturasAceitesOfIdPrestador($id);
            if (!empty($candidaturasAceites)) {
                ?>
            <h1>Candidaturas Aceites</h1>
            <table>
            <?php
            foreach ($candidaturasAceites as $key => $value) {
                ?>
                    <tr>
                        <td><?= $value['idOferta'] ?></td>
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
            <?php
            $candidaturasRejeitadas = $canMan->getCandidaturasRejeitasOfIdPrestador($id);
            if (!empty($candidaturasRejeitadas)) {
                ?>
            <h1>Candidaturas Rejeitadas</h1>
            <table>
            <?php
            foreach ($candidaturasRejeitadas as $key => $value) {
                ?>
                    <tr>
                        <td><?= $value['idOferta'] ?></td>
                    </tr>
        <?php
    }
}
?>
        </table>
            <?php
        }else{
            ?>
            <p>Não pode aceder ao historico desejado</p>
            <?php
        }
            ?>
    </body>
</html>
