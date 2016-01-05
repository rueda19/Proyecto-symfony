<?php

namespace App\CorredoresRiojaBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use App\CorredoresRiojaBundle\Form\Transformer\RegistroOrganizacionTransformer;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrganizacionType extends AbstractType{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder->add('id')
                ->add('nombre')
                ->add('descripcion')
                ->add('email')
                //Pedimos confirmacion de la contraseña
                ->add('password','repeated',array('type'=>'password','invalid_message'=>'La contraseña debe ser la misma','options'=>array('label'=>'Contraseña: ')))
                //Por ultimo añadimos el boton de envio
                ->add('registro','submit',array('label'=>'Registro'));
        
        $builder->addViewTransformer(new RegistroOrganizacionTransformer());
    }
    
    public function getName() {
        return 'organizacion';
    }
    
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array('data_class' => 'App\CorredoresRiojaBundle\Form\DTO\RegistroOrganizacionCommand','error_mapping' => array('passwordLegal'=>'password')));        
    }
}
