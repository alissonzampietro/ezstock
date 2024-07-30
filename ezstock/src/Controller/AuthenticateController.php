<?php

namespace App\Controller;

use App\Entity\User;
use App\DTO\UserLoginRequestDto;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/authenticate')]
class AuthenticateController extends AbstractController
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }
    #[Route('/login', methods: ['POST'], name: 'app_authenticate')]
    public function index(#[MapRequestPayload] UserLoginRequestDto $loginDto, UserRepository $repository): JsonResponse
    {
        $user = $repository->findOneBy(['email' => $loginDto->email]);

        if ($this->passwordHasher->isPasswordValid($user, $loginDto->password)) {
            return new JsonResponse(['token' => 'dummy-jwt-token']);
        }

        return $this->json([
            'error' => 'user not found',
        ], 404);
    }
}
