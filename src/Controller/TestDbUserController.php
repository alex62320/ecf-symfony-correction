<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Emprunteur;

use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestDbUserController extends AbstractController
{
    #[Route('/test/db/user', name: 'app_test_db_user')]
    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        /** @var App\Repository\UserRepository */
        $userRepository = $doctrine->getRepository(User::class);
        /** @var App\Repository\EmprunteurRepository */
        $emprunteurRepository = $doctrine->getRepository(Emprunteur::class);

        // récuperer les users
        $users = $userRepository->findAll();
        dump($users);

        // les données de l'utilisateur avec l'id 1
        $user = $userRepository->find(1);
        dump($user);

        // recuperer les user avec l'email foo.foo@example.com
        $user = $userRepository->findOneBy([
            'email' => 'foo.foo@example.com',
            ]
        );
        dump($user);

        // les données de l'utilisateur dont l'attribut 'role' contien le mot clé 'ROLE_EMPRUNTEUR'
        $users = $userRepository->findByRoleEmprunteur();
        dump($users);
        
        // les données de l'utilisateur avec l'id 2
        $user = $userRepository->find(2);
        $emprunteur = $emprunteurRepository->findByUser($user);
        dump($emprunteur);

        exit();
    }
}
