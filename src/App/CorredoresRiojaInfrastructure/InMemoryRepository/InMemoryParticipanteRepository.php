<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;

use App\CorredoresRiojaDomain\Repository\IParticipanteRepository;
use App\CorredoresRiojaDomain\Model\Participante;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Model\Organizacion;
use DateTime;



/**
 * Description of InMemoryParticipanteRepository
 *
 * @author magarcd
 */
class InMemoryParticipanteRepository implements IParticipanteRepository {

    private $participantes;
    private $carreras;

    public function __construct() {

        $org1 = new Organizacion("1", "org1", "Esta es nuestra primera organizacion", "org1@gmail.com", "1234");
        
        $this->carreras[] = new Carrera("1", "Matutrail", (new \DateTime("2016/11/01 12:11")), 0, (new \DateTime("2016/11/01")), 100, "ur.jpg", "descripcion1", $org1);
        $this->carreras[] = new Carrera("2", "Carrera2", (new \DateTime("2017/07/23 11:11")), 10, (new \DateTime("2017/08/23")), 50, "foto2.jpg", "descripcion2", $org1);
        $this->carreras[] = new Carrera("3", "CarreraUR", (new \DateTime("2016/09/20 12:09")), 0, (new \DateTime("2016/09/23 12:09")), 50, "foto2.jpg", "descripcion2", $org1);
        $this->carreras[] = new Carrera("4", "CarreraPrueba", (new \DateTime("2018/07/23 12:12")), 10, (new \DateTime("2018/08/23")), 50, "foto2.jpg", "descripcion de prueba", $org1);

        $corredor2 = new Corredor("1234", "Pepito", "Gonzalez", "prueba@gmail.com", "1234", "c/Ninguna parte nº5", (new \DateTime("now")));
        $corredor1 = new Corredor("234", "Manuel", "Garcia", "prueba2@hotmail.com", "1234", "avenida de nigún lugar", (new \DateTime("now")));

        $this->participantes[] = new Participante("1234", "06:28:23", $corredor1, $this->carreras[0]);
        $this->participantes[] = new Participante("123", "06:28:23", $corredor1, $this->carreras[1]);

        $this->participantes[] = new Participante("234", "07:02:11", $corredor2, $this->carreras[1]);
        $this->participantes[] = new Participante("2345", "07:02:11", $corredor2, $this->carreras[0]);
    
        $this->inscribirParticipante($this->participantes[1]);

    }

    public function deleteParticipacion(Corredor $corredor, Carrera $carrera) {
        foreach ($this->participantes as $key => $valor){
            if(!(($valor->getCarrera()==$carrera) and ($valor->getCorredor()==$corredor))){
                $this->participantes[]=$valor; 
            }            
        }       
    }

    public function findAllCarrerasDisputadasCorredor(Corredor $corredor) {
        $disputadas= [];
        $participante=[];
        foreach ($this->participantes as $key => $valor){
            if($valor->getCorredor()->getDni()==$corredor->getDni()){
                $participante[]= $valor;
            }
            
        }
        foreach ($participante as $key => $valor) {
            if ($valor->getCarrera()->getFechaCelebracion() < (new DateTime("now"))) {
                $disputadas[] = $valor->getCarrera();
            }
        }
        return $disputadas;
        
    }

    public function findAllCarrerasInscritasCorredor(Corredor $corredor) {
        $disputadas= [];
        $participante=[];
        foreach ($this->participantes as $key => $valor){
            if($valor->getCorredor()->getDni()==$corredor->getDni()){
                $participante[]= $valor;
            }            
        }
        foreach ($participante as $key => $valor) {
            if ($valor->getCarrera()->getFechaCelebracion() >= (new DateTime("now"))) {
                $disputadas[] = $valor->getCarrera();
            }
            
        }
        return $disputadas;
        
    }

    public function findAllParticipacionesCorredoresCarrera() {
        
    }

    public function findAllParticipantesCarrera(Carrera $carrera) {
        $par = [];
        foreach ($this->participantes as $key => $valor) {
            if ($valor->getCarrera()->getId() == $carrera->getId()) {
                $par[] = $valor;
            }
        }
        return $par;
    }

    public function inscribirParticipante(Participante $participante) {
        $this->participantes[] = $participante;
    }

    public function isCorredorInCarrera(Corredor $corredor, Carrera $carrera) {
        foreach ($this->participantes as $key => $valor) {
            if(($valor->getCarrera()==$carrera) and ($valor->getCorredor()==$corredor)){
                return true;
            }
        }
        return false;
    }

    public function updateTiempoCorredorCarrera($corredor, $tiempo) {
        
    }

}
