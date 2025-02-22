<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SetUserRoleController extends AbstractController
{

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
        if (!$user instanceof User) {
            //$this->addFlash('danger', 'User not found');
            throw $this->createAccessDeniedException('User not found');
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
