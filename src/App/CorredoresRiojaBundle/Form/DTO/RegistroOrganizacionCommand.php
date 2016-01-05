<?php

namespace App\CorredoresRiojaBundle\Form\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class RegistroOrganizacionCommand {
    
    /**
     * @Assert\NotBlank() 
     */
    private $Id;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Nombre;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Descripcion;
    
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
    private $Salt;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Slug;
    
    public function getId() {
        return $this->Id;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getEmail() {
        return $this->Email;
    }

    public function getPassword() {
        return $this->Password;
    }

    public function getSalt() {
        return $this->Salt;
    }

    public function getSlug() {
        return $this->Slug;
    }

    public function setId($Id) {
        $this->Id = $Id;
    }

    public function setNombre($Nombre) {
        $this->Nombre = $Nombre;
    }

    public function setDescripcion($Descripcion) {
        $this->Descripcion = $Descripcion;
    }

    public function setEmail($Email) {
        $this->Email = $Email;
    }

    public function setPassword($Password) {
        $this->Password = $Password;
    }

    public function setSalt($Salt) {
        $this->Salt = $Salt;
    }

    public function setSlug($Slug) {
        $this->Slug = $Slug;
    }


}
