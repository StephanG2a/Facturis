<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/dashboard/users', name: 'dashboard_users_')]
#[IsGranted("ROLE_ADMIN")]
class AdminUserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('adminUser/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
}
