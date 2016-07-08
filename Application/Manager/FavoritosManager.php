<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Favoritos.php');
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FavoritosManager
 *
 * @author User
 */
class FavoritosManager extends MyDataAccessPDO{
    
    const SQL_TABLE_NAME = 'favoritos';

    function getFavoritos(){
        return parent::getRecords(self::SQL_TABLE_NAME);
    }
    
    function getFavoritosByIDPrestador($idPrestador){
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $idPrestador));
    }
    
    function getFavoritosByIDPrestadorAndIdOFerta($idPrestador, $idOferta){
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $idPrestador, 'idOferta'=>$idOferta));
    }
    
    function insertFavorito(Favoritos $favorito){
        parent::insert(self::SQL_TABLE_NAME, $favorito->convertObjectToArray());
    }
    
    function verificarFavorito($idOferta, $idPrestador){
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $idPrestador, 'idOferta' => $idOferta));
    }
    
    function removeFavoritoByIDFavorito($idFavorito){
        parent::delete(self::SQL_TABLE_NAME, array('idFavorito' => $idFavorito));
    }
    
    function removeFavoritosByIDOferta($idOferta){
        parent::delete(self::SQL_TABLE_NAME, array('idOferta' =>$idOferta));
    }
    
    function removeFavoritosByIDPrestador($idPrestador){
        parent::delete(self::SQL_TABLE_NAME, array('idPrestador' => $idPrestador));
    }
    
}
