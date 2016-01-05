<?php

namespace App\CorredoresRiojaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use App\CorredoresRiojaDomain\Model\Carrera;
use App\CorredoresRiojaBundle\Form;
use Symfony\Component\HttpFoundation\Request;
use App\CorredoresRiojaBundle\Form\CorredorType;
use App\CorredoresRiojaBundle\Form\CorredorPerfilType;
use App\CorredoresRiojaDomain\Model\Participante;

class corredoresController extends Controller{
    
    public function indexAction()
    {
        return $this->render("AppCorredoresRiojaBundle:Corredores:portada.html.twig");
    }
    
    public function showCarrerasAction()
    {
        $carrerasDis = $this -> get('carreras') -> CarrerasDisputadas();
        
        $carrerasNoDis = $this -> get('carreras') -> CarrerasNoDisputadas();
        
        return $this->render("AppCorredoresRiojaBundle:Corredores:carreras.html.twig",array('carrerasNoDis'=>$carrerasNoDis,'carrerasDis'=>$carrerasDis));
        //return $this->render("AppCorredoresRiojaBundle:Corredores:carreras.html.twig");
    }
    
    public function showCarreraSlugAction($slug)
    {
        $carrera = $this -> get('carreras') -> BuscarCarreraPorSlug($slug);//$corredores = $this -> get('carreras') -> CarrerasDisponibles();
        //$carrera = $this -> get('carreras') -> BuscarCarreraPorSlug($slug);
        $estaDisponible = false;
        if($carrera!=null && $carrera->getFechaLímiteInscripción()>date_create()){
            $estaDisponible = true;
            $participantes = $this -> get('participantes') -> BuscarParticipantesDeCarrera($carrera);
            return $this->render("AppCorredoresRiojaBundle:Corredores:carrera.html.twig",array('carrera'=>$carrera,'estaDisponible'=>$estaDisponible,'participantes'=>$participantes));
        }else{
            return $this->render("AppCorredoresRiojaBundle:Corredores:carrera.html.twig",array('carrera'=>$carrera,'estaDisponible'=>$estaDisponible));
        }//return new Response($carrera->getOrganizacion()->getId());//Id());
    }
    
    public function showOrganizacionSlugAction($slug)
    {
        $organizacion = $this -> get('organizaciones') -> BuscarOrganizacionPorSlug($slug);//$corredores = $this -> get('carreras') -> CarrerasDisponibles();
        $carreras = null;
        if($organizacion!=null)
        {
            $carreras = $this -> get('carreras') -> BuscarCarrerasNODisputadasPorOrganizador($organizacion);
        }
        return $this->render("AppCorredoresRiojaBundle:Corredores:organizacion.html.twig",array('organizacion'=>$organizacion,'carreras'=>$carreras));
        //return new Response($organizacion->getId());
    }
    
    public function registroAction() {
        $peticion = $this->getRequest();
        $form = $this->createForm(new CorredorType);
        $form ->handleRequest($peticion);
        if($form->isValid()){
            //Recogemos el corredor que se ha registrado
            $corredor = $form->getData();
            //Codificamos la contraseña del corredor
            $encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
            $password = $encoder->encodePassword($corredor->getPassword(),$corredor->getSalt());
            $corredor->saveEncodedPassword($password);
            //Lo almacenamos en nuestro repositorio de corredores
            $this->get('corredoresrepository')->registrarCorredor($corredor);
            //Creamos un mensaje flash para mostrar al usuario que se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info','!Enhorabuena, '. $corredor->getNombre() . ' te has registrado en Corredores por la Rioja!');
            //Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('app_corredores_rioja_homepage'));
        }
        return $this->render("AppCorredoresRiojaBundle:Corredores:registro.html.twig",array('formulario'=>$form->createView()));
    }
    
    public function loginAction(Request $request){
        $authenticationsUtils = $this->get('security.authentication_utils');
        
        $error =  $authenticationsUtils->getLastAuthenticationError();
        
        $lastUsername = $authenticationsUtils->getLastUsername();
        
        return $this->render('AppCorredoresRiojaBundle:Corredores:login.html.twig',array('last_username'=> $lastUsername,'error'=>$error));
    }
    
