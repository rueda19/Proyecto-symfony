<?php

namespace App\CorredoresRiojaDomain\Model;
use Symfony\Component\Validator\Constraints as Assert;

class Corredor {
    private $DNI;
    private $Nombre;
    private $Apellidos;
    private $Email;
    private $Password;
    private $Salt;
    private $Direccion;
    private $FechaNacimiento;
    
    function __construct($DNI, $Nombre, $Apellidos, $Email, $Password, $Direccion, $FechaNacimiento) {
        $this->DNI = $DNI;
        $this->Nombre = $Nombre;
        $this->Apellidos = $Apellidos;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Salt = md5(time());
        $this->Direccion = $Direccion;
        $this->FechaNacimiento = $FechaNacimiento;
    }

    function getDNI() {
        return $this->DNI;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getApellidos() {
        return $this->Apellidos;
    }

    function getEmail() {
        return $this->Email;
    }

    function getPassword() {
        return $this->Password;
    }

    function getSalt() {
        return $this->Salt;
    }

    function getDireccion() {
        return $this->Direccion;
    }

    function getFechaNacimiento() {
        return $this->FechaNacimiento;
    }

    /**
     * @Assert\True(message="La Contraseña no puede ser la misma que tu nombre")
     */
    public function isPasswordLegal() {
        return $this->Nombre!=$this->Password;
    }
    
    /**
     * @Assert\True(message="Tienes que ser mayor de edad para registrarte")
     */
    public function isMayoyEdad() {
        $currentYear = getdate()['year'];
        $birthdayyear = ($this->FechaNacimiento->format('Y'));
        $diff_year = ($currentYear - $birthdayyear);
        return $diff_year >= 18;
    }
    
    public function saveEncodedPassword($password) {
        $this->Password=$password;
    }
}
