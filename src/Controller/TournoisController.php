<?php

namespace App\Controller;

use App\Entity\CatTournois;
use App\Entity\Participant;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Tournoi;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

class TournoisController extends AbstractController
{
    #[Route('/tournois', name: 'app_tournois')]
    public function index(): Response
    {
        return $this->render('tournois/index.html.twig', [
            'controller_name' => 'TournoisController',
            'menuActif' => 'Jeux',
        ]);
    }

    #[Route('/tournoi/creer', name: 'app_tournoi_creer')]
    public function creerTournoi(EntityManagerInterface $entityManager): Response
    {
        // : Response type de retour de la méthode creerTournoi
        // pour récupérer le EntityManager (manager d'entités, d'objets)
        // on peut ajouter l'argument à la méthode comme
        // ici creerTournoi(EntityManagerInterface $entityManager)
        // ou on peut récupérer le EntityManager comme dans la méthode
        // suivante

        // créer l'objet
        $tournoi = new Tournoi();
        $tournoi->setLibelle('tournoi retrogame 2024');
        $tournoi->setDate(new \DateTime("2024-07-30 00:00:00"));
        $categorie = $entityManager
            ->getRepository(CatTournois::class)
            ->findOneBy(['libelle' => 'RetroGaming']);
        $tournoi->setCategorie($categorie);
        $tournoi->setNbParticipants(32);

        // chercher l'id du participant 'Yannick' et l'ajouter à la collection de
        // participants du tournoi
        $participant = $entityManager
            ->getRepository(Participant::class)
            ->findOneBy(['prenom' => 'Yannick']);
        $tournoi->addParticipant($participant);

        // chercher l'id du participant 'Marianne' et l'ajouter à la collection de
        // participants du tournoi
        $participant = $entityManager
            ->getRepository(Participant::class)
            ->findOneBy(['prenom' => 'Marianne']);
        $tournoi->addParticipant($participant);

        // chercher l'id du participant 'Hamid' et l'ajouter à la collection de
        // participants du tournoi
        $participant = $entityManager
            ->getRepository(Participant::class)
            ->findOneBy(['prenom' => 'Hamid']);
        $tournoi->addParticipant($participant);

        // dire à Doctrine que l'objet sera (éventuellement) persisté
        $entityManager->persist($tournoi);

        // exécuter les requêtes (indiquées avec persist) ici il s'agit de l'ordre
        // INSERT qui sera exécuté
        $entityManager->flush();


        return new Response('Nouveau tournoi ' . $tournoi->getlibelle() . '
        enregistré avec ' . sizeof($tournoi->getParticipants()) . ' participants, son id
        est : ' . $tournoi->getId());
    }

    #[Route('/tournoi/complet/creer', name: 'app_tournoi_complet_creer')]
    public function creerTournoiComplet(EntityManagerInterface $entityManager)
    {
        // créer une catégoriede tournoi
        $categorie = new CatTournois();
        $categorie->setLibelle('Tournois RetroGaming');
        // créer un tournoi
        $tournoi = new Tournoi();
        $tournoi->setLibelle('Tournois e-sport 2024');
        $tournoi->setdate(new \DateTime("2024-10-14 00:00:00"));
        $tournoi->setNbParticipants(0);
        // mettre en relation le tournoi avec la catégorie
        $tournoi->setCategorie($categorie);
        // persister les objets
        $entityManager->persist($categorie);
        $entityManager->persist($tournoi);
        // exécutez les requêtes
        $entityManager->flush();
        // retourner une réponse
        return new Response(
            'Nouveau tournoi enregistré avec l\'id : ' . $tournoi->getId()
                . ' et nouvelle catégorie de tournois enregistrée avec id: ' .
                $categorie->getId()
        );
    }

    #[Route('/tournoi/{id}', name: 'app_tournoi_lire')]
    public function lire($id, ManagerRegistry $doctrine)
    {
        // ces 2 exemples retournent le entity manager par défaut
        // ici nous n'utilisons qu'une base de données donc le entity manager par
        // défaut suffit
        $entityManager = $doctrine->getManager();
        // $entityManager = $doctrine->getManager('default');
        // {id} dans la route permet de récupérer $id en argument de la méthode
        // on utilise le Repository de la classe Tournoi
        // il s'agit d'une classe qui est utilisée pour les recherches d'entités
        // (et donc de données dans la base)
        // la classe TournoiRepository a été créée en même temps que l'entité par
        // le make
        $tournoi = $entityManager
            ->getRepository(Tournoi::class)
            ->find($id);
        if (!$tournoi) {
            throw $this->createNotFoundException(
                'Ce tournoi n\'existe pas : ' . $id
            );
        }
        return new Response('Voici le libellé du tournoi : ' . $tournoi->getLibelle());
    }

    #[Route('/tournoiautomatique/{id}', name: 'app_tournoiautomatique_lire')]
    public function lireautomatique(Tournoi $tournoi)
    {
        // grâce au Symfony\Bridge\Doctrine\ArgumentResolver\EntityValueResolver
        // il suffit de donner le tournoi en argument
        // la requête de recherche sera automatique
        // et une page 404 sera générée si le tournoi n'existe pas
        return new Response('Voici le libellé du tournoi lu automatiquement : '
            . $tournoi->getLibelle() .
            ' crée le ' . $tournoi->getDateCreation()->format('Y-m-d H:i:s'));
        // on peut bien sûr également rendre un template
    }

    #[Route('/tournoi/modifier/{id}', name: 'app_tournoi_modifier')]
    public function modifier($id, EntityManagerInterface $entityManager)
    {
        // 1 recherche du tournoi
        $tournoi = $entityManager->getRepository(Tournoi::class)->find($id);
        // en cas de tournoi inexistant, affichage page 404
        if (!$tournoi) {
            throw $this->createNotFoundException(
                'Aucun tournoi avec l\'id ' . $id
            );
        }
        // 2 modification des propriétés
        $tournoi->setLibelle('tournoi RetroGaming milésime 2024');
        // 3 exécution de l'update
        $entityManager->flush();
        // redirection vers l'affichage du tournoi
        return $this->redirectToRoute('app_tournoi_lire', [
            'id' => $tournoi->getId()
        ]);
    }

    #[Route('/tournoi/supprimer/{id}', name: 'app_tournoi_supprimer')]
    public function supprimer($id, EntityManagerInterface $entityManager)
    {
        // 1 recherche du tournoi
        $tournoi = $entityManager->getRepository(Tournoi::class)->find($id);
        // en cas de tournoi inexistant, affichage page 404
        if (!$tournoi) {
            throw $this->createNotFoundException(
                'Aucun tournoi avec l\'id ' . $id
            );
        }
        // 2 suppression du tournoi
        $entityManager->remove(($tournoi));
        // 3 exécution du delete
        $entityManager->flush();
        // affichage réponse
        return new Response('Le tournoi a été supprimé, id : ' . $id);
    }

    #[Route('/tournois/{datemax}', name: 'app_tournois_lireTournois')]
    public function lireTournois($datemax, EntityManagerInterface $entityManager)
    {
        $tournois = $entityManager
            ->getRepository(Tournoi::class)
            ->findAllAfterThanDate($datemax);
        // OU
        // $repository = $entityManager->getRepository(Tournoi::class);
        // $tournois = $repository->findAllAfterThanDate($prix);
        // OU
        // ajouter : use App\Repository\TournoiRepository;
        // injecter le repository : public function liretournois($prix,
        // et écrire :
        // $tournois = $repository->findAllAfterThanDate($date);
        return new Response('Voici le nombre de tournois : ' . sizeof($tournois));
    }
}
