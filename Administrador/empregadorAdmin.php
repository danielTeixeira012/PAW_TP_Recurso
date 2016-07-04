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
    header('location: ../index.php');
}
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="stylesheet" type="text/css" href="../Application/Styles/verCSS.css"/>
        <script src="../Application/Libs/jquery-2.2.4.js"></script>
        <script src="../Application/JS/eliminarEmpregadorJS.js"></script>
    </head>
    <body id="adminT">
        <?php
        $managerEmpre = new EmpregadorManager();
        $res = $managerEmpre->getEmpregadores();
        ?>
        <table id="tableEmpregador" border="1">
            <h1>Lista de Empregadores</h1>
            <th> Nome </th>
            <th> Email </th>
            <th> Opcao </th>
            <?php
            foreach ($res as $key => $value) {
                ?>
                <tr id="<?= $value['idEmpregador'] ?>">
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><button class="eliminarEmpregador">Eliminar</button></td>
                </tr>
                <?php
            }
            ?>
    </body>
</html>
