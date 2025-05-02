<?php

namespace App\Controller\Comment;

use App\Entity\Book;
use App\Entity\Comment;
use App\Entity\User;
use App\Enum\CommentStatus;
use App\Form\CommentType;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CreateCommentController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly RequestStack $requestStack
    ) {}

    /**
     * cette fonction permet de creer un comment lie a un livre
     * elle prend en parametre le livre lie a la commentaire
     */

    #[Route('/comment/new/{id}', name: 'app_comment_new', methods: ['GET', 'POST'])]
    public function new(Book $book): Response
    {
        $comment = new Comment();
        $user = $this->getUser();
        $status = CommentStatus::PENDING;

        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($this->requestStack->getCurrentRequest());

        if ($user instanceof User) {

            if ($form->isSubmitted() && $form->isValid()) {
                $comment->setName($user->getFirstname() . ' ' . $user->getLastname());
                $comment->setEmail($user->getEmail());
                $comment->addBook($book);
                $comment->setStatus($status);
                $this->entityManager->persist($comment);
                $this->entityManager->flush();

                return $this->redirectToRoute('app_comment_index', [], Response::HTTP_SEE_OTHER);
            }
        } else {
            $this->addFlash('error', 'veillez vous inscrire');
        }

        return $this->render('comment/new.html.twig', [
            'comment' => $comment,
            'form' => $form,
        ]);
    }
}
