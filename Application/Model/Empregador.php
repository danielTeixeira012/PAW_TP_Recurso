<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Empregador
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class Empregador {

    private $idEmpregador;
    private $email;
    private $fotoPath;
    private $password;
    private $nome;
    private $contato;
    private $morada;
    private $codPostal;
    private $distrito;
    private $concelho;

    function __construct($idEmpregadaor, $email, $fotoPath, $password, $nome, $contato, $morada, $codPostal, $distrito, $concelho) {
        $this->idEmpregador = $idEmpregadaor;
        $this->email = $email;
        $this->fotoPath = $fotoPath;
        $this->password = $password;
        $this->nome = $nome;
        $this->contato = $contato;
        $this->morada = $morada;
        $this->codPostal = $codPostal;
        $this->distrito = $distrito;
        $this->concelho = $concelho;
    }

    function getIdEmpregador() {
        return $this->idEmpregador;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getNome() {
        return $this->nome;
    }

    function getContato() {
        return $this->contato;
    }

    function getMorada() {
        return $this->morada;
    }

    function getCodPostal() {
        return $this->codPostal;
    }

    function getDistrito() {
        return $this->distrito;
    }

    function getConcelho() {
        return $this->concelho;
    }

    function getFotoPath() {
        return $this->fotoPath;
    }

    function setIdEmpregador($idEmpregador) {
        $this->idEmpregador = $idEmpregador;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }

    function setNome($nome) {
        $this->nome = $nome;
    }

    function setContato($contato) {
        $this->contato = $contato;
    }

    function setMorada($morada) {
        $this->morada = $morada;
    }

    function setCodPostal($codPostal) {
        $this->codPostal = $codPostal;
    }

    function setDistrito($distrito) {
        $this->distrito = $distrito;
    }

    function setConcelho($concelho) {
        $this->concelho = $concelho;
    }

    function setFotoPath($fotoPath) {
        $this->fotoPath = $fotoPath;
    }

    public function convertObjectToArray() {
        $data = array(
            'idEmpregador' => '',
            'email' => $this->getEmail(),
            'fotoPath' => $this->getFotoPath(),
            'password' => $this->getPassword(),
            'nome' => $this->getNome(),
            'contato' => $this->getContato(),
            'morada' => $this->getMorada(),
            'codPostal' => $this->getCodPostal(),
            'distrito' => $this->getDistrito(),
            'concelho' => $this->getConcelho()
        );
        return $data;
    }

    public function convertObjectToArrayUpdate() {
        $data = array(
            'idEmpregador' => $this->getIdEmpregador(),
            'email' => $this->getEmail(),
            'fotoPath' => $this->getFotoPath(),
            'password' => $this->getPassword(),
            'nome' => $this->getNome(),
            'contato' => $this->getContato(),
            'morada' => $this->getMorada(),
            'codPostal' => $this->getCodPostal(),
            'distrito' => $this->getDistrito(),
            'concelho' => $this->getConcelho()
        );
        return $data;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['idEmpregador'], $data['email'], $data['fotoPath'], $data['password'], $data['nome'], $data['contato'], $data['morada'], $data['codPostal'], $data['distrito'], $data['concelho']);
    }

    public static function createObject($idEmpregador, $email, $fotoPath, $password, $nome, $contato, $morada, $codPostal, $distrito, $concelho) {
        $empregador = new Empregador($idEmpregador, $email, $fotoPath, $password, $nome, $contato, $morada, $codPostal, $distrito, $concelho);
        return $empregador;
    }

}
