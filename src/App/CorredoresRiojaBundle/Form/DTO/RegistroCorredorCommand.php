<?php

namespace App\CorredoresRiojaBundle\Form\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class RegistroCorredorCommand {
    
    
    /**
     * @Assert\NotBlank() 
     */
    private $Nombre;
    
    /**
     * @Assert\NotBlank() 
     */
    private $DNI;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Apellidos;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Email() 
     */
    private $Email;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Password;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Direccion;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Date() 
     */
    private $FechaNacimiento;
    
    public function getDNI() {
        return $this->DNI;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getApellidos() {
        return $this->Apellidos;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function getDireccion() {
        return $this->Direccion;
    }

    public function getFechaNacimiento() {
        return $this->FechaNacimiento;
    }

    public function setDNI($DNI) {
        $this->DNI = $DNI;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setApellidos($Apellidos) {
        $this->Apellidos = $Apellidos;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    public function setDireccion($Direccion) {
        $this->Direccion = $Direccion;
    }

    public function setFechaNacimiento($FechaNacimiento) {
        $this->FechaNacimiento = $FechaNacimiento;
    }


}
