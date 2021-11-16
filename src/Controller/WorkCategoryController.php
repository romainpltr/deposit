<?php

namespace App\Controller;

use App\Entity\WorkCategory;
use App\Form\WorkCategoryType;
use App\Repository\WorkCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/work/category')]
#[IsGranted('ROLE_ADMIN')]
class WorkCategoryController extends AbstractController
{

    #[Route('/new', name: 'work_category_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $workCategory = new WorkCategory();
        $form = $this->createForm(WorkCategoryType::class, $workCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($workCategory);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/admin/work_category/new.html.twig', [
            'work_category' => $workCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'work_category_edit', methods: ['GET','POST'])]
    public function edit(Request $request, WorkCategory $workCategory): Response
    {
        $form = $this->createForm(WorkCategoryType::class, $workCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/admin/work_category/edit.html.twig', [
            'work_category' => $workCategory,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'work_category_delete', methods: ['POST'])]
    public function delete(Request $request, WorkCategory $workCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$workCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($workCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
}
