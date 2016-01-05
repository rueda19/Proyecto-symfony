<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Organizacion;

interface IOrganizacionRepository {
    
    public function RegistrarOrganizacion(Organizacion $Organizacion);
    public function ActualizarOrganizacion(Organizacion $Organizacion);
    public function EliminarOrganizacion(Organizacion $Organizacion);
    public function BuscarOrganizacionPorSlug($Slug);
    public function BuscarOrganizacionPorEmail($Email);
    public function BuscarTodas();
}