    public function miscarrerasAction(){
        /*if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            throw $this->createAccessDeniedException();
        }*/
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $corredor = $this -> get('corredoresrepository') -> BuscarCorredorPorDNI($user->getUsername());
        
        $carrerasDis = $this -> get('participantes') -> BuscarCarrerasDisputadasDeCorredor($corredor);
        
        $carrerasNoDis = $this -> get('participantes') -> BuscarCarrerasNoDisputadasDeCorredor($corredor);
        
        return $this->render("AppCorredoresRiojaBundle:Corredores:miscarreras.html.twig",array('carrerasNoDis'=>$carrerasNoDis,'carrerasDis'=>$carrerasDis,'nombre'=>$corredor->getNombre()));
        
        /*if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            throw $this->createAccessDeniedException();
        }
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
                
        return $this->render("AppCorredoresRiojaBundle:Corredores:miscarreras.html.twig",array('user'=>$user->getUsername()));*/
    }
    
    public function perfilAction() {
        $peticion = $this->getRequest();
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $corredor = $this -> get('corredoresrepository') -> BuscarCorredorPorDNI($user->getUsername());
        
        $form = $this->createForm(new CorredorPerfilType,$corredor);
        $form ->handleRequest($peticion);
        if($form->isValid()){
            //Recogemos el corredor que se ha registrado
            $corredor = $form->getData();
            //Codificamos la contraseña del corredor
            $encoder = $this->get('security.encoder_factory')->getEncoder($corredor);
            $password = $encoder->encodePassword($corredor->getPassword(),$corredor->getSalt());
            $corredor->saveEncodedPassword($password);
            //Lo actualizamos en nuestro repositorio de corredores
            $this->get('corredoresrepository')->actualizarCorredor($corredor);
            //Creamos un mensaje flash para mostrar al usuario que se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info','!Enhorabuena, '. $corredor->getNombre() . ' te has registrado en Corredores por la Rioja!');
            //Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('app_corredores_rioja_homepage'));
        }
        return $this->render("AppCorredoresRiojaBundle:Corredores:perfil.html.twig",array('formulario'=>$form->createView()));
    }
    
    public function inscribirAction($slug){
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            throw $this->createAccessDeniedException();
        }
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $corredor = $this -> get('corredoresrepository') -> BuscarCorredorPorDNI($user->getUsername());
        $carrera = $this->get('carreras')-> BuscarCarreraPorSlug($slug);
        if(!$this -> get('participantes') -> EstaCorredorCarrera($corredor,$carrera))
        {
            $participante = new Participante("1",111,$corredor,$carrera);
            $this -> get('participantes') -> IncribirParticipante($participante);
            $this-> get('session')->getFlashBag()->add('info','¡Enhorabuena,  te has registrado en la carrera '.$carrera->getNombre().'!');
        }else
        {
            $this-> get('session')->getFlashBag()->add('info','Ya te habías registrado en la carrera '.$carrera->getNombre());
        }
        return $this->redirect($this->generateUrl('app_corredores_rioja_miscarreras'));
    }
    
    public function desapuntarAction($slug){
        if(!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY'))
        {
            throw $this->createAccessDeniedException();
        }
        
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $corredor = $this -> get('corredoresrepository') -> BuscarCorredorPorDNI($user->getUsername());
        $carrera = $this->get('carreras')-> BuscarCarreraPorSlug($slug);
        if($this -> get('participantes') -> EstaCorredorCarrera($corredor,$carrera))
        {
            $participante = new Participante("1",111,$corredor,$carrera);
            $this -> get('participantes') -> EliminarParticipacion($participante);
            $this-> get('session')->getFlashBag()->add('info','¡Enhorabuena, has sido eliminado de la carrera '.$carrera->getNombre().'!');
        }else
        {
            $this-> get('session')->getFlashBag()->add('info','No habías sido registrado en la carrera '.$carrera->getNombre());
        }
        return $this->redirect($this->generateUrl('app_corredores_rioja_miscarreras'));
    }
}
