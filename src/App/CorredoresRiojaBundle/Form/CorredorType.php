<?php

namespace App\CorredoresRiojaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\CorredoresRiojaBundle\Form\Transformer\RegistroCorredorTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CorredorType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('dni')
                ->add('nombre')
                ->add('apellidos')
                ->add('email')
                //Pedimos confirmacion de la contraseña
                ->add('password','repeated',array('type'=>'password','invalid_message'=>'La contraseña debe ser la misma','options'=>array('label'=>'Contraseña: ')))
                // El tipo de fechanacimient debe ser birthday de lo contrario solo muestras fechas hasta el año 2000
                ->add('fechanacimiento','birthday',array('label'=>'Fecha de nacimiento: '))
                ->add('direccion','textarea',array('label'=>'Dirección: '))
                //Por ultimo añadimos el boton de envio
                ->add('registro','submit',array('label'=>'Registro'));
        
        $builder->addViewTransformer(new RegistroCorredorTransformer());
    }
    
    public function getName() {
        return 'corredor';
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array('data_class' => 'App\CorredoresRiojaBundle\Form\DTO\RegistroCorredorCommand','error_mapping' => array('passwordLegal'=>'password','mayorEdad'=>'fechanacimiento')));        
    }

}
