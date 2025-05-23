<?php

namespace App\Controller;

use App\Entity\JeuVideo;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JeuVideoRepository;
use App\Entity\Produit;
use App\Form\JeuVideoType;
use App\Form\ProduitType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\JeuVideoRecherche;
use App\Form\JeuVideoRechercheType;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class JeuxController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeux')]
    public function index(Request $request, JeuVideoRepository $repository, SessionInterface $session): Response
    {
        $jeuxRecherche = new JeuVideoRecherche();
        $formRecherche = $this->createForm(
            JeuVideoRechercheType::class,
            $jeuxRecherche
        );
        $formRecherche->handleRequest($request);
        if ($formRecherche->isSubmitted() && $formRecherche->isValid()) {
            $jeuxRecherche = $formRecherche->getData();
            // cherche les jeux correspondant aux critères, triés par libellé
            // requête construite dynamiquement alors il est plus simple

            // d'utiliser le querybuilder

            $lesJeux = $repository->findAllByCriteria($jeuxRecherche);
            // mémoriser les critères de sélection dans une variable de session
            $session->set('JeuxCriteres', $jeuxRecherche);
        } else {
            // lire les jeux
            if ($session->has("JeuxCriteres")) {
                $jeuxRecherche = $session->get("JeuxCriteres");
                $lesJeux = $repository->findAllByCriteria($jeuxRecherche);
                $formRecherche = $this->createForm(
                    JeuVideoRechercheType::class,

                    $jeuxRecherche
                );

                $formRecherche->setData($jeuxRecherche);
            } else {
                $lesJeux = $repository->findAll();
            }
        }

        // $lesJeux = $repository->findAll();
        return $this->render('jeux/index.html.twig', [
            'formRecherche' => $formRecherche->createView(),
            'lesJeux' => $lesJeux,
            'menuActif' => 'Jeux',
        ]);
    }

    #[Route('/jeux/ajouter', name: 'app_jeux_ajouter')]
    public function ajouter(
        JeuVideo $jeux = null,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(JeuVideoType::class, $jeux);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // cas où le formulaire d'ajout a été soumis par l'utilisateur et est
            // valide

            $jeux = $form->getData();
            // on met à jour la base de données


            $entityManager->persist($jeux);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Le jeux vidéo ' . $jeux->getNom() . ' a été ajouté.'
            );
            return $this->redirectToRoute('app_jeux');
        } else {
            // cas où l'utilisateur a demandé l'ajout, on affiche le formulaire

            // d'ajout

            return $this->render('jeux/ajouter.html.twig', [
                'form' => $form->createView(),
                'menuActif' => 'Jeux',
            ]);
        }
    }

    #[Route('/jeux/modifier/{id<\d+>}', name: 'app_jeux_modifier')]
    public function modifier(
        JeuVideo $jeux = null,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        $form = $this->createForm(JeuVideoType::class, $jeux);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // cas où le formulaire a été soumis par l'utilisateur et est valide
            //pas besoin de "persister" l'entité : en effet, l'objet a déjà été

            // retrouvé à partir de Doctrine ORM.
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Le jeux vidéo ' . $jeux->getNom() . ' a été modifié.'
            );
            return $this->redirectToRoute('app_jeux');
        }
        // cas où l'utilisateur a demandé la modification, on affiche le
        // formulaire pour la modification
        return $this->render('jeux/modifier.html.twig', [
            'form' => $form->createView(),
            'menuActif' => 'Jeux',
        ]);
    }

    #[Route('/jeux/supprimer/{id<\d+>}', name: 'app_jeux_supprimer')]
    public function supprimer(
        JeuVideo $jeux,
        Request $request,
        EntityManagerInterface $entityManager
    ): Response {
        if ($this->isCsrfTokenValid('action-item' . $jeux->getId(), $request->get('_token'))) {

            $entityManager->remove($jeux);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Le jeu ' . $jeux->getNom() . ' a été supprimé.'
            );
            return $this->redirectToRoute('app_jeux');
        }
        return $this->render('jeux/index.html.twig', [
            'lesJeux' => $jeux,
            'menuActif' => 'Jeux',
        ]);
    }
}
