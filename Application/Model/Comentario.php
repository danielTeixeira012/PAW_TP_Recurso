<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Comentario
 *
 * @author User
 */
class Comentario {
    private $idComentario;
    private $idOferta;
    private $comentario;
    
    function __construct($idComentario, $idOferta, $comentario) {
        $this->idComentario = $idComentario;
        $this->idOferta = $idOferta;
        $this->comentario = $comentario;
    }
    function getIdComentario() {
        return $this->idComentario;
    }

    function getIdOferta() {
        return $this->idOferta;
    }

    function getComentario() {
        return $this->comentario;
    }

    function setIdComentario($idComentario) {
        $this->idComentario = $idComentario;
    }

    function setIdOferta($idOferta) {
        $this->idOferta = $idOferta;
    }

    function setComentario($comentario) {
        $this->comentario = $comentario;
    }


}


