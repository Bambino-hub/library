<?php

namespace App\Controller\Author;

use App\Entity\Author;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route('/author')]
class DeleteAuthorController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly RequestStack $requestStack
    ) {}

    #[Route('/{id}', name: 'app_author_delete', methods: ['POST'])]
    public function delete(Author $author): Response
    {
        if ($this->isCsrfTokenValid('delete' . $author->getId(), $this->requestStack->getCurrentRequest()->getPayload()->getString('_token'))) {
            $this->entityManager->remove($author);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_author_index', [], Response::HTTP_SEE_OTHER);
    }
}
