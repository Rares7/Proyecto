<?php 

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\Task;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class TaskType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder
            ->add('task', TextType::class, ["required"=>false, "help"=>"Esto será el nombre de la tarea"])
            ->add('tipo', TipoTareaType::class);
        if($options['show_due_date']) {
            $builder->add('dueDate', DateType::class);
        }
        $builder->add('agreeTerms', CheckboxType::class, ['mapped' => false]);
        $builder->add('save', SubmitType::class, ["label"=>$options['label_save']]);
    }

    public function configureOptions(OptionsResolver $resolver) {
        //por poner esto, generamos una atributo show_due_date en $options del metodo buildForm
        $resolver->setDefaults([ 'data_class' => Task::class, 'show_due_date' => true, 'label_save' => 'Save', ]);

        //esto nos lo va a admitir desde fuera del FormType cuando lo creemos
        $resolver->setAllowedTypes('show_due_date', 'bool');
        $resolver->setAllowedTypes('label_save', 'string');
    }
}