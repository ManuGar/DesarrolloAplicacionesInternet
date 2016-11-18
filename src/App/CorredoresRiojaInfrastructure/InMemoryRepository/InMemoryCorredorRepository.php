<?php

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;

use App\CorredoresRiojaDomain\Repository\ICorredorRepository;
use App\CorredoresRiojaDomain\Model\Corredor;



/**
 * Description of InMemoryCorredorRepository
 *
 * @author magarcd
 */
class InMemoryCorredorRepository implements ICorredorRepository {

    private $corredores;
    
    function __construct() {
        $this -> corredores[] = new Corredor("1234","Pepito", "Gonzalez", "prueba@gmail.com","1234","c/Ninguna parte nº5" , (new \DateTime("now")));
        $this -> corredores[] = new Corredor("234","Manuel", "Garcia", "prueba2@hotmail.com","1234", "avenida de nigún lugar", (new \DateTime("now")));
                
    }

    public function deleteCorredor(Corredor $Corredor) {
        foreach ($this->corredores as $key => $valor) {
            if ($valor->getId() == $Corredor->getId()) {
                unset($this->corredores[$key]);
            }
        }
    }

    public function findAll() {
        return $this->corredores;
    }

    public function buscaCorredor($Dni) {
        foreach ($this->corredores as $key => $valor) {
            if ($valor->getDni() == $Dni) {
                return $valor;
            }
        }        
    }

    public function registraCorredor(Corredor $Corredor) {
        $this->corredores[]=$Corredor;
        
    }

    public function updateCorredor(Corredor $Corredor) {
        foreach ($this->corredores as $key => $valor) {
            if ($valor->getId() == $Corredor->getId()) {
                $this->corredores[$key]=$Corredor;
            }
        }        
    }

}
