<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Participante;
use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Model\Carrera;

interface IParticipanteRepository {
    
    public function IncribirParticipante(Participante $Participante);
    public function BuscarParticipantesDeCarrera(Carrera $Carrera);
    public function BuscarTodas();
    public function BuscarCarrerasDisputadasDeCorredor(Corredor $Corredor);
    public function BuscarCarrerasNoDisputadasDeCorredor(Corredor $Corredor);
    public function EstaCorredorCarrera(Corredor $Corredor, Carrera $Carrera);
    public function ActualizarTiempoCorredorEnCarrera($tiempo, Corredor $Corredor, Carrera $Carrera);
    public function EliminarParticipacion(Participante $Participante);
}
