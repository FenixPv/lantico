<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class PageController extends AbstractController
{
    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/', name: 'homepage')]
    public function index(Environment $twig, PageRepository $pageRepository): Response
    {
        return new Response($twig->render('page/index.html.twig', [
            'pages' => $pageRepository->findAll(),
        ]));
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    #[Route('/{id}', name: 'page')]
    public function show(Environment $twig, Page $page): Response
    {
        return new Response($twig->render('page/show.html.twig', [
            'page' => $page,
        ]));
    }
}
