<?php

namespace App\Controller;

use App\Entity\Category;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
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
    public function depot(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface, EntityManagerInterface $em): Response
    {
        $this->getUser() ? $user = $this->getUser(): $user = '';
        $categories = $em->getRepository(Category::class)->findAll();

        return $this->render('pages/user/mesDepot.html.twig', [
            'user' => $user,
            'categories' => $categories
        ]);
    }
}