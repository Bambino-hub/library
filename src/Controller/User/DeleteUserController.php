<?php

namespace App\Controller\User;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteUserController extends AbstractController
{
    public function __construct(
        private readonly EntityManagerInterface $em, 
        )
    {
    }


    /**
     * this function deletes a user
     */
    #[Route('/user/{id}/delete', name: 'app_delete_user',methods: ['DELETE'])]
    public function deleteUser(User $user): Response
    {
        if (!$user) {
            $this->addFlash('danger', 'User not found');
            //die;
        }
        $this->em->remove($user);
        $this->em->flush();
        $this->addFlash('success', 'User deleted successfully');
        return $this->redirectToRoute('app_all_user');
    }
}
