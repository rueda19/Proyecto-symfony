<?php

namespace App\CorredoresRiojaDomain\Model;

class Participante {
    private $dorsal;
    private $tiempo;
    private $Corredor;
    private $Carrera;
    
    function __construct($dorsal, $tiempo, $Corredor, $Carrera) {
        $this->dorsal = $dorsal;
        $this->tiempo = $tiempo;
        $this->Corredor = $Corredor;
        $this->Carrera = $Carrera;
    }

        function getDorsal() {
        return $this->dorsal;
    }

    function getTiempo() {
        return $this->tiempo;
    }
    
    function getCorredor() {
        return $this->Corredor;
    }

    function getCarrera() {
        return $this->Carrera;
    }

}
