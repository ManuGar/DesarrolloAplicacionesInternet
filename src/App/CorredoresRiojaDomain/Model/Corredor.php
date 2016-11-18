<?php

namespace App\CorredoresRiojaDomain\Model;
use Symfony\Component\Validator\Constraints as Assert;



class Corredor {

    private $dni;
    private $nombre;
    private $apellidos;
    private $email;
    private $password;
    private $salt;
    private $direccion;
    private $fechaNacimiento;

    public function __construct($dni, $nombre, $apellidos, $email, $password, $direccion, $fechaNacimiento) {
        $this->dni = $dni;
        $this->nombre = $nombre;
        $this->apellidos = $apellidos;
        $this->email = $email;
        $this->password = $password;
        $this->salt ="";
        $this->direccion = $direccion;
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApellidos() {
        return $this->apellidos;
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

    public function getDireccion() {
        return $this->direccion;
    }

    public function getFechaNacimiento() {
        return $this->fechaNacimiento;
    }

    public function __toString() {
        return "El corredor es: Nombre\n" . $this->getNombre() . "\nApellidos " . $this->getApellidos() . "\n Dni "
                . $this->getDni();
    }

    /**
     * @Assert\IsTrue(message = "La contraseña no puede ser la misma que tu nombre")
     */
    public function isPasswordLegal() {
        return $this->nombre != $this->password;
    }

    /**
     * @Assert\IsTrue(message = "Tienes que ser mayor de edad para registrarte")
     */
    public function isMayorEdad() {
        $currentyear = getdate()['year'];
        $birthdayyear = ($this->fechaNacimiento->format('Y'));
        $diff_years = ($currentyear - $birthdayyear);
        return $diff_years >= 18;
    }

}
