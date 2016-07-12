<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'administrador') {
        header('location: ../index.php');
    }
} else {
    if (!$session && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        require_once '../VerificaCookies.php';
    }else{
       header('location: ../index.php'); 
    }
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Gerir Empregadores</title>
        <link rel="stylesheet" type="text/css" href="../Application/Styles/AdminCSS.css"/>
        <script src="../Application/Libs/jquery-2.2.4.js"></script>
        <script src="../Application/JS/eliminarEmpregadorJS.js"></script>
    </head>
    <body id="adminT">
        <?php require_once '../Application/imports/Header.php'; ?>
        <?php
        $managerEmpre = new EmpregadorManager();
        $res = $managerEmpre->getEmpregadores();
        ?>
        
        <section id="opcoes">
        <h1>Lista de Empregadores</h1>
        <table id="tableEmpregador">
            
            <th> Nome </th>
            <th> Email </th>
            <th> Opcao </th>
            <?php
            foreach ($res as $key => $value) {
                ?>
                <tr id="<?= $value['idEmpregador'] ?>">
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td class="tdButtom"><button class="eliminarEmpregador">Eliminar</button></td>
                </tr>
                <?php
            }
            ?>
        </table>
        </section>
        <?php require_once '../Application/imports/footer.php'; ?>
    </body>
</html>
