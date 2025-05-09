<?php

namespace App\Controller\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{

    public function __construct(
        private readonly UserRepository $userRepository
    ){}

    /**
     * this function return all users
     */
    #[Route('/user', name: 'app_all_user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $this->userRepository->findAll()
        ]);
    }
    
}
