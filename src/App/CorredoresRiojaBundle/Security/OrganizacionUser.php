<?php

namespace App\CorredoresRiojaBundle\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\EquatableInterface;

class OrganizacionUser implements UserInterface, EquatableInterface{
    
    private $username;
    private $password;
    private $salt;
    private $roles;
    
    public function __construct($username, $password, $salt) {
        $this->username = $username;
        $this->password = $password;
        $this->salt = $salt;
        $this->roles = array('ROLE_ORGANIZACION');
    }

    public function eraseCredentials() {}

    public function getPassword() {
        return $this->password;
    }

    public function getRoles() {
        return array('ROLE_ORGANIZACION');
    }

    public function getSalt() {
        return $this->salt;
    }

    public function isEqualTo(UserInterface $user) {
        if(!$user instanceof OrganizacionUser || 
                $this->password !== $user->getPassword() || 
                $this->salt !== $user->getSalt() || 
                $this->username !== $user->getUsername()){
            return false;
        }
        return true;
    }

    public function getUsername() {
        return $this->username;
    }

}
