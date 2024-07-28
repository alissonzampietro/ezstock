<?php

namespace App\Controller;

use App\DTO\UserRegisterRequestDto;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[Route('/api/user')]
final class UserController extends AbstractController
{
    private $entityManager;
    private $passwordHasher;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordHasher,
    ) {
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    #[Route('/', methods: ["POST"])]
    public function create(#[MapRequestPayload] UserRegisterRequestDto $userDto, ValidatorInterface $validator): JsonResponse
    {
        //TODO: implement confirm password
        //TODO: create validator of the fields
        //TODO: create user using the repository
        $errors = $validator->validate($userDto);
        if (count($errors) > 0) {
            return $this->json($errors, Response::HTTP_BAD_REQUEST);
        }

        $user = new User();
        $user->setEmail($userDto->email);
        $user->setName($userDto->name);
        $user->setPassword($this->passwordHasher->hashPassword($user, $userDto->password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $this->json(['message' => 'User created'], Response::HTTP_CREATED);
    }
}
