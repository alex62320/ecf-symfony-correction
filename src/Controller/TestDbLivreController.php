<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Auteur;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestDbLivreController extends AbstractController
{
    #[Route('/test/db/livre', name: 'app_test_db_livre')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        /** @var App\Repository\LivreRepository */
        $livreRepository = $doctrine->getRepository(Livre::class);
        /** @var App\Repository\AuteurRepository*/
        $auteurRepository = $doctrine->getRepository(Auteur::class);

        // recuperer les livres qui contient 'vero'
        $livres = $livreRepository->findByTitre('vero');
        dump($livres);
        
        // recuperer la liste des livre dont l'id de l'auteur est '1'
        $auteur = $auteurRepository->find(1);
        $livres = $livreRepository->findByAuteur($auteur);
        dump($livres);

        // recuperer les livres dont le genre est 'roman'

        $livres = $livreRepository->findByNomGenre('roman');

        foreach ($livres as $livre){
            dump($livre->getTitre());
            foreach($livre->getGenres() as $genre){
                dump($genre->getNom());
            }
        }


        exit();
    }
}
