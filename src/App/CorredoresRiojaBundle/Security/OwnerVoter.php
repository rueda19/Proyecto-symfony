<?php

namespace App\CorredoresRiojaBundle\Security;
use Symfony\Component\Security\Core\Authorization\Voter\AbstractVoter;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use App\CorredoresRiojaBundle\Security\OrganizacionUser;
use Symfony\Component\Security\Core\User\UserInterface;

class OwnerVoter extends AbstractVoter{
        
    const VIEW = 'view';
    const EDIT   = 'edit';
    
    protected function getSupportedAttributes() {
        return array(self::VIEW, self::EDIT);
    }

    protected function getSupportedClasses() {
        return array('App\CorredoresRiojaDomain\Model\Organizacion');
    }

    protected function isGranted($attribute, $post, $user = null) {
        if(!$user instanceof UserInterface){
            return false;
        }
    
        if(!$user instanceof OrganizacionUser){
            throw new \LogicException('El usuario no pertenece ha la clase deseada'); 
        }
        
        switch ($attribute){
            case 'edit':
                if($user->getUsername() == $post->getEmail()){
                    return true;
                }
                
                break;
        }
        
        return false;
    
    }
}
