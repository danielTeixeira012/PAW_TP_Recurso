<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'PrestadorManager.php');
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
        <title></title>
        <link rel="stylesheet" type="text/css" href="../Application/Styles/AdminCSS.css"/>
        <script src="../Application/Libs/jquery-2.2.4.js"></script>
        <script src="../Application/JS/eliminarPrestadorJS.js"></script>
    </head>
    <body id="adminT">
         <?php require_once '../Application/imports/Header.php'; ?>
        <?php
        $managerPres = new PrestadorManager();
        $res = $managerPres->getPrestadoresServicos();
        ?>
        <section id="opcoes">
            <h1>Lista de Prestadores Serviços</h1>
        <table id="tablePrestador"> 
            <th> Nome </th>
            <th> Email </th>
            <th> Opcao </th>
            <?php
            foreach ($res as $key => $value) {
                ?>
                <tr id="<?=$value['idPrestador']?>">
                    <td><?= $value['nome'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td class="tdButtom"><button class="eliminar">Eliminar</button></td>
                </tr>
                <?php
            }
            ?>
        </table>
        </section>
         <?php require_once '../Application/imports/footer.php'; ?>
    </body>
</html>
