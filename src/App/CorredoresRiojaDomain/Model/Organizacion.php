<?php

namespace App\CorredoresRiojaDomain\Model;
use App\CorredoresRiojaDomain\Model\Auxiliar;
use Symfony\Component\Validator\Constraints as Assert;

class Organizacion {
    private $Id;
    private $Nombre;
    private $Descripción;
    private $Email;
    private $Password;
    private $Salt;
    private $Slug;
    
    function __construct($Id, $Nombre, $Descripción, $Email, $Password) {
        $this->Id = $Id;
        $this->Nombre = $Nombre;
        $this->Descripción = $Descripción;
        $this->Email = $Email;
        $this->Password = $Password;
        $this->Salt = md5(time());
        $this->Slug = Auxiliar::getSlug($Nombre);
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

    function getEmail() {
        return $this->Email;
    }

    function getPassword() {
        return $this->Password;
    }

    function getSalt() {
        return $this->Salt;
    }

    function getSlug() {
        return $this->Slug;
    }

    /**
     * @Assert\True(message="La Contraseña no puede ser la misma que tu nombre")
     */
    public function isPasswordLegal() {
        return $this->Nombre!=$this->Password;
    }
    
    public function saveEncodedPassword($password) {
        $this->Password=$password;
    }
}
