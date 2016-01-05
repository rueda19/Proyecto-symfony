<?php

namespace App\CorredoresRiojaDomain\Repository;

use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Organizacion;

interface ICarreraRepository {
    
    public function CrearCarrera(Carrera $Carrera);
    public function ActualizarCarrera(Carrera $Carrera);
    public function EliminarCarrera(Carrera $Carrera);
    public function BuscarCarreraPorSlug($Slug);
    public function BuscarCarrerasDisputadasPorOrganizador(Organizacion $Organizador);
    public function BuscarCarrerasNODisputadasPorOrganizador(Organizacion $Organizador);
    public function CarrerasDisponibles();
    public function CarrerasDisputadas();
    public function CarrerasNoDisputadas();
}
