<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');

/**
 * 
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class CandidaturaManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'candidatura';

    function insertCandidatura(Candidatura $candidatura) {
        parent::insert(self::SQL_TABLE_NAME, $candidatura->convertObjectToArray());
    }

    public function editCandidatura(Candidatura $obj, $idCandidatura) {
        $this->update(self::SQL_TABLE_NAME, $obj->convertObjectToArrayUpdate(), array('idCandidatura' => $idCandidatura));
    }

    function getCandidaturas() {
        return parent::getRecords(self::SQL_TABLE_NAME);
    }

    function getCandidaturasByIdPrestador($id) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $id));
    }

    function getCandidaturasSubmetidasByIdPrestador($id) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $id, 'statusCandidatura' => 'submetida'));
    }

    function getCandidaturasAceitesOfIdPrestador($id) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $id, 'statusCandidatura' => 'aceitada'));
    }

    function getCandidaturasRejeitasOfIdPrestador($id) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $id, 'statusCandidatura' => 'rejeitada'));
    }

    function getCandidaturasByIdOferta($idOferta) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta));
    }

    function getCandidaturasSubmetidasByIdOferta($idOferta) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta, 'statusCandidatura' => 'submetida'));
    }
    
    function getCandidaturasSubmetidasByIdOfertaAndIdCandidatura($idOferta,$idCandidatura) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta,'idCandidatura' => $idCandidatura, 'statusCandidatura' => 'submetida'));
    }

    function getCandidaturasExpiradasByIdOferta($idOferta) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta, 'statusCandidatura' => 'expirada'));
    }

    function getVencedorCandidaturaByIdOferta($idOferta) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta, 'statusCandidatura' => 'aceitada'));
    }

    function getCandidaturasRejeitadaByIdOferta($idOferta) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta, 'statusCandidatura' => 'rejeitada'));
    }

    function deleteCandidatura($id) {
        parent::delete(self::SQL_TABLE_NAME, array('idCandidatura' => $id));
    }

    function deleteCandidaturaByIdPrestador($idPrestador) {
        parent::delete(self::SQL_TABLE_NAME, array('idPrestador' => $idPrestador));
    }

    function deleteCandidaturaByIdOferta($idOferta) {
        parent::delete(self::SQL_TABLE_NAME, array('idOferta' => $idOferta));
    }

    function getCandidaturaByIdPrestadorAndStatusCandidatura($id, $status) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $id, 'statusCandidatura' => $status));
    }

    function getCandidaturaByIdPrestadorAndStatusCandidaturasAndIdOferta($idPrestador, $status, $idOferta) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $idPrestador, 'statusCandidatura' => $status, 'idOferta' => $idOferta));
    }

    function prestadorCandidatouseSubmetida($idOferta, $idPrestador) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta, 'idPrestador' => $idPrestador, 'statusCandidatura' => 'submetida'));
    }

    function prestadorCandidatouseAceitadas($idOferta, $idPrestador) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta, 'idPrestador' => $idPrestador, 'statusCandidatura' => 'aceitada'));
    }

    function prestadorCandidatouseRejeitadas($idOferta, $idPrestador) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idOferta' => $idOferta, 'idPrestador' => $idPrestador, 'statusCandidatura' => 'rejeitada'));
    }

}
