<?php 

namespace App\Form\Type;

use App\Repository\CategoriaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TipoCategoriaType extends AbstractType {

    private $repo;
    public function __construct(CategoriaRepository $repo) {
        $this->repo = $repo;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $lst = $this->repo->findAll();
        $choices = array();
        foreach($lst as $cat) {
            $choices[$cat->getNombre()] = $cat;
        }
        $resolver->setDefaults(["choices" => $choices]);
    }

    public function getParent() {
        return ChoiceType::class;
    }

}