<?php

/**
 * Description of categoriaOferta
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class CategoriaOferta {

    private $idCategoria;
    private $nomeCategoria;
    private $fotoPath;

    function __construct($idCategoria, $nomeCategoria, $fotoPath) {
        $this->idCategoria = $idCategoria;
        $this->nomeCategoria = $nomeCategoria;
        $this->fotoPath = $fotoPath;
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

    function getFotoPath() {
        return $this->fotoPath;
    }

    function setFotoPath($fotoPath) {
        $this->fotoPath = $fotoPath;
    }

    public function convertObjectToArray() {
        $data = array(
            'idCategoria' => '',
            'nomeCategoria' => $this->getNomeCategoria(),
            'fotoPath' => $this->getFotoPath());
        return $data;
    }

}
