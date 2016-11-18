<?php

namespace App\AppBundle\Form;
//namespace App\AppBundle\Controller;


use App\AppBundle\Form\Transformer\RegistroCorredorTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class CorredorType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder->add('dni')
                ->add('nombre')
                ->add('apellidos')
                ->add('email')
                // Pedimos confirmación de la contraseña    
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'Las contraseñas deben coincidir.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options' => array('label' => 'Contraseña'),
                    'second_options' => array('label' => 'Repite contraseña'),
                ))
                // El tipo de fechanacimiento debe ser birthday de lo contrario sólo muestra
                // fechas hasta el año 2000.
                ->add('fechanacimiento', BirthdayType::class, array('label' => 'Fecha de nacimiento: '))
                ->add('direccion', TextareaType::class, array('label' => 'Dirección: '))
                // Por último añadimos el botón de envío.
                ;


        $builder->addViewTransformer(new RegistroCorredorTransformer());
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\AppBundle\Form\DTO\RegistroCorredorCommand',
            'error_mapping' => array('passwordLegal' => 'password',
                'mayorEdad' => 'fechanacimiento')
        ));
    }

    public function getName() {
        return 'corredor';
    }

}
