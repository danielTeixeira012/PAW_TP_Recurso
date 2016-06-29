<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Prestador
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class PrestadorServico {

    private $idPrestador;
    private $email;
    private $password;
    private $nome;
    private $contato;
    private $fotoPath;
    private $morada;
    private $codPostal;
    private $distrito;
    private $concelho;

    function __construct($idPrestador, $email, $password, $nome, $contato, $fotoPath, $morada, $codPostal, $distrito, $concelho) {
        $this->idPrestador = $idPrestador;
        $this->email = $email;
        $this->password = $password;
        $this->nome = $nome;
        $this->contato = $contato;
        $this->fotoPath = $fotoPath;
        $this->morada = $morada;
        $this->codPostal = $codPostal;
        $this->distrito = $distrito;
        $this->concelho = $concelho;
    }

    function getIdPrestador() {
        return $this->idPrestador;
    }

    function setIdPrestador($idPrestador) {
        $this->idPrestador = $idPrestador;
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

    function getFotoPath() {
        return $this->fotoPath;
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

    function setFotoPath($fotoPath) {
        $this->fotoPath = $fotoPath;
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

    public function convertObjectToArray() {
        $data = array('idPrestador' => '',
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'nome' => $this->getNome(),
            'contato' => $this->getContato(),
            'fotoPath' => $this->getFotoPath(),
            'morada' => $this->getMorada(),
            'codPostal' => $this->getCodPostal(),
            'distrito' => $this->getDistrito(),
            'concelho' => $this->getConcelho()
        );
        return $data;
    }

    public function convertObjectToArrayUpdate() {
        $data = array('idPrestador' => $this->getIdPrestador(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword(),
            'nome' => $this->getNome(),
            'contato' => $this->getContato(),
            'fotoPath' => $this->getFotoPath(),
            'morada' => $this->getMorada(),
            'codPostal' => $this->getCodPostal(),
            'distrito' => $this->getDistrito(),
            'concelho' => $this->getConcelho()
        );
        return $data;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['idPrestador'], $data['email'], $data['password'], $data['nome'], $data['contato'], $data['fotoPath'], $data['morada'], $data['codPostal'], $data['distrito'], $data['concelho']);
    }

    public static function createObject($idPrestador, $email, $password, $nome, $contato, $fotoPath, $morada, $codPostal, $distrito, $concelho) {
        $prestador = new PrestadorServico($idPrestador, $email, $password, $nome, $contato, $fotoPath, $morada, $codPostal, $distrito, $concelho);
        return $prestador;
    }

}
