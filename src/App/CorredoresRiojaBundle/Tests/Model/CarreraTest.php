<?php

namespace App\CorredoresRiojaBundle\Tests\Model;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaDomain\Model\Organizacion;

class CarreraTest extends \PHPUnit_Framework_TestCase{
    
    public function testCrearCarrera()
    {
        $org = new Organizacion(1, "Organizacion1", "Esta es la primera organizacion", "pepe@gmail.com", "pepe");
        
        $carrera = new Carrera(1, "Primera carrera", "Carrera por la rioja, junto a orrillas del rio najerilla", date_create('2015-10-26 11:50'), 50, date_create('2015-10-26'), 30, "/bundles/appcorredoresrioja/images/matutrail.jpg", $org);
        
 
        $this->assertEquals("primera-carrera", $carrera->getSlug());
    }
    
}
