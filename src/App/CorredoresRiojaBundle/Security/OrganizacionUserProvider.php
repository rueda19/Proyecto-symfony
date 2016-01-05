<?php

namespace App\CorredoresRiojaBundle\Security;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\CorredoresRiojaBundle\Security\OrganizacionUser;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use App\CorredoresRiojaDomain\Repository\IOrganizacionRepository;

class OrganizacionUserProvider implements UserProviderInterface{
    
    private $organizacionesrepository;
    
    public function __construct(IOrganizacionRepository $organizacionesrepository) {
        $this->organizacionesrepository = $organizacionesrepository;
    }

    public function loadUserByUsername($username) {
        $userData=  $this->organizacionesrepository->BuscarOrganizacionPorEmail($username);
        if($userData!=null){
            $password=$userData->getPassword();
            $salt=$userData->getSalt();
            return new OrganizacionUser($username,$password,$salt);
        }
        
        throw new UsernameNotFoundException(sprintf('No existe un organizador con Email %s',$username));
    }

    public function refreshUser(UserInterface $user) {
     if(!$user instanceof OrganizacionUser){
         throw  new UnsupportedUserException(sprintf('Instances of "%s" are not supported',  get_class($user)));
     }
     return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class) {
        return $class === 'App\CorredoresRiojaBundle\Security\OrganizacionUser';
    }

}
