<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class UserLoginRequestDto extends Constraint
{
    #[Assert\NotBlank(message: 'E-mail is a mandatory field')]
    #[Assert\Email(message: 'The e-mail {{ value }} is invalid!')]
    public $email;

    #[Assert\NotBlank(message: 'Password is a mandatory field')]
    #[Assert\Length(min: 6)]
    public $password;
}
