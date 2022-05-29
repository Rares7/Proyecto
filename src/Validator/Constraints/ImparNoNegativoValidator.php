<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ImparNoNegativoValidator extends ConstraintValidator {
    
    public function validate($value, Constraint $constraint) {
        if (($value<0 || $value%2==0)) {
            $this->context
                ->buildViolation($constraint->message)
                ->setParameter('%valor%', $value??"")
                ->addViolation();
        }
    }
}