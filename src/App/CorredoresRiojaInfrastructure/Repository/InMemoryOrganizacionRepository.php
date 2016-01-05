<?php

namespace App\CorredoresRiojaInfrastructure\Repository;

use App\CorredoresRiojaDomain\Model\Organizacion;
use App\CorredoresRiojaDomain\Repository\IOrganizacionRepository;

class InMemoryOrganizacionRepository implements IOrganizacionRepository{
    private $organizaciones;
    
    function __construct() {
        $this->organizaciones[] = new Organizacion(1, "Organizacion1", "Esta es la primera organizacion", "pepe@gmail.com", "$2a$12$3y4LizU0ygaKQCXemahyCOwrmktf95pG27aCkz1Kn0Suzi3XvzL52");
        $this->organizaciones[] = new Organizacion(2, "Organizacion2", "Esta es la segunda organizacion", "david@gmail.com", "$2a$12$4M.z/2QZBMSwWd7PuiqK8uTUQN66//v0rUk9eTPJQ4lrmoHZh4kTy");
        $this->organizaciones[] = new Organizacion(3, "Organizacion3", "Esta es la tercera organizacion", "natalia@gmail.com", "$2a$12$1iILp0jZ9XhViSvTbsclAeNZbNY5QFsAcVIpIos7ilvOFc8UTPG/2");
        $this->organizaciones[] = new Organizacion(4, "Organizacion4", "Esta es la cuarta organizacion", "esme@gmail.com", "esme");
        $this->organizaciones[] = new Organizacion(5, "Organizacion5", "Esta es la quinta organizacion", "sara@gmail.com", "sara");
        
    }
    
    public function RegistrarOrganizacion(Organizacion $Organizacion){
        $this->organizaciones[]=  $Organizacion;
    }
    
    public function ActualizarOrganizacion(Organizacion $Organizacion){
        $organ=null;
        foreach ($this->organizaciones as $org){
            if($org->getId()==$Organizacion->getId()){
                $organ[]=$Organizacion;
            }  else {
                $organ[]=$org;
            }
        }            
    }
    
    public function EliminarOrganizacion(Organizacion $Organizacion){
        $organ=null;
        foreach ($this->organizaciones as $org){
            if(!($org->getId()==$Organizacion->getId())){
                $organ[]=$org;
            }
        } 
    }
    
    public function BuscarOrganizacionPorSlug($Slug){
        foreach ($this->organizaciones as $org){
            if($org->getSlug()==$Slug){
                return $org;
            }
        }  
    }
    
    public function BuscarOrganizacionPorEmail($Email){
        foreach ($this->organizaciones as $org){
            if($org->getEmail()==$Email){
                return $org;
            }
        } 
    }
    
    public function BuscarTodas(){
        $this->organizaciones;
    }
}
