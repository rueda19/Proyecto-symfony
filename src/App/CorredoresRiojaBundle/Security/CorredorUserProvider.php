<?php

namespace App\CorredoresRiojaBundle\Security;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\CorredoresRiojaBundle\Security\CorredorUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use App\CorredoresRiojaDomain\Repository\ICorredorRepository;

class CorredorUserProvider implements UserProviderInterface{
    
    private $corredoresrepository;
    
    public function __construct(ICorredorRepository $corredoresrepository) {
        $this->corredoresrepository = $corredoresrepository;
    }

    public function loadUserByUsername($username) {
        $userData=  $this->corredoresrepository->BuscarCorredorPorDNI($username);
        if($userData!=null){
            $password=$userData->getPassword();
            $salt=$userData->getSalt();
            return new CorredorUser($username,$password,$salt);
        }
        
        throw new UsernameNotFoundException(sprintf('No existe un usuario con DNI %s',$username));
    }

    public function refreshUser(UserInterface $user) {
     if(!$user instanceof CorredorUser){
         throw  new UnsupportedUserException(sprintf('Instances of "%s" are not supported',  get_class($user)));
     }
     return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class) {
        return $class === 'App\CorredoresRiojaBundle\Security\CorredorUser';
    }

}
