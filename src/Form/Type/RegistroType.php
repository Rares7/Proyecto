<?php 

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\UserRegistro;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegistroType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('nombre', TextType::class, ["required"=>false])
            ->add('email', TextType::class, ["required"=>false])
            ->add('edad', TextType::class, ["required"=>false])
            ->add('tipo', TipoUsuarioType::class, ["required"=>false])
            ->add('username', TextType::class, ["required"=>false])
            ->add('clave', RepeatedType::class, [ 
                    "type" => PasswordType::class, 
                    "invalid_message" => "Las contraseñas deben coincidir",
                    "first_options" => ["label"=> "Clave"],
                    "second_options" => ["label"=> "Repite clave"],
                    "required"=>false
                ])
            ->add('direccion', DireccionType::class)
            ->add('btnRegistro', SubmitType::class, ["label"=> 'Registrar']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([ 'data_class' => UserRegistro::class, ]);
    }
}