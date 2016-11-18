<?php
namespace App\CorredoresRiojaDomain\Model;
use App\CorredoresRiojaDomain\Model\Organizacion;

class Carrera {
    private $id;
    private $fechaCelebracion;
    private $distancia;
    private $fechaLimiteInscripcion;
    private $numeroMaximoParticipantes;
    private $imagen;
    private $slug;
    private $nombre;
    private $descripcion;
    private $organizacion;
    
    public function __construct($id, $nombre, $fechaCelebracion, $distancia, $fechaLimiteInscripcion, 
            $numeroMaximoParticipantes, $imagen, $descripcion,  $organizacion) {
        $this->id = $id;
        $this->fechaCelebracion = $fechaCelebracion;
        $this->distancia = $distancia;
        $this->fechaLimiteInscripcion = $fechaLimiteInscripcion;
        $this->numeroMaximoParticipantes = $numeroMaximoParticipantes;
        $this->imagen = $imagen;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->organizacion= $organizacion;
        $this->slug = $this->getSlug($nombre);
    }

    
    public function getId() {
        return $this->id;
    }
    
    public function getOrganizacion(){
        return $this->organizacion;
    }

    public function getFechaCelebracion() {
        return $this->fechaCelebracion;
    }

    public function getDistancia() {
        return $this->distancia;
    }

    public function getFechaLimiteInscripcion() {
        return $this->fechaLimiteInscripcion;
    }

    public function getNumeroMaximoParticipantes() {
        return $this->numeroMaximoParticipantes;
    }

    public function getImagen() {
        return $this->imagen;
    }

    
    static public function getSlug($cadena, $separador = '-'){
    // Código copiado de http://cubiq.org/the-perfect-php-clean-url-generator
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
    $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
    $slug = strtolower(trim($slug, $separador));
    $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);
    return $slug;
    }


    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }
    
    public function __toString() {
        return "La carrera es: Nombre\n" . $this->getNombre() . "\nDescripción " . $this->getDescripcion();
        
    }
        
}
