<?php 

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Noticia;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;


class UserType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('username', TextType::class, ["required"=>false])
            ->add('email', TextType::class, ["required"=>false])
            ->add('password', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'Password'),
                'second_options' => array('label' => 'Repeat Password')))
            ->add('btnSave', SubmitType::class, ["label"=> 'Guardar']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([ 'data_class' => User::class,]);
    }
}