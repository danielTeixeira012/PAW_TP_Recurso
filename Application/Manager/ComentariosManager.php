<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Comentario.php');

/**
 * 
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class ComentariosManager extends MyDataAccessPDO{
    
    const SQL_TABLE_NAME = 'comentario';
    
    function getComentarios(){
        return parent::getRecords(self::SQL_TABLE_NAME);
    }
    
    function insertComentario(Comentario $comentario){
        parent::insert(self::SQL_TABLE_NAME, $comentario->convertObjectToArray());
    }
    
    function getUltimoComentario(){
        return parent::getRecordsByUserQuery("SELECT * FROM `comentario` WHERE `idComentario` = (SELECT `idComentario` FROM `comentario` ORDER BY `idComentario` DESC LIMIT 1)");
    }
}
