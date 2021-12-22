<?php

namespace App\Controller;

use App\Entity\Article;
use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/articles', name: 'articles')]
    public function index(ArticleRepository $repo): Response
    {
        $articles=$repo->findAll();
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'articles' => $articles,
        ]);
    }

    #[Route('/articles/{slug}', name: 'article_show')]
    public function show($slug)
    {
        return $this->render('home/show.html.twig');
    }
}
