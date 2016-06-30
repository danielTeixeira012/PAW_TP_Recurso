<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'PrestadorServico.php');

/**
 * 
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class PrestadorManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'prestadorservico';

    public function insertPrestadorServico(PrestadorServico $prestador) {
        parent::insert(self::SQL_TABLE_NAME, $prestador->convertObjectToArray());
    }

    function getPrestadoresServicos() {
        return parent::getRecords(self::SQL_TABLE_NAME);
    }

    public function verifyEmail($email) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('email' => $email));
    }

    public function getPrestadorByid($id) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idPrestador' => $id));
    }

    public function existsPrestadorServico($email, $password) {
        $res = parent::getRecords(self::SQL_TABLE_NAME);

        foreach ($res as $key => $value) {
            if ($value['email'] === $email && $value['password'] === $password) {
                return true;
            }
        }
    }

    public function updatePrestador(PrestadorServico $prestador) {
        parent::update(self::SQL_TABLE_NAME, $prestador->convertObjectToArrayUpdate(), array('idPrestador' => $prestador->getIdPrestador()));
    }

    public function deletePrestadorById($idPrestador) {
        parent::delete(self::SQL_TABLE_NAME, array('idPrestador' => $idPrestador));
    }

}
