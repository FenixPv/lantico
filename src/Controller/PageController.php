<?php

namespace App\Controller;

use App\Entity\Page;
use App\Repository\PageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(PageRepository $pageRepository): Response
    {
        return $this->render('page/index.html.twig', [
            'pages' => $pageRepository->findAll(),
        ]);
    }
    #[Route('/{slug}', name: 'show-page')]
    public function show(
        #[MapEntity(mapping: ['slug' => 'slug'])] Page $page): Response
    {
        return $this->render('/page/show.html.twig', [
//            'slug' => $page->getSlug(),
            'page' => $page,
        ]);
    }
}
