<?php

require_once (realpath(dirname(__FILE__)) . '/../../Config.php');

use Config as Conf;

require_once (Conf::getApplicationDatabasePath() . 'MyDataAccessPDO.php');

/**
 * 
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class AdministradorManager extends MyDataAccessPDO {

    const SQL_TABLE_NAME = 'administrador';

    function verifyEmail($email) {
        return parent::getRecords(self::SQL_TABLE_NAME, array('email' => $email));
    }

    public function existsAdministrador($email, $password) {
        $res = parent::getRecords(self::SQL_TABLE_NAME);

        foreach ($res as $key => $value) {
            if ($value['email'] === $email && $value['password'] === $password) {
                return true;
            }
        }
    }

}
