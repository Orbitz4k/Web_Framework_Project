<?php

namespace App\Controller;

use App\Entity\Solicitors;
use App\Form\SolicitorsType;
use App\Repository\SolicitorsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/solicitors')]
class SolicitorsController extends AbstractController
{
    #[Route('/', name: 'solicitors_index', methods: ['GET'])]
    public function index(SolicitorsRepository $solicitorsRepository): Response
    {
        return $this->render('solicitors/index.html.twig', [
            'solicitors' => $solicitorsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'solicitors_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $solicitor = new Solicitors();
        $form = $this->createForm(SolicitorsType::class, $solicitor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($solicitor);
            $entityManager->flush();

            return $this->redirectToRoute('solicitors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('solicitors/new.html.twig', [
            'solicitor' => $solicitor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'solicitors_show', methods: ['GET'])]
    public function show(Solicitors $solicitor): Response
    {
        return $this->render('solicitors/show.html.twig', [
            'solicitor' => $solicitor,
        ]);
    }

    #[Route('/{id}/edit', name: 'solicitors_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Solicitors $solicitor, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SolicitorsType::class, $solicitor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('solicitors_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('solicitors/edit.html.twig', [
            'solicitor' => $solicitor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'solicitors_delete', methods: ['POST'])]
    public function delete(Request $request, Solicitors $solicitor, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$solicitor->getId(), $request->request->get('_token'))) {
            $entityManager->remove($solicitor);
            $entityManager->flush();
        }

        return $this->redirectToRoute('solicitors_index', [], Response::HTTP_SEE_OTHER);
    }

}
