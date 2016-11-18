<?php

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;

use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Organizacion;
use App\CorredoresRiojaDomain\Repository\ICarreraRepository;
use DateTime;

class InMemoryCarreraRepository implements ICarreraRepository {

    private $carreras;

    function __construct() {
        $org1 = new Organizacion("1", "org1", "Esta es nuestra primera organizacion", "org1@gmail.com", "1234");

        $this->carreras[] = new Carrera("1", "Matutrail", (new \DateTime("2016/11/01 12:11")), 0, (new \DateTime("2016/11/01")), 100, "ur.jpg", "descripcion1", $org1);
        $this->carreras[] = new Carrera("2", "Carrera2", (new \DateTime("2017/07/23 11:11")), 10, (new \DateTime("2017/08/23")), 50, "foto2.jpg", "descripcion2", $org1);
        $this->carreras[] = new Carrera("3", "CarreraUR", (new \DateTime("2016/09/20 12:09")), 0, (new \DateTime("2016/09/23 12:09")), 50, "foto2.jpg", "descripcion2", $org1);
        $this->carreras[] = new Carrera("4", "CarreraPrueba", (new \DateTime("2018/07/23 12:12")), 10, (new \DateTime("2018/08/23")), 50, "foto2.jpg", "descripcion de prueba", $org1);

        
        
    }

    public function deleteCarrera(Carrera $carrera) {
        foreach ($this->carreras as $key => $valor) {
            if ($valor->getId() == $carrera->getId()) {
                unset($this->carreras[$key]);
            }
        }
    }

    public function findAll() {
        return $this->carreras;
    }

    public function findByOrgDisputadas(Organizacion $org) {
        $disputadas= [];
        foreach ($this->carreras as $key => $valor) {
            if ($valor->getOrganizacion()->getId() == $org->getId() and $valor->getFechaCelebracion() < (new DateTime("now"))) {
                $disputadas[] = $valor;
            }
        }
        return $disputadas;
    }

    public function findByOrgNoDisputadas(Organizacion $org) {
        $disputadas=[];
        foreach ($this->carreras as $key => $valor) {
            if ($valor->getOrganizacion()->getId() == $org->getId() and ($valor->getFechaCelebracion() >= (new DateTime("now")))) {
                $disputadas[] = $valor;
            }
        }
        return $disputadas;
    }

    public function findBySlug($slug) {
        $encontrada;
        foreach ($this->carreras as $key => $valor) {
            if ($valor->getSlug($valor->getNombre()) == $valor->getSlug($slug)) {
                return $valor;
            }
        }
        return "No hay ninguna carrera con ese slug";
    }

    public function findCarrerasDisputadas() {
        $disputadas = [];
        foreach ($this->carreras as $key => $valor) {
            if ($valor->getFechaCelebracion() < (new DateTime('now'))) {
                $disputadas[] = $valor;
            }
        }
        return $disputadas;
    }

    public function findCarrerasNoDisputadas() {
        $noDisputadas = [];
        $today = new DateTime('now');
        foreach ($this->carreras as $valor) {
            $temp = $valor->getFechaCelebracion();
            if ($temp >= $today) {
                $noDisputadas[] = $valor;
            } 
        }
        return $noDisputadas;
    }

    public function newCarrera($id, $nom, $fecCele, $dis, $fechLimIns, $NumMaxPart, $img, $des, Organizacion $org) {
                $this->carreras[] = new Carrera($id, $nom, $fecCele, $dis, $fechLimIns, $NumMaxPart, $img, $des, $org);
    }

    public function updateCarrera(Carrera $carrera) {
        
    }

//put your code here
}
