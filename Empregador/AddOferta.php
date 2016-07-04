<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'empregador') {
        header('location: ../index.php');
    }
} else {
    header('location: ../Login.php');
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="../Application/styles/FormsCSS.css"/>
        <script src="../Application/JS/OfertaLS_JS.js"></script> 
        <title></title>
    </head>
    <body>
        <?php require_once '../Application/imports/Header.php' ?>
        <?php
        require_once __DIR__ . '/../Application/Validator/OfertaValidator.php';
        ?>
        <section id="form">
            <form id="formOferta" action="AddOfertaValida.php" method="post" >
                <input type="hidden" id="idEmpregador" name="idEmpregador" value="<?= $idEmpregador ?>">
                <label for="categoria">Categoria</label><select id="categoria" name="categoriaO">
                    <?php
                    $categoriaBD = new CategoriasManager();
                    $categorias = $categoriaBD->getCategorias();
                    foreach ($categorias as $key => $value) {
                        ?>
                        <option value="<?= $value['idCategoria'] ?>"><?= $value['nomeCategoria'] ?></option>    
                        <?php
                    }
                    ?>
                    <p class="error"><?= isset($errorsO) && array_key_exists('categoriaO', $errorsO) ? $errorsO['categoriaO'] : '' ?></p>
                </select>
                <label for="tituloOferta">Titulo</label><input id="tituloOferta" name="tituloO"><p class="error"><?= isset($errorsO) && array_key_exists('tituloO', $errorsO) ? $errorsO['tituloO'] : '' ?></p>
                <label for="tipoOferta">Tipo de oferta</label>
                <select id="tipoOferta" name="tipoO">
                    <option value="fullTime">Full-Time</option>
                    <option value="partTime">Part-Time</option>
                </select>
                <label for="informacaoOferta">Informações</label><textarea id="informacaoOferta" name="infoO"></textarea><p class="error"><?= isset($errorsO) && array_key_exists('infoO', $errorsO) ? $errorsO['infoO'] : '' ?></p>
                <label for="funcaoOferta">Funções</label><textarea id="funcaoOferta" name="funcO"></textarea><p class="error"><?= isset($errorsO) && array_key_exists('funcO', $errorsO) ? $errorsO['funcO'] : '' ?></p>
                <label for="regiao">Região</label><input id="regiao" name="regi"><p class="error"><?= isset($errorsO) && array_key_exists('regi', $errorsO) ? $errorsO['regi'] : '' ?></p>
                <label for="salario">Salario</label><input id="salario" name="sal" onkeyup="floatInput(this)"><p class="error"><?= isset($errorsO) && array_key_exists('sal', $errorsO) ? $errorsO['sal'] : '' ?></p>
                <label for="requisitos">Requisitos</label><textarea id="requisitos" name="req"></textarea><p class="error"><?= isset($errorsO) && array_key_exists('req', $errorsO) ? $errorsO['req'] : '' ?></p>
                <label for="dataInicio">Data Ínicio da Candidatura</label><input id="dataInicio" type="date" name="dataInicio"><p class="error"><?= isset($errorsO) && array_key_exists('dataInicio', $errorsO) ? $errorsO['dataInicio'] : '' ?></p>
                <label for="dataFim">Data Limite Candidatura</label><input id="dataFim" type="date" name="dataFim"><p class="error"><?= isset($errorsO) && array_key_exists('dataFim', $errorsO) ? $errorsO['dataFim'] : '' ?></p>
                <input class="buttonForm" id="submeter" type="submit" value="Submeter" name="submeter">

            </form>
                       <h3>Dados Locais</h3>
                        <p>Guardar dados localmente</p><button class="button2" id="guardarTemp">Guardar</button>
            
                        <div id="lsDIV">
            
                        </div>

        </section>
        <?php require_once '../Application/imports/Footer.php' ?>
    </body>
</html>
