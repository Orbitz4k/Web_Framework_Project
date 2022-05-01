<?php

namespace App\Controller;

use App\Entity\SecretMode;
use App\Form\SecretModeType;
use App\Repository\SecretModeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/secret/mode')]
class SecretModeController extends AbstractController
{
    #[Route('/', name: 'secret_mode_index', methods: ['GET'])]
    public function index(SecretModeRepository $secretModeRepository): Response
    {
        return $this->render('secret_mode/index.html.twig', [
            'secret_modes' => $secretModeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'secret_mode_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $secretMode = new SecretMode();
        $form = $this->createForm(SecretModeType::class, $secretMode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($secretMode);
            $entityManager->flush();

            return $this->redirectToRoute('secret_mode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('secret_mode/new.html.twig', [
            'secret_mode' => $secretMode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'secret_mode_show', methods: ['GET'])]
    public function show(SecretMode $secretMode): Response
    {
        return $this->render('secret_mode/show.html.twig', [
            'secret_mode' => $secretMode,
        ]);
    }

    #[Route('/{id}/edit', name: 'secret_mode_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, SecretMode $secretMode, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(SecretModeType::class, $secretMode);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('secret_mode_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('secret_mode/edit.html.twig', [
            'secret_mode' => $secretMode,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'secret_mode_delete', methods: ['POST'])]
    public function delete(Request $request, SecretMode $secretMode, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$secretMode->getId(), $request->request->get('_token'))) {
            $entityManager->remove($secretMode);
            $entityManager->flush();
        }

        return $this->redirectToRoute('secret_mode_index', [], Response::HTTP_SEE_OTHER);
    }
}
