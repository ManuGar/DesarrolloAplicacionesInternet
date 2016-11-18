<?php
namespace App\CorredoresRiojaDomain\Model;

class Organizacion {
    private $id;
    private $nombre;
    private $descripcion;
    private $email;
    private $password;
    private $salt;
    private $slug;
    
    
    function __construct($id, $nombre, $descripcion, $email, $password) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->email = $email;
        $this->password = $password;
        $this->salt=md5(time());
        $this->slug = $this->getSlug($nombre);
    }
    

    
    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    
    static public function getSlug($cadena, $separador = '-'){
    // Código copiado de http://cubiq.org/the-perfect-php-clean-url-generator
    $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $cadena);
    $slug = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $slug);
    $slug = strtolower(trim($slug, $separador));
    $slug = preg_replace("/[\/_|+ -]+/", $separador, $slug);
    return $slug;
    }
    
    public function __toString() {
        return "La organización es: Nombre\n" . $this->getNombre() . "\nDescripción " . $this->getDescripcion();}
}
