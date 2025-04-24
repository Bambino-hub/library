<?php

namespace App\Controller\Editor;

use App\Entity\Editor;
use App\Form\EditorType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/editor')]
class CreateEditorController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly RequestStack $requestStack
    ) {}

    #[Route('/new', name: 'app_editor_new', methods: ['GET', 'POST'])]
    public function new(): Response
    {
        $editor = new Editor();
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($this->requestStack->getCurrentRequest());

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($editor);
            $this->entityManager->flush();

            return $this->redirectToRoute('app_editor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('editor/new.html.twig', [
            'editor' => $editor,
            'form' => $form,
        ]);
    }
}
