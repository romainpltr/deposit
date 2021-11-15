<?php

namespace App\Controller;

use App\Entity\Group;
use App\Form\GroupType;
use App\Repository\GroupRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/group')]
#[IsGranted('ROLE_ADMIN')]
class GroupController extends AbstractController
{
    #[Route('/new', name: 'group_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $group = new Group();
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $users = $form->getData()->getUsers()->toArray();
            foreach ($users as $user) {
                $user->setGroupe($group);
                $entityManager->persist($user);
            }
            $entityManager->persist($group);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/admin/group/new.html.twig', [
            'group' => $group,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'group_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Group $group): Response
    {
        $form = $this->createForm(GroupType::class, $group);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $users = $form->getData()->getUsers()->toArray();
            foreach ($users as $user) {
                $user->setGroupe($group);
                $entityManager->persist($user);
            }
            $entityManager->persist($group);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/admin/group/edit.html.twig', [
            'group' => $group,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'group_delete', methods: ['GET', 'POST'])]
    public function delete(Request $request, Group $group): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $users = $group->getUsers()->toArray();
        foreach ($users as $user) {
            $group->removeUser($user);
        }
        $entityManager->remove($group);
        $entityManager->flush();


        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }

}
