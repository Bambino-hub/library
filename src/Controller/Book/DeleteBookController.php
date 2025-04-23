<?php

namespace App\Controller\Book;

use App\Entity\Book;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/book')]
class DeleteBookController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly RequestStack $requestStack

    ) {}

    #[Route('/{id}', name: 'app_book_delete', methods: ['POST'])]
    public function delete(Book $book): Response
    {
        if ($this->isCsrfTokenValid('delete' . $book->getId(), $this->requestStack->getCurrentRequest()->getPayload()->getString('_token'))) {
            $this->entityManager->remove($book);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_book_index', [], Response::HTTP_SEE_OTHER);
    }
}
