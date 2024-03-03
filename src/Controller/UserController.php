<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\User;
use App\Form\UserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/dashboard/profile', name: 'dashboard_profile_')]
#[IsGranted("ROLE_USER")]
class UserController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = $this->getUser();
        $userForm = $this->createForm(UserType::class, $user);
        $userForm->remove('password');
        $userForm->add('newPassword', PasswordType::class, [
            'label' => 'New Password',
            'attr' => ['placeholder' => '********'],
            'required' => false,
        ]);
        $userForm->handleRequest($request);
        if ($userForm->isSubmitted() && $userForm->isValid()) {
            $newPassword = $user->getNewPassword();
            if ($newPassword) {
                $hash = $passwordHasher->hashPassword($user, $newPassword);
                $user->setPassword($hash);
            }
            $em->flush();
            $this->addFlash('success', 'Profile updated successfully');
        }

        return $this->render('user/index.html.twig', [
            'form' => $userForm->createView(),
        ]);
    }

    #[Route('/notification', name: 'notification')]
    public function notification(): Response
    {
        return $this->render('user/notification.html.twig', []);
    }

    #[Route('/billing', name: 'billing')]
    public function billing(): Response
    {
        return $this->render('user/billing.html.twig', []);
    }
}
