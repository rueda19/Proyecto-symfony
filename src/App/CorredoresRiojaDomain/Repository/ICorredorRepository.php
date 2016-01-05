<?php

namespace App\CorredoresRiojaDomain\Repository;
use App\CorredoresRiojaDomain\Model\Corredor;

interface ICorredorRepository {
    
    public function registrarCorredor(Corredor $Corredor);
    public function actualizarCorredor(Corredor $Corredor);
    public function EliminarCorredor(Corredor $Corredor);
    public function BuscarCorredorPorDNI($dni);
    public function BuscarTodos();
}
