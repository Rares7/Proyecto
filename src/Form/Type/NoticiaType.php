<?php 

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Noticia;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Validator\Constraints\File;

class NoticiaType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('titulo', TextType::class, ["required"=>false])
            ->add('categoria', TipoCategoriaType::class, ["required"=>false])
            ->add('descripcion', TextareaType::class, ["required"=>false])
            ->add('autor', TextType::class, ["required"=>false])
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
            ->add('btnSave', SubmitType::class, ["label"=> 'Guardar']);
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults([ 'data_class' => Noticia::class,]);
    }
}