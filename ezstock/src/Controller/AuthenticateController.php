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
    #[Route('/login', methods: ['POST'], name: 'app_authenticate')]
    public function index(): JsonResponse
    {}
}
