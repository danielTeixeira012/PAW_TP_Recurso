<?php
require_once (realpath(dirname(__FILE__)) . '/../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'SessionManager.php');
require_once (Conf::getApplicationManagerPath() . 'EmpregadorManager.php');
require_once (Conf::getApplicationManagerPath() . 'CandidaturaManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');
$session = SessionManager::existSession('email');
$tipo = SessionManager::existSession('tipoUser');
if ($session && $tipo) {
    if (SessionManager::getSessionValue('tipoUser') !== 'empregador') {
        header('location: ../index.php');
    }
} else {
    if (!$session && isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
        require_once '../VerificaCookies.php';
    }else{
       header('location: ../index.php'); 
    }
}
$ofertas = new OfertaManager();
$candidaturaMan = new CandidaturaManager();
$empregadorMan = new EmpregadorManager();
$idOferta = filter_input(INPUT_GET, 'altOfer',FILTER_SANITIZE_NUMBER_INT);
$existCandidaturas = $candidaturaMan->getCandidaturasByIdOferta($idOferta);
require_once __DIR__ . '/../Application/Validator/OfertaValidator.php';
if (empty($existCandidaturas)) {
    $oferta = $ofertas->getOfertaByID($idOferta);
    $idEmpregador = $empregadorMan->verifyEmail(SessionManager::getSessionValue('email'))[0]['idEmpregador'];
    if (empty($oferta)) {
        header('Location: AreaEmpregador.php');
    }
    if ($oferta[0]['idEmpregador'] !== $idEmpregador) {
        header('Location: AreaEmpregador.php');
    }
    ?>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" type="text/css" href="../Application/styles/FormsCSS.css"/>
            <title>Editar Oferta</title>
        </head>
        <body>
            <?php require_once __DIR__ . '/../Application/imports/Header.php';?>
            <section id="form">
                <form id="formOferta" action="EditarOfertaValida.php?altOfer=<?= $idOferta ?>" method="post">
                    <input type="hidden" id="idOferta" name="idOferta" value="<?= $idOferta ?>">
                    <label for="categoria">Categoria</label><select id="categoria" name="categoriaO">
                        <?php
                        $categoriaBD = new CategoriasManager();
                        $categorias = $categoriaBD->getCategorias();
                        foreach ($categorias as $key => $value) {
                            ?>
                            <option value="<?= $value['idCategoria'] ?>" <?php if ($oferta[0]['idCategoria'] == $value['idCategoria']) echo ' selected="selected"'; ?>><?= $value['nomeCategoria'] ?></option>    
                            <?php
                        }
                        ?>
                    </select>
                    <p class="error"><?= isset($errorsO) && array_key_exists('categoriaO', $errorsO) ? $errorsO['categoriaO'] : '' ?></p>

                    <label for="tituloOferta">Titulo</label><input id="tituloOferta" name="tituloO" value="<?= $oferta[0]['tituloOferta'] ?>">
                    <p class="error"><?= isset($errorsO) && array_key_exists('tituloO', $errorsO) ? $errorsO['tituloO'] : '' ?></p>
                    <label for="tipoOferta">Tipo de oferta</label><select id="tipoOferta" name="tipoO">
                        <option value="fullTime" <?php if ($oferta[0]['tipoOferta'] == 'fullTime') echo ' selected="selected"'; ?>>Full-Time</option>
                        <option value="partTime" <?php if ($oferta[0]['tipoOferta'] == 'partTime') echo ' selected="selected"'; ?>>Part-Time</option>
                    </select>
                    <p class="error"><?= isset($errorsO) && array_key_exists('tipoO', $errorsO) ? $errorsO['tipoO'] : '' ?></p>
                    <label for="informacaoOferta">Informações</label><textarea id="informacaoOferta" name="infoO"><?= $oferta[0]['informacaoOferta'] ?></textarea>
                    <p class="error"><?= isset($errorsO) && array_key_exists('infoO', $errorsO) ? $errorsO['infoO'] : '' ?></p>
                    <label for="funcaoOferta">Funções</label><textarea id="funcaoOferta" name="funcO"><?= $oferta[0]['funcaoOferta'] ?></textarea>
                    <p class="error"><?= isset($errorsO) && array_key_exists('funcO', $errorsO) ? $errorsO['funcO'] : '' ?></p>
                    <label for="regiao">Região</label><input id="regi" name="regi" value="<?= $oferta[0]['regiao'] ?>">
                    <p class="error"><?= isset($errorsO) && array_key_exists('regi', $errorsO) ? $errorsO['regi'] : '' ?></p>
                    <label for="salario">Salario</label><input id="salario" name="sal" value="<?= $oferta[0]['salario'] ?>">
                    <p class="error"><?= isset($errorsO) && array_key_exists('sal', $errorsO) ? $errorsO['sal'] : '' ?></p>
                    <label for="req">Requisitos</label><textarea id="requisitos" name="req"><?= $oferta[0]['requisitos'] ?></textarea>
                    <p class="error"><?= isset($errorsO) && array_key_exists('req', $errorsO) ? $errorsO['req'] : '' ?></p>
                    <label for="dataInicio">Data Início Candidatura</label><input id="dataInicio" type="date" name="dataInicio" value="<?= $oferta[0]['dataInicio'] ?>">
                    <p class="error"><?= isset($errorsO) && array_key_exists('dataInicio', $errorsO) ? $errorsO['dataInicio'] : '' ?></p>
                    <label for="dataFim">Data Limite Candidatura</label><input id="dataFim" type="date" name="dataFim" value="<?= $oferta[0]['dataFim'] ?>">
                    <p class="error"><?= isset($errorsO) && array_key_exists('dataFim', $errorsO) ? $errorsO['dataFim'] : '' ?></p>
                    <input type="hidden" id="statusOferta" name="statusO" value="<?= $oferta[0]['statusO'] ?>">
                    <p class="error"><?= isset($errorsO) && array_key_exists('statusO', $errorsO) ? $errorsO['statusO'] : '' ?></p>
                    <input class="buttonForm" id="confirm" type="submit" value="Editar OFERTA">
                </form>
            </section>
        </body>
        <?php
        require_once __DIR__ . '/../Application/imports/Footer.php';
        ?>
    </html>
<?php 
    }else {
    ?>

    <html>
        <head
            <title></title>
            <meta http-equiv="refresh" content="3; url='AreaEmpregador.php'"/>
        </head>
        <body>
            <p>A candidatura já tem candidaturas e portanto não pode ser alterada... Está a ser redirecionado para a sua área pessoal aguarde uns segundos!</p>
        </body>
    </html>
    <?php
}
?>