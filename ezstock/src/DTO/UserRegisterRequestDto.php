<?php

namespace App\DTO;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints as Assert;

class UserRegisterRequestDto extends Constraint
{
    #[Assert\NotBlank(message: 'E-mail is a mandatory field')]
    #[Assert\Email(message: 'The e-mail {{ value }} is invalid!')]
    public $email;

    #[Assert\NotBlank(message: 'Name is a mandatory field')]
    public $name;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 6)]
    public $password;

    #[Assert\NotBlank()]
    #[Assert\Length(min: 6)]
    #[Assert\EqualTo(propertyPath: 'password', message: 'Password and confirm password must be equals')]
    public $confirmPassword;
}
