<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');

/**
 * 
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class CategoriasManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'categoriaOferta';

    function getCategorias() {
        return $this->getRecords(self::SQL_TABLE_NAME);
    }
    
    function  getCategoriaByID($idCategoria){
        return $this->getRecords(self::SQL_TABLE_NAME, array('idCategoria' => $idCategoria));
    }
    
     public function insertOferta(CategoriaOferta $oferta) {
        parent::insert(self::SQL_TABLE_NAME, $oferta->convertObjectToArray());
    }
    
    

}
