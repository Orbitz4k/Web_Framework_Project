<?php

namespace App\Controller;

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
    #[Route('/lawyers', name: 'lawyers')]
    public function lawyer(): Response
    {
        $template = 'default/lawyers.html.twig';
        $argsArray = [];

        return $this->render($template, $argsArray);
    }
}
