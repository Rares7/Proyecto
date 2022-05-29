<?php 

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Contacto;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;

class ContactoType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('nombre', TextType::class, ["required"=>false])
            ->add('email', TextType::class, ["required"=>false])
            ->add('asunto', TextType::class, ["required"=>false])
            ->add('mensaje', TextareaType::class, ["required"=>false])
            ->add('imagen', FileType::class, [
                'label' => 'Imagen',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [ 'image/jpg', 'image/jpeg', 'image/png' ],
                        'mimeTypesMessage' => 'El fichero tiene que ser formato jpg, jpeg o png',
                    ])
                ],
            ])
            ->add('btnEnviar', SubmitType::class, ["label"=> 'Enviar']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([ 'data_class' => Contacto::class, 'csrf_protection' => false,]);
    }
}