<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class UserController extends AbstractController
{

    /**
     * this function return all users
     */
    #[Route('/user', name: 'app_all_user')]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll()
        ]);
    }

    /**
     * this function set role admin for user
     */
    #[Route('/user/{id}/promote', name: 'app_promote_user')]
    public function promoteToAdmin(User $user, EntityManagerInterface $em): Response
    {
    
        if (!$user) {
            $this->addFlash('danger', 'User not found');
        }
        $user->setRoles(array_merge($user->getRoles(), ['ROLE_ADMIN']));
        $em->flush();
        return $this->redirectToRoute('app_all_user');
    }

    /**
     * this function remove role admin for user
     */
    #[Route('/user/{id}/demote', name: 'app_demote_user')]
    public function demoteFromAdmin(User $user, EntityManagerInterface $em): Response
    {
        if (!$user) {
            $this->addFlash('danger', 'User not found');
        }
        $roles = $user->getRoles();
        if (($key = array_search('ROLE_ADMIN', $roles)) !== false) {
            unset($roles[$key]);
        }
        $user->setRoles($roles);
        $em->flush();
        return $this->redirectToRoute('app_all_user');
    }
}
