<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SubcategoriaOferta
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class SubcategoriaOferta {

    private $idSubcategoria;
    private $nomeSubcategoria;
    private $idCategoria;

    function __construct($idSubcategoria, $nomeSubcategoria, $idCategoria) {
        $this->idSubcategoria = $idSubcategoria;
        $this->nomeSubcategoria = $nomeSubcategoria;
        $this->idCategoria = $idCategoria;
    }

    function getIdSubcategoria() {
        return $this->idSubcategoria;
    }

    function getNomeSubcategoria() {
        return $this->nomeSubcategoria;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function setIdSubcategoria($idSubcategoria) {
        $this->idSubcategoria = $idSubcategoria;
    }

    function setNomeSubcategoria($nomeSubcategoria) {
        $this->nomeSubcategoria = $nomeSubcategoria;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

}
