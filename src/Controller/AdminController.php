<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Deposit;
use App\Entity\Group;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em){
        $this->em = $em;
    }

    #[Route('/admin', name: 'app_admin')]
    public function index(Request $request, PaginatorInterface $paginator): Response
    {

        $users = $this->em->getRepository(User::class)->findAll();

        $users = $paginator->paginate(
            $users, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            6 // Nombre de résultats par page
        );

        $depots = $this->em->getRepository(Deposit::class)->findAll();
        $categories = $this->em->getRepository(Category::class)->findAll();
        $groups = $this->em->getRepository(Group::class)->findAll();

        return $this->render('pages/admin/index.html.twig', [
            'users' => $users,
            'depots' => $depots,
            'categories' => $categories,
            'groups' => $groups
        ]);
    }
}
