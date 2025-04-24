<?php

namespace App\Controller\Editor;

use App\Entity\Editor;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteEditorController extends AbstractController
{

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly RequestStack $requestStack
    ) {}

    #[Route('/{id}', name: 'app_editor_delete', methods: ['POST'])]
    public function delete(Editor $editor): Response
    {
        if ($this->isCsrfTokenValid('delete' . $editor->getId(), $this->requestStack->getCurrentRequest()->getPayload()->getString('_token'))) {
            $this->entityManager->remove($editor);
            $this->entityManager->flush();
        }

        return $this->redirectToRoute('app_editor_index', [], Response::HTTP_SEE_OTHER);
    }
}
