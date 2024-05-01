<?php

namespace App\Controller;

use App\Entity\Commentaire;
use App\Repository\CommentaireRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ArticleRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class PublicController extends AbstractController
{
    private ArticleRepository $articleRepository;
    private CommentaireRepository $commentaireRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(ArticleRepository $articleRepository, CommentaireRepository $commentaireRepository, EntityManagerInterface $entityManager) {
        $this->articleRepository = $articleRepository;
        $this->commentaireRepository = $commentaireRepository;
        $this->entityManager = $entityManager;
    }
    

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
public function article(int $id, Request $request): Response
{
    $article = $this->articleRepository->find($id);
    $commentaires = $article->getIdArticle();
        
    $commentaire = new Commentaire();
    $form = $this->createFormBuilder($commentaire)
        ->add('Text1', TextType::class)
        ->add('save', SubmitType::class, ['label' => 'Post Comment'])
        ->getForm();

    
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $commentaire->setArticle($article);
        $commentaire->SetDate(new \DateTime());
        
        $this->entityManager->persist($commentaire);
        $this->entityManager->flush();
    }

    return $this->render('public/article.html.twig', [
        'controller_name' => 'PublicController',
        'article' => $article,
        'commentaires' => $commentaires,
        'form' => $form->createView() 
    ]);

    }
}




