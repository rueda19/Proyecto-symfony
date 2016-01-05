<?php

namespace App\CorredoresRiojaBundle\Form\Transformer;
use Symfony\Component\Form\DataTransformerInterface;
use App\CorredoresRiojaBundle\Form\DTO\RegistroOrganizacionCommand;
use App\CorredoresRiojaDomain\Model\Organizacion;
use App\CorredoresRiojaDomain\Repository\IOrganizacionRepository;

class RegistroOrganizacionTransformer  implements DataTransformerInterface{
    
    public function reverseTransform($value) {
        $organizacion = new Organizacion($value->getId(), $value->getNombre(), $value->getDescripcion(), $value->getEmail(), $value->getPassword());
        return $organizacion;
    }

    public function transform($value) {
        if ($value == null){
            return null;
        }
        $registroOrganizacionCommand = new RegistroOrganizacionCommand();
        $registroOrganizacionCommand->setId($value->getId());
        $registroOrganizacionCommand->setNombre($value->getNombre());
        $registroOrganizacionCommand->setDescripcion($value->getDescripción());
        $registroOrganizacionCommand->setEmail($value->getEmail());
        $registroOrganizacionCommand->setPassword($value->getPassword());
        return $registroOrganizacionCommand;
    }

}
