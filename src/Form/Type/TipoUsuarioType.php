<?php 

namespace App\Form\Type;

use App\Repository\NoticiaRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TipoUsuarioType extends AbstractType {

    private $repo;
    public function __construct(NoticiaRepository $repo) {
        $this->repo = $repo;
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(["choices" => [
            "Administrador"=> "admin",
            "Usuario"=> "user",
            "Usuario VIP"=> "vip"
        ]]);
    }

    public function getParent() {
        return ChoiceType::class;
    }

}