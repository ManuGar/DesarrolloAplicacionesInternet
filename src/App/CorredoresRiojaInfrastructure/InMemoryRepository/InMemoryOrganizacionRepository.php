<?php

namespace App\CorredoresRiojaInfrastructure\InMemoryRepository;

use App\CorredoresRiojaDomain\Repository\IOrganizacionRepository;
use App\CorredoresRiojaDomain\Model\Organizacion;

/**
 * Description of InMemoryOrganizacionRepository
 *
 * @author magarcd
 */
class InMemoryOrganizacionRepository implements IOrganizacionRepository{
    private $organizaciones;
    
    function __construct() {
        $this->organizaciones[]= new Organizacion("1", "org1", "Esta es nuestra primera organizacion", "org1@gmail.com", "1234");
        $this->organizaciones[]= new Organizacion("2", "org2", "Esta es nuestra segunda organizacion", "org2@hotmail.com", "1234");

    }

    public function deleteOrganizacion(Organizacion $organizacion) {
        
    }

    public function findAll() {
        return $this->organizaciones;        
    }

    public function findByEmail($email) {
        
    }

    public function findBySlug($slug) {
        $encontrada;
        foreach ($this->organizaciones as $key => $valor) {
            if ($valor->getSlug($valor->getNombre()) == $valor->getSlug($slug)) {
                return $valor;
            }
        }
        return "No hay ninguna organización con ese slug";
        
    }

    public function regOrganizacion(Organizacion $organizacion) {
        $this->organizaciones[]=$organizacion;
        
    }

    public function updateOrganizacion(Organizacion $organizacion) {
        
    }

    
}
