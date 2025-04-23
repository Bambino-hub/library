<?php

namespace App\Controller;

use App\Repository\BookRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    public function __construct(
        private readonly BookRepository $bookRepository
    ) {}

    #[Route('/', name: 'app_home')]
    public function index(): Response
    {

        return $this->render('home/index.html.twig', [
            'books' => $this->bookRepository->findAll(),
        ]);
    }
}
