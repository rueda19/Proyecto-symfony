<?php

namespace App\CorredoresRiojaBundle\Form\Transformer;
use Symfony\Component\Form\DataTransformerInterface;
use App\CorredoresRiojaBundle\Form\DTO\RegistroCorredorCommand;
use App\CorredoresRiojaDomain\Model\Corredor;

class RegistroCorredorTransformer implements DataTransformerInterface{
    
    public function reverseTransform($value) {
        $corredor = new Corredor($value->getDNI(), $value->getNombre(), $value->getApellidos(), $value->getEmail(), $value->getPassword(), $value->getDireccion(), $value->getFechaNacimiento());
        return $corredor;
        
    }

    public function transform($value) {
        if ($value == null){
            return null;
        }
        $registroCorredorCommand = new RegistroCorredorCommand();
        $registroCorredorCommand->setDNI($value->getDNI());
        $registroCorredorCommand->setNombre($value->getNombre());
        $registroCorredorCommand->setApellidos($value->getApellidos());
        $registroCorredorCommand->setEmail($value->getEmail());
        $registroCorredorCommand->setPassword($value->getPassword());
        $registroCorredorCommand->setDireccion($value->getDireccion());
        $registroCorredorCommand->setFechaNacimiento($value->getFechaNacimiento());
        return $registroCorredorCommand;
    }

}
