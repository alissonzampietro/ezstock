<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

class UserService
{
    public function __construct(
        private TokenStorageInterface $tokenStorage
    ) {
    }

    public function getCurrentUser(): User
    {
        $token = $this->tokenStorage->getToken();
        if ($token instanceof TokenInterface) {

            /** @var User $user */
            $user = $token->getUser();
            return $user;
        } else {
            return null;
        }
    }

    public function getTokenEmail(): null|string
    {
        $user = $this->getCurrentUser();
        return $user->getEmail() ?? null;
    }
}
