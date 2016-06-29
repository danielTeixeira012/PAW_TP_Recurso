<?php

/**
 * Description of Administrador
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class Administrador {

    private $idAdministrador;
    private $email;
    private $password;

    function __construct($idAdministrador, $email, $password) {
        $this->idAdministrador = $idAdministrador;
        $this->email = $email;
        $this->password = $password;
    }

    function getIdAdministrador() {
        return $this->idAdministrador;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setIdAdministrador($idAdministrador) {
        $this->idAdministrador = $idAdministrador;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

}
