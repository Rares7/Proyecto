<?php 

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\UserLogin;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class LoginType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('username', TextType::class, ["required"=>false])
            ->add('clave', PasswordType::class, ["required"=>false])
            ->add('btnLogin', SubmitType::class, ["label"=> 'Iniciar sesión']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([ 'data_class' => UserLogin::class, ]);
    }
}