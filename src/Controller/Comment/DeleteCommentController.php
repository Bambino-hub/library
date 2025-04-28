<?php

namespace App\Controller\Comment;

use App\Entity\Comment;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


// #[Route('/comment')]
class DeleteCommentController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly RequestStack $requestStack
    ) {}

    #[Route('/comment/{id}', name: 'app_comment_delete', methods: ['POST'])]
    public function delete(Comment $comment): Response
    {
        if ($this->isCsrfTokenValid('delete' . $comment->getId(), $this->requestStack->getCurrentRequest()->getPayload()->getString('_token'))) {
            $this->entityManager->remove($comment);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
    }
}
