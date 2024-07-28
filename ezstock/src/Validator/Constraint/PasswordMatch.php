<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class PasswordMatch extends Constraint
{
    public $message = 'The password fields must match.';

    public function validatedBy(): string
    {
        return static::class . 'Validator';
    }

    public function getTargets(): string
    {
        return self::CLASS_CONSTRAINT;
    }
}
