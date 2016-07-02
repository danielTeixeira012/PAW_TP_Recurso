<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Favoritos
 *
 * @author User
 */
class Favoritos {

    private $idFavorito;
    private $idPrestador;
    private $idOferta;

    function __construct($idFavorito, $idPrestador, $idOferta) {
        $this->idFavorito = $idFavorito;
        $this->idPrestador = $idPrestador;
        $this->idOferta = $idOferta;
    }

    function getIdFavorito() {
        return $this->idFavorito;
    }

    function getIdPrestador() {
        return $this->idPrestador;
    }

    function getIdOferta() {
        return $this->idOferta;
    }

    function setIdFavorito($idFavorito) {
        $this->idFavorito = $idFavorito;
    }

    function setIdPrestador($idPrestador) {
        $this->idPrestador = $idPrestador;
    }

    function setIdOferta($idOferta) {
        $this->idOferta = $idOferta;
    }

    function convertObjectToArray() {
        $data = array(
            'idFavorito' => '',
            'idPrestador' => $this->getIdPrestador(),
            'idOferta' => $this->getIdOferta()
        );
        return $data;
    }

}
