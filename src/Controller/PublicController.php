<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;

class PublicController extends AbstractController
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        //parent::__construct();
        $this->articleRepository = $articleRepository;
    }

    //1 ArticleRepository à ajouter en auto-wiring
    //2 On charge les articles
    //3 On passe les articles à la vue TWIG
    //4 On modifie la vue TWIG pour avoir les articles visibles

    #[Route('/', name: 'app_accueil')]
    public function index(): Response
    {

        $articles = $this->articleRepository->findAll();

        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
            'articles' => $articles
        ]);
    }

    #[Route('/article/{id}', name: 'app_article')]
    public function article(int $id): Response
    {

        $article = $this->articleRepository->find($id);

        return $this->render('public/article.html.twig', [
            'controller_name' => 'PublicController',
            'article' => $article
        ]);
    }
}




