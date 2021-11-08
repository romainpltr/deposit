<?php

namespace App\Controller;

use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class indexController extends AbstractController {

    #[Route('/', name: 'app_index')]
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $this->getUser() ? $user = $this->getUser(): $user = '';

        return $this->render('pages/index.html.twig', [
                'user' => $user,
            ]);
    }

    #[Route('/mesDepot', name: 'app_depot')]
    public function depot(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $this->getUser() ? $user = $this->getUser(): $user = '';

        return $this->render('pages/user/mesDepot.html.twig', [
            'user' => $user,
        ]);
    }
}