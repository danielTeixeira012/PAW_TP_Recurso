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

    public function getOfertasPendentesUser($idUser) {
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `idEmpregador` = $idUser and `dataInicio` > CURRENT_DATE");
    }

    public function getOfertasPendentes() {
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `dataInicio` > CURRENT_DATE");
    }

    public function getOfertasPublicadasUser($idUser) {
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `idEmpregador` = $idUser and `dataInicio` < CURRENT_DATE and `dataFim` > CURRENT_DATE");
    }

    public function getOfertasPublicadas() {
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `dataInicio` < CURRENT_DATE and `dataFim` > CURRENT_DATE");
    }

    public function getOfertasFinalizadasUser($idUser) {
        return $this->getRecordsByUserQuery("SELECT DISTINCT ofertaTrabalho.idOferta, ofertaTrabalho.idCategoria, ofertaTrabalho.tituloOferta, ofertaTrabalho.informacaoOferta, ofertaTrabalho.funcaoOferta, ofertaTrabalho.salario, ofertaTrabalho.requisitos, ofertaTrabalho.regiao, ofertaTrabalho.idEmpregador, ofertaTrabalho.statusO, ofertaTrabalho.tipoOferta, ofertaTrabalho.dataInicio, ofertaTrabalho.dataFim FROM `ofertaTrabalho` INNER JOIN `candidatura` on 
    ((ofertaTrabalho.idOferta = candidatura.idOferta and (candidatura.statusCandidatura='submetida') and `idEmpregador` = $idUser and ofertaTrabalho.dataFim < CURRENT_DATE))");
    }

    public function getOfertasFinalizadas() {
        return $this->getRecordsByUserQuery("SELECT DISTINCT ofertaTrabalho.idOferta, ofertaTrabalho.idCategoria, ofertaTrabalho.tituloOferta, ofertaTrabalho.informacaoOferta, ofertaTrabalho.funcaoOferta, ofertaTrabalho.salario, ofertaTrabalho.requisitos, ofertaTrabalho.regiao, ofertaTrabalho.idEmpregador, ofertaTrabalho.statusO, ofertaTrabalho.tipoOferta, ofertaTrabalho.dataInicio, ofertaTrabalho.dataFim FROM `ofertaTrabalho` INNER JOIN `candidatura` on 
    ((ofertaTrabalho.idOferta = candidatura.idOferta and (candidatura.statusCandidatura='submetida') and ofertaTrabalho.dataFim < CURRENT_DATE))");
    }

    public function getOfertasExpiradasUser($idUser) {
        return $this->getRecordsByUserQuery("SELECT DISTINCT ofertaTrabalho.idOferta, ofertaTrabalho.idCategoria, ofertaTrabalho.tituloOferta, ofertaTrabalho.informacaoOferta, ofertaTrabalho.funcaoOferta, ofertaTrabalho.salario, ofertaTrabalho.requisitos, ofertaTrabalho.regiao, ofertaTrabalho.idEmpregador, ofertaTrabalho.statusO, ofertaTrabalho.tipoOferta, ofertaTrabalho.dataInicio, ofertaTrabalho.dataFim  FROM `ofertaTrabalho` INNER JOIN `candidatura` on 
    ((ofertaTrabalho.idOferta = candidatura.idOferta and (candidatura.statusCandidatura='aceitada' or candidatura.statusCandidatura ='rejeitada')and `idEmpregador` = $idUser and ofertaTrabalho.dataFim < CURRENT_DATE) )
union
SELECT ofertaTrabalho.idOferta, ofertaTrabalho.idCategoria, ofertaTrabalho.tituloOferta, ofertaTrabalho.informacaoOferta, ofertaTrabalho.funcaoOferta, ofertaTrabalho.salario, ofertaTrabalho.requisitos, ofertaTrabalho.regiao, ofertaTrabalho.idEmpregador, ofertaTrabalho.statusO, ofertaTrabalho.tipoOferta, ofertaTrabalho.dataInicio, ofertaTrabalho.dataFim FROM `ofertaTrabalho` LEFT JOIN `candidatura` ON (candidatura.idOferta = ofertaTrabalho.idOferta ) WHERE candidatura.idOferta IS NULL and `idEmpregador` = $idUser and ofertaTrabalho.dataFim < CURRENT_DATE");
    }

    public function getOfertasExpiradas() {
        return $this->getRecordsByUserQuery("SELECT DISTINCT ofertaTrabalho.idOferta, ofertaTrabalho.idCategoria, ofertaTrabalho.tituloOferta, ofertaTrabalho.informacaoOferta, ofertaTrabalho.funcaoOferta, ofertaTrabalho.salario, ofertaTrabalho.requisitos, ofertaTrabalho.regiao, ofertaTrabalho.idEmpregador, ofertaTrabalho.statusO, ofertaTrabalho.tipoOferta, ofertaTrabalho.dataInicio, ofertaTrabalho.dataFim  FROM `ofertaTrabalho` INNER JOIN `candidatura` on 
    ((ofertaTrabalho.idOferta = candidatura.idOferta and (candidatura.statusCandidatura='aceitada' or candidatura.statusCandidatura ='rejeitada') and ofertaTrabalho.dataFim < CURRENT_DATE) )
union
SELECT ofertaTrabalho.idOferta, ofertaTrabalho.idCategoria, ofertaTrabalho.tituloOferta, ofertaTrabalho.informacaoOferta, ofertaTrabalho.funcaoOferta, ofertaTrabalho.salario, ofertaTrabalho.requisitos, ofertaTrabalho.regiao, ofertaTrabalho.idEmpregador, ofertaTrabalho.statusO, ofertaTrabalho.tipoOferta, ofertaTrabalho.dataInicio, ofertaTrabalho.dataFim FROM `ofertaTrabalho` LEFT JOIN `candidatura` ON (candidatura.idOferta = ofertaTrabalho.idOferta ) WHERE candidatura.idOferta IS NULL and ofertaTrabalho.dataFim < CURRENT_DATE");
    }

}
