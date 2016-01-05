<?php

namespace App\CorredoresRiojaBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\CorredoresRiojaBundle\Form\OrganizacionType;
use App\CorredoresRiojaBundle\Form\CarreraType;
use App\CorredoresRiojaBundle\Form\CarreraPerfilType;
use Symfony\Component\HttpFoundation\Request;

class organizacionesController extends Controller{
    
    public function indexAction()
    {
        return $this->render("AppCorredoresRiojaBundle:Organizaciones:portada.html.twig");
    }
    
    public function registroAction() {
        $peticion = $this->getRequest();
        $form = $this->createForm(new OrganizacionType);
        $form ->handleRequest($peticion);
        if($form->isValid()){
            //Recogemos el corredor que se ha registrado
            $organizacion = $form->getData();
            //Codificamos la contraseña del corredor
            $encoder = $this->get('security.encoder_factory')->getEncoder($organizacion);
            $password = $encoder->encodePassword($organizacion->getPassword(),$organizacion->getSalt());
            $organizacion->saveEncodedPassword($password);
            //Lo almacenamos en nuestro repositorio de corredores
            $this->get('organizaciones')->RegistrarOrganizacion($organizacion);
            //Creamos un mensaje flash para mostrar al usuario que se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info','!Enhorabuena, '. $organizacion->getNombre() . ' te has registrado en Corredores por la Rioja!');
            //Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('app_organizaciones_rioja_homepage'));
        }
        return $this->render("AppCorredoresRiojaBundle:Organizaciones:registro.html.twig",array('formulario'=>$form->createView()));
    }
    
    public function loginAction(Request $request){
        $authenticationsUtils = $this->get('security.authentication_utils');
        
        $error =  $authenticationsUtils->getLastAuthenticationError();
        
        $lastUsername = $authenticationsUtils->getLastUsername();
        
        return $this->render('AppCorredoresRiojaBundle:Organizaciones:login.html.twig',array('last_username'=> $lastUsername,'error'=>$error));
    }
    
    public function registrocarrerraAction(){
        $peticion = $this->getRequest();
        $form = $this->createForm(new CarreraType);
        $form ->handleRequest($peticion);
        if($form->isValid()){
            //Recogemos el corredor que se ha registrado
            $carrera = $form->getData();
            //Lo almacenamos en nuestro repositorio de corredores
            $this->get('carreras')->CrearCarrera($carrera);
            //Creamos un mensaje flash para mostrar al usuario que se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info','!Enhorabuena, la carrera "'. $carrera->getNombre() . '" ha sido creada en Corredores por la Rioja!');
            //Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('app_organizaciones_rioja_homepage'));
        }
        return $this->render("AppCorredoresRiojaBundle:Organizaciones:registroCarrera.html.twig",array('formulario'=>$form->createView()));
    }
    
    public function modificarcarerraAction($slug){
        
        $carrera = $this -> get('carreras') -> BuscarCarreraPorSlug($slug);
        
        $post = $this->get('security.token_storage')->getToken()->getUser();
        $authChecker = $this->get('security.authorization_checker');
        $this->denyAccessUnlessGranted('edit', $carrera->getOrganizacion(), 'No tiene permiso para modificar la carrera '.$carrera->getNombre());
        
        $peticion = $this->getRequest();
        
        //$carrera = $this -> get('carreras') -> BuscarCarreraPorSlug($slug);
        
        $form = $this->createForm(new CarreraPerfilType,$carrera);
        $form ->handleRequest($peticion);
        if($form->isValid()){
            //Recogemos el corredor que se ha registrado
            $carrera = $form->getData();
            //Lo almacenamos en nuestro repositorio de corredores
            $this->get('carreras')->ActualizarCarrera($carrera);
            //Creamos un mensaje flash para mostrar al usuario que se ha registrado correctamente
            $this->get('session')->getFlashBag()->add('info','!Enhorabuena, la carrera "'. $carrera->getNombre() . '" ha sido modificada en Corredores por la Rioja!');
            //Reedirigimos al usuario a la portada
            return $this->redirect($this->generateUrl('app_organizaciones_rioja_homepage'));
        }
        return $this->render("AppCorredoresRiojaBundle:Organizaciones:modificarCarrera.html.twig",array('formulario'=>$form->createView(),'slug'=>$slug));
    }
    
    public function misCarrerasCreadasAction(){
        $user = $this->get('security.token_storage')->getToken()->getUser();
        
        $organizador = $this -> get('organizaciones') -> BuscarOrganizacionPorEmail($user->getUsername());
        
        $carrerasDis = $this -> get('carreras') -> BuscarCarrerasDisputadasPorOrganizador($organizador);
        
        $carrerasNoDis = $this -> get('carreras') -> BuscarCarrerasNODisputadasPorOrganizador($organizador);
        
        return $this->render("AppCorredoresRiojaBundle:Organizaciones:miscarrerascreadas.html.twig",array('carrerasNoDis'=>$carrerasNoDis,'carrerasDis'=>$carrerasDis,'nombre'=>$organizador->getNombre()));
        
    }
}
