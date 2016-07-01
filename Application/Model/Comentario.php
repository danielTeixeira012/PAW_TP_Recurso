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
    private $autor;
    
    function __construct($idComentario, $idOferta, $comentario, $autor) {
        $this->idComentario = $idComentario;
        $this->idOferta = $idOferta;
        $this->comentario = $comentario;
        $this->autor = $autor;
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

    function getAutor() {
        return $this->autor;
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

    function setAutor($autor) {
        $this->autor = $autor;
    }

    
    public function convertObjectToArray() {
        $data = array(
            'idComentario' => '',
            'idOferta' => $this->getIdOferta(),
            'comentario' => $this->getComentario(),
            'autor' => $this->getAutor()
            );
        return $data;
    }

}


