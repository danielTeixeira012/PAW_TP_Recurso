<?php

/**
 * Description of Candidatura
 *
 * @author Daniel Teixeira & Pedro Xavier
 */
class Candidatura {

    private $idCandidatura;
    private $idPrestador;
    private $idOferta;
    private $statusCandidatura;

    function __construct($idCandidatura, $idPrestador, $idOferta, $statusCandidatura) {
        $this->idCandidatura = $idCandidatura;
        $this->idPrestador = $idPrestador;
        $this->idOferta = $idOferta;
        $this->statusCandidatura = $statusCandidatura;
    }

    function getIdCandidatura() {
        return $this->idCandidatura;
    }

    function getIdPrestador() {
        return $this->idPrestador;
    }

    function getIdOferta() {
        return $this->idOferta;
    }

    function getStatusCandidatura() {
        return $this->statusCandidatura;
    }

    function setIdCandidatura($idCandidatura) {
        $this->idCandidatura = $idCandidatura;
    }

    function setIdPrestador($idPrestador) {
        $this->idPrestador = $idPrestador;
    }

    function setIdOferta($idOferta) {
        $this->idOferta = $idOferta;
    }

    function setStatusCandidatura($statusCandidatura) {
        $this->statusCandidatura = $statusCandidatura;
    }

    public function convertObjectToArray() {
        $data = array('idCandidatura' => '',
            'idPrestador' => $this->getIdPrestador(),
            'idOferta' => $this->getIdOferta(),
            'statusCandidatura' => $this->getStatusCandidatura()
        );
        return $data;
    }

    public function convertObjectToArrayUpdate() {
        $data = array('idCandidatura' => $this->getIdCandidatura(),
            'idPrestador' => $this->getIdPrestador(),
            'idOferta' => $this->getIdOferta(),
            'statusCandidatura' => $this->getStatusCandidatura()
        );
        return $data;
    }

    public static function convertArrayToObject(Array &$data) {
        return self::createObject($data['idCandidatura'], $data['idPrestador'], $data['idOferta'], $data['statusCandidatura']);
    }

    public static function createObject($idCandidatura, $idPrestador, $idOferta, $statusCandidatura) {
        return new Candidatura($idCandidatura, $idPrestador, $idOferta, $statusCandidatura);
    }

}
