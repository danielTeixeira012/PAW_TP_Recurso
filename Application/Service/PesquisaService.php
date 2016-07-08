<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationManagerPath() . 'OfertaManager.php');
require_once (Conf::getApplicationManagerPath() . 'CategoriasManager.php');

$categoriaPesquisa = filter_input(INPUT_GET, 'categoria');

$ManagerOfertas = new OfertaManager();

$ManagerCategoria = new CategoriasManager();
$resultadosCategorias = $ManagerCategoria->getCategorias();

foreach ($resultadosCategorias as $key => $value) {
    if ($value['nomeCategoria'] === $categoriaPesquisa) {
        $resultado = $ManagerOfertas->getOfertasByCategoria($value['idCategoria']); 
        echo json_encode($resultado);
    }
}

