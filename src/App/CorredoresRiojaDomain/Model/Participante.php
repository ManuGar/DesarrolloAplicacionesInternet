<?php
namespace App\CorredoresRiojaDomain\Model;
use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Model\Carrera;


class Participante {
    private $dorsal;
    private $tiempo;
    private $corredor;
    private $carrera;
    
    public function __construct($dorsal, $tiempo,  Corredor $corredor,Carrera $carrera) {
        $this->dorsal = $dorsal;
        $this->tiempo = $tiempo;
        $this->corredor = $corredor;
        $this->carrera = $carrera;
    }

    
    public function getDorsal() {
        return $this->dorsal;
    }

    public function getTiempo() {
        return $this->tiempo;
    }
    function getCorredor() {
        return $this->corredor;
    }

    function getCarrera() {
        return $this->carrera;
    }




}
