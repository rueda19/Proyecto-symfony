<?php

namespace App\CorredoresRiojaInfrastructure\Repository;

use App\CorredoresRiojaDomain\Model\Participante;
use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Organizacion;
use App\CorredoresRiojaDomain\Repository\IParticipanteRepository;

class InMemoryParticipanteRepository implements IParticipanteRepository{
    private $participantes;
    
    public function __construct() {
        $corredores1=new Corredor("111","Ana","Martinez","ana@gmail.com","ana","C/ ddd",date_create('1988-10-26'));
        $corredores2=new Corredor("222","Estela","Miera","estela@gmail.com","estela","C/ ddd",date_create('1973-5-21'));
        $corredores3=new Corredor("333","Julian","Martinez","julian@gmail.com","julian","C/ ddd",date_create('1954-10-13'));
        $corredores4=new Corredor("444","Francisco","Suerez","francisco@gmail.com","francisco","C/ ddd",date_create('1991-3-23'));
        $corredores5=new Corredor("555","Felix","Simon","felix@gmail.com","felix","C/ ddd",date_create('1944-4-12'));
        $corredores6=new Corredor("666","Luis","Suerez","luis@gmail.com","luis","C/ ddd",date_create('1967-8-15'));
        $corredores7=new Corredor("777","Carles","Puyol","carles@gmail.com","carles","C/ ddd",date_create('1983-6-5'));
        $corredores8=new Corredor("888","Andres","Iniesta","andres@gmail.com","andres","C/ ddd",date_create('1984-6-7'));
        $corredores9=new Corredor("999","Sergio","Busquet","sergio@gmail.com","sergio","C/ ddd",date_create('1966-7-8'));
        $corredores10=new Corredor("101010","Dani","Alves","dani@gmail.com","dani","C/ ddd",date_create('1978-1-9'));
        
        $org = new Organizacion(1, "Organizacion1", "Esta es la primera organizacion", "pepe@gmail.com", "pepe");
        $org1 = new Organizacion(2, "Organizacion2", "Esta es la segunda organizacion", "david@gmail.com", "david");
        $org2 = new Organizacion(3, "Organizacion3", "Esta es la tercera organizacion", "natalia@gmail.com", "natalia");
        $org3 = new Organizacion(4, "Organizacion4", "Esta es la cuarta organizacion", "esme@gmail.com", "esme");
        $org4 = new Organizacion(5, "Organizacion5", "Esta es la quinta organizacion", "sara@gmail.com", "sara");
        
        $carrera1 = new Carrera(1, "Primera carrera", "Carrera por la rioja, junto a orrillas del rio najerilla", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        $carrera2 = new Carrera(2, "Segundo carrera", "Carrera por los lugares historicos de logroño", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        $carrera3 = new Carrera(3, "Tercera carrera", "Carrera por los montes de San millan con vista de los monastereis de yuso y susu", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        $carrera4 = new Carrera(4, "Cuarta carrera", "Carrera por los montes de ezcaray, alrededor de las pistas de esqui", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        $carrera5 = new Carrera(5, "Quinta carrera", "Carrera desde tobia hasta el monasterio de bobadilla a traves del monte", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org1);
        $carrera6 = new Carrera(6, "Sexta carrera", "Carrera por la rioja baja", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org1);
        $carrera7 = new Carrera(7, "Septima carrera", "Carrera por enciso, en los alredores del paque de dinosaorios", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org2);
        $carrera8 = new Carrera(8, "Octava carrera", "Carrera por los viñedos de cinicero", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org2);
        $carrera9 = new Carrera(9, "Novena carrera", "Carrera por el camino de santiago el tramo riojano", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org3);
        $carrera10 = new Carrera(10, "Decima carrera", "Carrera por los alrederos de haro", date_create('2016-11-15 15:00'), 50, date_create('2016-11-15'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org4);
    
        //$dorsal, $tiempo, $Corredor, $Carrera
        $this->participantes[] = new Participante("1",120,$corredores1,$carrera1);
        $this->participantes[] = new Participante("2",133,$corredores3,$carrera1);
        $this->participantes[] = new Participante("1",99,$corredores4,$carrera1);
        $this->participantes[] = new Participante("1",80,$corredores5,$carrera1);
        $this->participantes[] = new Participante("1",70,$corredores1,$carrera2);
        $this->participantes[] = new Participante("1",55,$corredores2,$carrera2);
        $this->participantes[] = new Participante("1",144,$corredores3,$carrera2);
        $this->participantes[] = new Participante("1",155,$corredores1,$carrera3);
        $this->participantes[] = new Participante("1",166,$corredores7,$carrera3);
        $this->participantes[] = new Participante("1",130,$corredores3,$carrera4);
        $this->participantes[] = new Participante("1",140,$corredores1,$carrera4);
        $this->participantes[] = new Participante("1",150,$corredores5,$carrera5);
        $this->participantes[] = new Participante("1",200,$corredores1,$carrera5);
        $this->participantes[] = new Participante("1",220,$corredores6,$carrera6);
        $this->participantes[] = new Participante("1",100,$corredores1,$carrera6);
        
        
        
    }

    public function IncribirParticipante(Participante $Participante){
        $this->participantes[]=$Participante;
    }
    
    public function BuscarParticipantesDeCarrera(Carrera $Carrera){
        $parti=null;
        foreach ($this->participantes as $par){
            if($par->getCarrera()->getId() == $Carrera->getId()){
                $parti[]=$par;
            }
        }
        return $parti;
    }
    
    public function BuscarTodas(){
        return $this->participantes;
    }
    
    public function BuscarCarrerasDisputadasDeCorredor(Corredor $Corredor){
        $carrer=null;
        foreach ($this->participantes as $par){
            if($par->getCorredor()->getDNI()==$Corredor->getDNI() && $par->getCarrera()->getFechaCelebración()<date_create()){
                $carrer[]=$par->getCarrera();
            }
        }
        return $carrer;
    }
    
    public function BuscarCarrerasNoDisputadasDeCorredor(Corredor $Corredor){
        $carrer=null;
        foreach ($this->participantes as $par){
            if($par->getCorredor()->getDNI()==$Corredor->getDNI() && $par->getCarrera()->getFechaCelebración()>date_create()){
                $carrer[]=$par->getCarrera();
            }
        }
        return $carrer;
    }
    
    public function EstaCorredorCarrera(Corredor $Corredor, Carrera $Carrera){
        foreach ($this->participantes as $par){
            if($par->getCorredor()->getDNI()==$Corredor->getDNI() && $par->getCarrera()->getId()==$Carrera->getId()){
                return true;
            }
        }
        return false;
    }
    
    public function ActualizarTiempoCorredorEnCarrera($tiempo, Corredor $Corredor, Carrera $Carrera){
        $parti=null;
        foreach ($this->participantes as $par){
            if($par->getCorredor()->getDNI()==$Corredor->getDNI() && $par->getCarrera()->getId()==$Carrera->getId()){
                $parti[]=new Participante($par->getDorsal(), $tiempo, $par->getCorredor(), $par->getCarrera());
            }else{
                $parti[]=$par;
            }
        }
    }
    
    public function EliminarParticipacion(Participante $Participante){
        $parti=null;
        foreach ($this->participantes as $par){
            if(!($par->getCorredor()->getDNI()==$Participante->getCorredor()->getDNI() && $par->getCarrera()->getId()==$Participante->getCarrera()->getId())){
                $parti[]=$par;
            }
        }
        $this->participantes=$parti;
    }
}
