<?php

namespace App\CorredoresRiojaBundle\Form\Transformer;
use Symfony\Component\Form\DataTransformerInterface;
use App\CorredoresRiojaBundle\Form\DTO\RegistroCarreraCommand;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaInfrastructure\Repository\InMemoryOrganizacionRepository;

class RegistroCarreraTransformer implements DataTransformerInterface{
    
    public function reverseTransform($value) {
        //$orgEmail = $this->get('security.token_storage')->getToken()->getUser();
        $organizaciones = new InMemoryOrganizacionRepository();
        $org = $organizaciones->BuscarOrganizacionPorEmail("pepe@gmail.com");
        $carrera = new Carrera($value->getId(), $value->getNombre(), $value->getDescripcion(), $value->getFechaCelebracion(), $value->getDistancia(), $value->getFechaLimiteInscripcion(), $value->getNumeroMaximaParticipantes(), $value->getImagen(), $org);
        return $carrera;
    }

    public function transform($value) {
        if ($value == null){
            return null;
        }
        $registroOrganizacionCommand = new RegistroCarreraCommand();
        $registroOrganizacionCommand->setId($value->getId());
        $registroOrganizacionCommand->setNombre($value->getNombre());
        $registroOrganizacionCommand->setDescripcion($value->getDescripción());
        $registroOrganizacionCommand->setDistancia($value->getDistancia());
        $registroOrganizacionCommand->setFechaCelebracion($value->getFechaCelebración());
        $registroOrganizacionCommand->setNumeroMaximaParticipantes($value->getNúmeroMáximaParticipantes());
        $registroOrganizacionCommand->setImagen($value->getImagen());
        return $registroOrganizacionCommand;
    }

}
