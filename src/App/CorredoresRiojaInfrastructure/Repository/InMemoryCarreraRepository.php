<?php

namespace App\CorredoresRiojaInfrastructure\Repository;

use App\CorredoresRiojaDomain\Repository\ICarreraRepository;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Organizacion;

class InMemoryCarreraRepository implements ICarreraRepository{
    
    private $carreras;

    function __construct() {
        $org = new Organizacion(1, "Organizacion1", "Esta es la primera organizacion", "pepe@gmail.com", "pepe");
        $org1 = new Organizacion(2, "Organizacion2", "Esta es la segunda organizacion", "david@gmail.com", "david");
        $org2 = new Organizacion(3, "Organizacion3", "Esta es la tercera organizacion", "natalia@gmail.com", "natalia");
        $org3 = new Organizacion(4, "Organizacion4", "Esta es la cuarta organizacion", "esme@gmail.com", "esme");
        $org4 = new Organizacion(5, "Organizacion5", "Esta es la quinta organizacion", "sara@gmail.com", "sara");
        //$or=new App\CorredoresRiojaInfrastructure\Repository\InMemoryOrganizacionRepository();
        //$org1 = $or->BuscarTodas()[0];
        //$org1->getId();
        //$Id, $Nombre, $Descripción, $FechaCelebración, $Distancia, $FechaLímiteInscripción, $NúmeroMáximaParticipantes, $Imagen, $Organizacion
        $this->carreras[] = new Carrera(1, "Primera carrera", "Carrera por la rioja, junto a orrillas del rio najerilla", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        $this->carreras[] = new Carrera(2, "Segundo carrera", "Carrera por los lugares historicos de logroño", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        $this->carreras[] = new Carrera(3, "Tercera carrera", "Carrera por los montes de San millan con vista de los monastereis de yuso y susu", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        $this->carreras[] = new Carrera(4, "Cuarta carrera", "Carrera por los montes de ezcaray, alrededor de las pistas de esqui", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        $this->carreras[] = new Carrera(5, "Quinta carrera", "Carrera desde tobia hasta el monasterio de bobadilla a traves del monte", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org1);
        $this->carreras[] = new Carrera(6, "Sexta carrera", "Carrera por la rioja baja", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org1);
        $this->carreras[] = new Carrera(7, "Septima carrera", "Carrera por enciso, en los alredores del paque de dinosaorios", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org2);
        $this->carreras[] = new Carrera(8, "Octava carrera", "Carrera por los viñedos de cinicero", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org2);
        $this->carreras[] = new Carrera(9, "Novena carrera", "Carrera por el camino de santiago el tramo riojano", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org3);
        $this->carreras[] = new Carrera(10, "Decima carrera", "Carrera por los alrederos de haro", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org4);
    }
    
    public function CrearCarrera(Carrera $Carrera){
        $this->carreras[] = $Carrera;
    }
    
    public function ActualizarCarrera(Carrera $Carrera){
        $carrer=null;
        foreach($this->carreras as $car){
            if($car->getId()==$Carrera->getId()){
                $carrer[] = $Carrera;
            }else{
                $carrer[] = $car;
            }
        }
        $this->carreras=$carrer;
    }
    
    public function EliminarCarrera(Carrera $Carrera){
        $carrer=null;
        foreach($this->carreras as $car){
            if(!($car->getId()==$Carrera->getId())){
                $carrer[] = $car;
            }
        }
        $this->carreras=$carrer;
    }
    
    public function BuscarCarreraPorSlug($Slug){
        foreach($this->carreras as $car){
            if($car->getSlug()==$Slug){
                return $car;
            }
        }
    }
    
    public function BuscarCarrerasDisputadasPorOrganizador(Organizacion $Organizador){
        $carrer=null;
        foreach($this->carreras as $car){
            if(($car->getOrganizacion()->getId()==$Organizador->getId()) && ($car->getFechaCelebración()<date_create())){
                $carrer[]=$car;
            }
        }
        return $carrer;
    }
    
    public function BuscarCarrerasNODisputadasPorOrganizador(Organizacion $Organizador){
        $carrer=null;
        foreach($this->carreras as $car){
            if(($car->getOrganizacion()->getId()==$Organizador->getId()) && ($car->getFechaCelebración()>date_create())){
                $carrer[]=$car;
            }
        }
        return $carrer;
    }
    
    public function CarrerasDisponibles(){
        return $this->carreras;
    }
    
    public function CarrerasDisputadas(){
        $carrer=null;
        foreach($this->carreras as $car){
            if($car->getFechaCelebración()<date_create()){
                $carrer[]=$car;
            }
        }
        return $carrer;
    }
    
    public function CarrerasNoDisputadas(){
        $carrer=null;
        foreach($this->carreras as $car){
            if($car->getFechaCelebración()>date_create()){
                $carrer[]=$car;
            }
        }
        return $carrer;
    }
    
}
