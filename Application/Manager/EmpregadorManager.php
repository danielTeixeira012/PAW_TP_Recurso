<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');
require_once (Conf::getApplicationModelPath() . 'Empregador.php');

/**
 * 
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class EmpregadorManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'empregador';

    public function insertPrestadorServico(Empregador $empregador) {
        parent::insert(self::SQL_TABLE_NAME, $empregador->convertObjectToArray());
    }

    public function updateEmpregador(Empregador $obj, $idEmpregador) {
        $this->update(self::SQL_TABLE_NAME, $obj->convertObjectToArrayUpdate(), array('idEmpregador' => $idEmpregador));
    }

    public function verifyEmail($email) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('email' => $email));
    }

    public function getEmpregadorByMail($email) {
        return $this->getRecords(self::SQL_TABLE_NAME, array('email' => $email));
    }

    public function getIdByMail($email) {
        $id = $this->getRecordsByUserQuery("SELECT `idEmpregador` FROM `empregador` WHERE `email` =  '{$email}'");
        return $id;
    }

    public function existsEmpregador($email, $password) {
        $res = parent::getRecords(self::SQL_TABLE_NAME);

        foreach ($res as $key => $value) {
            if ($value['email'] === $email && $value['password'] === $password) {
                return true;
            }
        }
    }

    public function getEmpregadorByID($id) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('idEmpregador' => $id));
    }

    public function getEmpregadores() {
        return parent::getRecords(self::SQL_TABLE_NAME);
    }

    public function deleteEmpregadorById($idEmpregador) {
        parent::delete(self::SQL_TABLE_NAME, array('idEmpregador' => $idEmpregador));
    }

}
