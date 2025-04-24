<?php

namespace App\Controller\Editor;

use App\Entity\Editor;
use App\Repository\EditorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/editor')]
final class EditorController extends AbstractController
{
    #[Route(name: 'app_editor_index', methods: ['GET'])]
    public function index(EditorRepository $editorRepository): Response
    {
        return $this->render('editor/index.html.twig', [
            'editors' => $editorRepository->findAll(),
        ]);
    }


    #[Route('/{id}', name: 'app_editor_show', methods: ['GET'])]
    public function show(Editor $editor): Response
    {
        return $this->render('editor/show.html.twig', [
            'editor' => $editor,
        ]);
    }
}
