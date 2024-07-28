<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use App\DTO\UserRegisterRequestDto;

class PasswordMatchValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$value instanceof UserRegisterRequestDto) {
            throw new \InvalidArgumentException('@PasswordMatch constraint must be used on UserRegisterRequestDto class.');
        }

        if ($value->password !== $value->confirmPassword) {
            $this->context->buildViolation($constraint->message)
                ->atPath('confirmPassword')
                ->addViolation();
        }
    }
}
