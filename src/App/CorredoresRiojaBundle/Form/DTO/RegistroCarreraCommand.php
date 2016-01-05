<?php

namespace App\CorredoresRiojaBundle\Form\DTO;
use Symfony\Component\Validator\Constraints as Assert;

class RegistroCarreraCommand {
    
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
     * @Assert\Date() 
     */
    private $FechaCelebracion;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Distancia;
    
    /**
     * @Assert\NotBlank()
     * @Assert\Date()  
     */
    private $FechaLimiteInscripcion;
    
    /**
     * @Assert\NotBlank() 
     */
    private $NumeroMaximaParticipantes;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Imagen;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Slug;
    
    /**
     * @Assert\NotBlank() 
     */
    private $Organizacion;
    
    public function getId() {
        return $this->Id;
    }

    public function getNombre() {
        return $this->Nombre;
    }

    public function getDescripcion() {
        return $this->Descripcion;
    }

    public function getFechaCelebracion() {
        return $this->FechaCelebracion;
    }

    public function getDistancia() {
        return $this->Distancia;
    }

    public function getFechaLimiteInscripcion() {
        return $this->FechaLimiteInscripcion;
    }

    public function getNumeroMaximaParticipantes() {
        return $this->NumeroMaximaParticipantes;
    }

    public function getImagen() {
        return $this->Imagen;
    }

    public function getSlug() {
        return $this->Slug;
    }

    public function getOrganizacion() {
        return $this->Organizacion;
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

    public function setFechaCelebracion($FechaCelebracion) {
        $this->FechaCelebracion = $FechaCelebracion;
    }

    public function setDistancia($Distancia) {
        $this->Distancia = $Distancia;
    }

    public function setFechaLimiteInscripcion($FechaLimiteInscripcion) {
        $this->FechaLimiteInscripcion = $FechaLimiteInscripcion;
    }

    public function setNumeroMaximaParticipantes($NumeroMaximaParticipantes) {
        $this->NumeroMaximaParticipantes = $NumeroMaximaParticipantes;
    }

    public function setImagen($Imagen) {
        $this->Imagen = $Imagen;
    }

    public function setSlug($Slug) {
        $this->Slug = $Slug;
    }

    public function setOrganizacion($Organizacion) {
        $this->Organizacion = $Organizacion;
    }


}
