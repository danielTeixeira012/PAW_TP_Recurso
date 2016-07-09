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
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `idEmpregador` = $idUser and `dataInicio` > CURRENT_DATE and `statusO` = 'ativada'");
    }

    public function getOfertasPendentes() {
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `dataInicio` > CURRENT_DATE and `statusO` = 'ativada'");
    }

    public function getOfertasPublicadasUser($idUser) {
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `idEmpregador` = $idUser and `dataInicio` <= CURRENT_DATE and `dataFim` > CURRENT_DATE and `statusO` = 'ativada'");
    }

    public function getOfertasPublicadas() {
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertaTrabalho` WHERE `dataInicio` <= CURRENT_DATE and `dataFim` > CURRENT_DATE and `statusO` = 'ativada'");
    }

    public function getOfertasFinalizadasUser($idUser) {
        return $this->getRecordsByUserQuery("SELECT DISTINCT ofertaTrabalho.* FROM `ofertaTrabalho` INNER JOIN `candidatura` on 
    ((ofertaTrabalho.idOferta = candidatura.idOferta and (candidatura.statusCandidatura='submetida') and `idEmpregador` = $idUser and ofertaTrabalho.dataFim < CURRENT_DATE and ofertatrabalho.statusO = 'ativada'))");
    }

    public function getOfertasFinalizadas() {
        return $this->getRecordsByUserQuery("SELECT DISTINCT ofertaTrabalho.* FROM `ofertaTrabalho` INNER JOIN `candidatura` on 
    ((ofertaTrabalho.idOferta = candidatura.idOferta and (candidatura.statusCandidatura='submetida') and ofertaTrabalho.dataFim < CURRENT_DATE and ofertatrabalho.statusO = 'ativada'))");
    }

    public function getOfertasExpiradasUser($idUser) {
        return $this->getRecordsByUserQuery("SELECT DISTINCT ofertaTrabalho.*  FROM `ofertaTrabalho` INNER JOIN `candidatura` on 
    ((ofertaTrabalho.idOferta = candidatura.idOferta and (candidatura.statusCandidatura='aceitada' or candidatura.statusCandidatura ='rejeitada')and `idEmpregador` = $idUser and ofertaTrabalho.dataFim < CURRENT_DATE) )
union
SELECT DISTINCT ofertaTrabalho.* FROM `ofertaTrabalho` LEFT JOIN `candidatura` ON (candidatura.idOferta = ofertaTrabalho.idOferta ) WHERE candidatura.idOferta IS NULL and `idEmpregador` = $idUser and ofertaTrabalho.dataFim < CURRENT_DATE and ofertatrabalho.statusO = 'ativada'");
    }

    public function getOfertasExpiradas() {
        return $this->getRecordsByUserQuery("SELECT DISTINCT ofertaTrabalho.*  FROM `ofertaTrabalho` INNER JOIN `candidatura` on 
    ((ofertaTrabalho.idOferta = candidatura.idOferta and (candidatura.statusCandidatura='aceitada' or candidatura.statusCandidatura ='rejeitada') and ofertaTrabalho.dataFim < CURRENT_DATE) )
union
SELECT DISTINCT ofertaTrabalho.* FROM `ofertaTrabalho` LEFT JOIN `candidatura` ON (candidatura.idOferta = ofertaTrabalho.idOferta ) WHERE candidatura.idOferta IS NULL and ofertaTrabalho.dataFim < CURRENT_DATE and ofertatrabalho.statusO = 'ativada'");
    }
    
    function VerificaOfertaPendente($idOferta){
        return empty($this->getRecordsByUserQuery("SELECT * FROM `ofertatrabalho` WHERE ofertatrabalho.idOferta =$idOferta  and `dataInicio` > CURRENT_DATE and `statusO` = 'ativada'"));
    }
    
    function VerificaOfertaExpirou($idOferta){
        return empty($this->getRecordsByUserQuery("SELECT * FROM `ofertatrabalho` WHERE ofertatrabalho.idOferta =$idOferta  and `dataInicio` <= CURRENT_DATE and `dataFim` > CURRENT_DATE and `statusO` = 'ativada'"));
    }
    
    function getDataAtual(){
        return $this->getRecordsByUserQuery("SELECT CURRENT_DATE")[0]['CURRENT_DATE'];;
    }
    
    function pesquisar($pesquisa){
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertatrabalho` WHERE `dataInicio` <= CURRENT_DATE and `dataFim` > CURRENT_DATE and `statusO` = 'ativada' and (`tituloOferta` LIKE '%$pesquisa%' or `informacaoOferta` LIKE '%$pesquisa%' or `funcaoOferta` LIKE '%$pesquisa%')");
    }
    
    function pesquisarCategoria($pesquisa){
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertatrabalho` WHERE `idCategoria` = $pesquisa and `dataInicio` <= CURRENT_DATE and `dataFim` > CURRENT_DATE and `statusO` = 'ativada'");
    }
    
    function pesquisarHorario($pesquisa){
        return $this->getRecordsByUserQuery("SELECT * FROM `ofertatrabalho` WHERE `tipoOferta` = '$pesquisa' and `dataInicio` <= CURRENT_DATE and `dataFim` > CURRENT_DATE and `statusO` = 'ativada'");
    }

}
