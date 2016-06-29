<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ofertaTrabalho
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class OfertaTrabalho {

    private $idOferta;
    private $idCategoria;
    private $tituloOferta;
    private $tipoOferta;
    private $informacaoOferta;
    private $funcaoOferta;
    private $salario;
    private $requisitos;
    private $regiao;
    private $idEmpregador;
    private $statusO;
    private $dataInicio;
    private $dataFim;

    function __construct($idOferta, $idCategoria, $tituloOferta, $tipoOferta, $informacaoOferta, $funcaoOferta, $salario, $requisitos, $regiao, $idEmpregador, $statusO, $dataInicio, $dataFim) {
        $this->idOferta = $idOferta;
        $this->idCategoria = $idCategoria;
        $this->tituloOferta = $tituloOferta;
        $this->tipoOferta = $tipoOferta;
        $this->informacaoOferta = $informacaoOferta;
        $this->funcaoOferta = $funcaoOferta;
        $this->salario = $salario;
        $this->requisitos = $requisitos;
        $this->regiao = $regiao;
        $this->idEmpregador = $idEmpregador;
        $this->statusO = $statusO;
        $this->dataInicio = $dataInicio;
        $this->dataFim = $dataFim;
    }

    function getIdOferta() {
        return $this->idOferta;
    }

    function getIdCategoria() {
        return $this->idCategoria;
    }

    function getTituloOferta() {
        return $this->tituloOferta;
    }

    function getTipoOferta() {
        return $this->tipoOferta;
    }

    function getInformacaoOferta() {
        return $this->informacaoOferta;
    }

    function getFuncaoOferta() {
        return $this->funcaoOferta;
    }

    function getSalario() {
        return $this->salario;
    }

    function getRequisitos() {
        return $this->requisitos;
    }

    function getRegiao() {
        return $this->regiao;
    }

    function getIdEmpregador() {
        return $this->idEmpregador;
    }

    function getStatusO() {
        return $this->statusO;
    }

    function getDataInicio() {
        return $this->dataInicio;
    }

    function getDataFim() {
        return $this->dataFim;
    }

    function setIdOferta($idOferta) {
        $this->idOferta = $idOferta;
    }

    function setIdCategoria($idCategoria) {
        $this->idCategoria = $idCategoria;
    }

    function setTituloOferta($tituloOferta) {
        $this->tituloOferta = $tituloOferta;
    }

    function setTipoOferta($tipoOferta) {
        $this->tipoOferta = $tipoOferta;
    }

    function setInformacaoOferta($informacaoOferta) {
        $this->informacaoOferta = $informacaoOferta;
    }

    function setFuncaoOferta($funcaoOferta) {
        $this->funcaoOferta = $funcaoOferta;
    }

    function setSalario($salario) {
        $this->salario = $salario;
    }

    function setRequisitos($requisitos) {
        $this->requisitos = $requisitos;
    }

    function setRegiao($regiao) {
        $this->regiao = $regiao;
    }

    function setIdEmpregador($idEmpregador) {
        $this->idEmpregador = $idEmpregador;
    }

    function setStatusO($statusO) {
        $this->statusO = $statusO;
    }

    function setDataInicio($dataInicio) {
        $this->dataInicio = $dataInicio;
    }

    function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    public function convertObjectToArray() {
        $data = array(
            'idOferta' => '',
            'idCategoria' => $this->getIdCategoria(),
            'tituloOferta' => $this->getTituloOferta(),
            'informacaoOferta' => $this->getInformacaoOferta(),
            'funcaoOferta' => $this->getFuncaoOferta(),
            'salario' => $this->getSalario(),
            'requisitos' => $this->getRequisitos(),
            'regiao' => $this->getRegiao(),
            'idEmpregador' => $this->getIdEmpregador(),
            'statusO' => $this->getStatusO(),
            'tipoOferta' => $this->getTipoOferta(),
            'dataInicio' => $this->getDataInicio(),
            'dataFim' => $this->getDataFim());
        return $data;
    }

    public function convertObjectToArrayUpdate() {
        $data = array(
            'idOferta' => $this->getIdOferta(),
            'idCategoria' => $this->getIdCategoria(),
            'tituloOferta' => $this->getTituloOferta(),
            'informacaoOferta' => $this->getInformacaoOferta(),
            'funcaoOferta' => $this->getFuncaoOferta(),
            'salario' => $this->getSalario(),
            'requisitos' => $this->getRequisitos(),
            'regiao' => $this->getRegiao(),
            'idEmpregador' => $this->getIdEmpregador(),
            'statusO' => $this->getStatusO(),
            'tipoOferta' => $this->getTipoOferta(),
            'dataInicio' => $this->getDataInicio(),
            'dataFim' => $this->getDataFim());
        return $data;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['idOferta'], $data['idCategoria'], $data['tituloOferta'], $data['tipoOferta'], $data['informacaoOferta'], $data['funcaoOferta'], $data['salario'], $data['requisitos'], $data['regiao'], $data['idEmpregador'], $data['statusO'], $data['dataInicio'],$data['dataFim']);
    }

    public static function createObject($idOferta, $idCategoria, $tituloOferta, $tipoOferta, $informacaoOferta, $funcaoOferta, $salario, $requisitos, $regiao, $idEmpregador, $statusO, $dataInicio, $dataFim) {
        return new OfertaTrabalho($idOferta, $idCategoria, $tituloOferta, $tipoOferta, $informacaoOferta, $funcaoOferta, $salario, $requisitos, $regiao, $idEmpregador, $statusO, $dataInicio, $dataFim);
    }

}
