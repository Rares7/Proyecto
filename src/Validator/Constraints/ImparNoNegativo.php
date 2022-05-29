<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
* @Annotation
*/
class ImparNoNegativo extends Constraint {
    public $message = 'El número "%valor%" tiene que ser un número impar no negativo.';
}