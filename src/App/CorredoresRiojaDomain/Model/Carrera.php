<?php

namespace App\CorredoresRiojaDomain\Model;
use App\CorredoresRiojaDomain\Model\Auxiliar;
use Symfony\Component\Validator\Constraints as Assert;

class Carrera {
    
    private $Id;
    private $Nombre;
    private $Descripción;
    private $FechaCelebración;
    private $Distancia;
    private $FechaLímiteInscripción;
    private $NúmeroMáximaParticipantes;
    private $Imagen;
    private $Slug;
    private $Organizacion;
                
    function __construct($Id, $Nombre, $Descripción, $FechaCelebración, $Distancia, $FechaLímiteInscripción, $NúmeroMáximaParticipantes, $Imagen, $Organizacion) {
        $this->Id = $Id;
        $this->Nombre = $Nombre;
        $this->Descripción = $Descripción;
        $this->FechaCelebración = $FechaCelebración;
        $this->Distancia = $Distancia;
        $this->FechaLímiteInscripción = $FechaLímiteInscripción;
        $this->NúmeroMáximaParticipantes = $NúmeroMáximaParticipantes;
        $this->Imagen = $Imagen;
        $this->Slug = Auxiliar::getSlug($Nombre);
        $this->Organizacion = $Organizacion;
    }
    
    function getId() {
        return $this->Id;
    }

    function getNombre() {
        return $this->Nombre;
    }

    function getDescripción() {
        return $this->Descripción;
    }

    function getFechaCelebración() {
        return $this->FechaCelebración;
    }

    function getDistancia() {
        return $this->Distancia;
    }

    function getFechaLímiteInscripción() {
        return $this->FechaLímiteInscripción;
    }

    function getNúmeroMáximaParticipantes() {
        return $this->NúmeroMáximaParticipantes;
    }

    function getImagen() {
        return $this->Imagen;
    }

    public function getOrganizacion() {
        return $this->Organizacion;
    }
    
    public function getSlug() {
        return $this->Slug;
    }

    /**
     * @Assert\True(message="La fecha de inscripcion tiene que ser a partir de hoy en adelante")
     */
    public function isFechaInscripcionCorrecta() {
        return $this->FechaLímiteInscripción>date_create();
    }
    
    /**
     * @Assert\True(message="La fecha de celebracion tiene que ser despues de la de inscripcion")
     */
    public function isFechaCelebracionCorrecta() {
        return $this->FechaCelebración>$this->FechaLímiteInscripción;
    }
}
