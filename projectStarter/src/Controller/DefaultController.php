<?php

namespace App\Controller;

use App\Repository\ReviewsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        $template = 'default/index.html.twig';
        $argsArray = [];

        return $this->render($template, $argsArray);
    }

    #[Route('/lawyers', name: 'lawyers')]
    public function lawyers(): Response
    {
        $template = 'default/lawyers.html.twig';
        $argsArray = [];

        return $this->render($template, $argsArray);
    }
    #[Route('/pricing', name: 'pricing')]
    public function pricing(): Response
    {
        $template = 'default/pricing.html.twig';
        $argsArray = [];

        return $this->render($template, $argsArray);
    }
    #[Route('/reviews', name: 'reviews')]
    public function review(): Response
    {
        $template = 'default/reviews.html.twig';
        $argsArray = [];

        return $this->render($template, $argsArray);
    }
    #[Route('/reviews', name: 'reviews')]
    public function publicTable(ReviewsRepository $reviewsRepository): Response
    {
        $template = 'default/reviews.html.twig';
        $argsArray = ['reviews'=>$reviewsRepository->findAll()];

        return $this->render($template, $argsArray);
    }
}
