<?php

namespace App\Controller;

use App\Entity\Deposit;
use App\Form\DepositType;
use App\Repository\DepositRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/deposit')]
class DepositController extends AbstractController
{
    #[Route('/new', name: 'deposit_new', methods: ['GET','POST'])]
    public function new(Request $request): Response
    {
        $deposit = new Deposit();
        $form = $this->createForm(DepositType::class, $deposit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($deposit);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/deposit/new.html.twig', [
            'deposit' => $deposit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/edit', name: 'deposit_edit', methods: ['GET','POST'])]
    public function edit(Request $request, Deposit $deposit): Response
    {
        $form = $this->createForm(DepositType::class, $deposit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pages/deposit/edit.html.twig', [
            'deposit' => $deposit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'deposit_delete', methods: ['GET','POST']) ]
    public function delete(Request $request, Deposit $deposit): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($deposit);
        $entityManager->flush();


        return $this->redirectToRoute('app_admin', [], Response::HTTP_SEE_OTHER);
    }
}
