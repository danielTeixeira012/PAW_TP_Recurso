<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'OfertaTrabalho.php');

/**
 * 
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class OfertaManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'ofertaTrabalho';

    function getOfertas() {

        return $this->getRecords(self::SQL_TABLE_NAME);
    }

    function getOfertaUser($userId) {
        return $this->getRecords(self::SQL_TABLE_NAME, array('idEmpregador' => $userId));
    }

    function getOfertaByID($IdOferta) {
        return $this->getRecords(self::SQL_TABLE_NAME, array('idOferta' => $IdOferta));
    }

    public function editOferta(OfertaTrabalho $obj, $idOferta) {
        $this->update(self::SQL_TABLE_NAME, $obj->convertObjectToArrayUpdate(), array('idOferta' => $idOferta));
    }

    public function insertOferta(OfertaTrabalho $oferta) {
        parent::insert(self::SQL_TABLE_NAME, $oferta->convertObjectToArray());
    }

    function getOfertasByCategoria($categoria) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idCategoria' => $categoria));
    }

    public function deleteOfertasByIdEmpregador($idEmpregador) {
        return parent::delete(self::SQL_TABLE_NAME, array('idEmpregador' => $idEmpregador));
    }

    public function deleteOfertasByIdOferta($idOferta) {
        parent::delete(self::SQL_TABLE_NAME, array('idOferta' => $idOferta));
    }
    
    public function getOfertasPendentesUser($idUser){
        $dataAtual = date("Y-m-d");
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `idEmpregador` = $idUser and `dataInicio` > '$dataAtual'");
    }
    
    public function getOfertasPublicadasUser($idUser){
        $dataAtual = date("Y-m-d");
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `idEmpregador` = $idUser and `dataInicio` < '$dataAtual' and `dataFim` > '$dataAtual'");
    }
}
