<?php

namespace App\CorredoresRiojaInfrastructure\Repository;

use App\CorredoresRiojaDomain\Model\Corredor;
use App\CorredoresRiojaDomain\Repository\ICorredorRepository;

class InMemoryCorredorRepository implements ICorredorRepository{
    
    private $corredores;
    
    function __construct() {
        //new \DateTime('1999-07-09')
    //($DNI, $Nombre, $Apellidos, $Email, $Password, $Dirección, $FechaNacimiento)
        $this->corredores[]=new Corredor("111","Ana","Martinez","ana@gmail.com","$2a$12$.8h9g76p.F6NqZqrkS8UpeIN4DOUISA.4qowe7vhWtOfYMyoNJNDy","C/ ddd",date_create('1988-10-26'));
        $this->corredores[]=new Corredor("222","Estela","Miera","estela@gmail.com","$2a$12$1Z.z/eQuFBMKJrJKTmvx0.PC9h2QFORqivHr42qLW3l2KwvZv2r5i","C/ ddd",date_create('1973-5-21'));
        $this->corredores[]=new Corredor("333","Julian","Martinez","julian@gmail.com","$2a$12$3S9UZBPKX676oTZ7qzsWuOx.q85gqlDkg9g/eAVfSzYHNxq0jIZPS","C/ ddd",date_create('1954-10-13'));
        $this->corredores[]=new Corredor("444","Francisco","Suerez","francisco@gmail.com","$2a$04$8CtEIKhqAEsj9J/HCmRRz.m6ZsAWYbfXqHmQeynSAJb3hp1tG8SrO","C/ ddd",date_create('1991-3-23'));
        $this->corredores[]=new Corredor("555","Felix","Simon","felix@gmail.com","felix","C/ ddd",date_create('1944-4-12'));
        $this->corredores[]=new Corredor("666","Luis","Suerez","luis@gmail.com","luis","C/ ddd",date_create('1967-8-15'));
        $this->corredores[]=new Corredor("777","Carles","Puyol","carles@gmail.com","carles","C/ ddd",date_create('1983-6-5'));
        $this->corredores[]=new Corredor("888","Andres","Iniesta","andres@gmail.com","andres","C/ ddd",date_create('1984-6-7'));
        $this->corredores[]=new Corredor("999","Sergio","Busquet","sergio@gmail.com","sergio","C/ ddd",date_create('1966-7-8'));
        $this->corredores[]=new Corredor("101010","Dani","Alves","dani@gmail.com","dani","C/ ddd",date_create('1978-1-9'));
    }
    
    public function registrarCorredor(Corredor $Corredor){
        $this->corredores[]=$Corredor;
    }
    
    public function actualizarCorredor(Corredor $Corredor){
        $correr;
        foreach($this->corredores as $cor){
            if($cor->getDNI()==$Corredor->getDNI()){
                $correr[] = $Corredor;
            }else{
                $correr[] = $cor;
            }
        }
        $this->corredores=$correr;
    }
    
    public function EliminarCorredor(Corredor $Corredor){
        $correr;
        foreach($this->corredores as $cor){
            if(!($cor->getDNI()==$Corredor->getDNI())){
                $correr[] = $cor;
            }
        }
        $this->corredores=$correr;
    }
    
    public function BuscarCorredorPorDNI($dni){
        foreach($this->corredores as $cor){
            if($cor->getDNI()==$dni){
                return $cor;
            }
        }
    }
    
    public function BuscarTodos(){
        return $this->corredores;
    }
    
}
