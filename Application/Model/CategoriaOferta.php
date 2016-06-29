<?php

/**
 * Description of categoriaOferta
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class CategoriaOferta {

    private $idCategoria;
    private $nomeCategoria;

    function __construct($idCategoria, $nomeCategoria) {
        $this->idCategoria = $idCategoria;
        $this->nomeCategoria = $nomeCategoria;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getNomeCategoria() {
        return $this->nomeCategoria;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setNomeCategoria($nomeCategoria) {
        $this->nomeCategoria = $nomeCategoria;
    }

}
