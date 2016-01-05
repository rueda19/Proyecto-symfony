<?php

namespace App\CorredoresRiojaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\CorredoresRiojaBundle\Form\Transformer\RegistroCarreraTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CarreraType extends AbstractType{
    //$Id, $Nombre, $Descripción, $FechaCelebración, $Distancia, $FechaLímiteInscripción, 
    //$NúmeroMáximaParticipantes, $Imagen, $Organizacion
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('id')
                ->add('nombre')
                ->add('descripcion')
                ->add('fechaCelebracion','date',array('label'=>'Fecha de celebracion: '))
                ->add('distancia')
                ->add('fechaLimiteInscripcion','date',array('label'=>'Fecha limite de inscripcion: '))
                ->add('numeroMaximaParticipantes')
                ->add('imagen')
                //Por ultimo añadimos el boton de envio
                ->add('registro','submit',array('label'=>'Añadir Carrera'));
        
        $builder->addViewTransformer(new RegistroCarreraTransformer());
    }
    
    public function getName() {
        return 'carrera';
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array('data_class' => 'App\CorredoresRiojaBundle\Form\DTO\RegistroCarreraCommand','error_mapping' => array('fechaInscripcionCorrecta'=>'fechaLimiteInscripcion','fechaCelebracionCorrecta'=>'fechaCelebracion')));        
    }

}
