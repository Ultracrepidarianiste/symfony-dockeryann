<?php

namespace App\Command;

use App\Entity\Commentaire;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


#[AsCommand(
    name: 'app:CreateComments',
    description: 'Add a short description for your command',
)]
class CreateCommentsCommand extends Command
{
    private ArticleRepository $articleRepository;
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager, ArticleRepository $articleRepository)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
        $this->articleRepository = $articleRepository;
    }

    protected function configure(): void
    {   
        $this->addArgument('nb_commentaire', InputArgument::REQUIRED, 'Nombre de commentaires');
        $this->addArgument('id_article', InputArgument::REQUIRED, "Id de l'article");
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $idArticle = $input->getArgument('id_article');
        $article = $this->articleRepository->find($idArticle);

    

        if (!$article) {
            $io->error("impossble de trouver l'article", $idArticle);
            return command::FAILURE;
        }

        $nbCommentaires = $input->getArgument('nb_commentaire');

        for($compteur =0; $compteur < $nbCommentaires; $compteur++) {
            $io->comment('Creation commentaire'.$compteur);
            $commentaire = new Commentaire();
            $commentaire->setText1("Commentaire".$compteur);
            $commentaire->setArticle($article);
            $commentaire->setAuthor("Nicolas");
            $commentaire->SetDate(new \DateTime());
            $this->entityManager->persist($commentaire);
        }

        

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
