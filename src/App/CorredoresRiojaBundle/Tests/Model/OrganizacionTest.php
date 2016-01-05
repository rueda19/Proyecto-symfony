<?php

namespace App\CorredoresRiojaBundle\Tests\Model;
use App\CorredoresRiojaDomain\Model\Organizacion;

class OrganizacionTest extends \PHPUnit_Framework_TestCase{
    
    public function testCrearOrganizacion()
    {
        $org = new Organizacion(1, "Organizacion1", "Esta es la primera organizacion", "pepe@gmail.com", "pepe");
        
        $this->assertEquals("organizacion1", $org->getSlug());
    }
}
