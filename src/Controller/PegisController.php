<?php

namespace App\Controller;

use App\Entity\Pegi;
use App\Form\PegiType;
use App\Repository\PegiRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PegisController extends AbstractController
{

    #[Route('/pegis', name: 'app_pegis')]
    #[Route('/pegis/demandermodification/{id<\d+>}', name: 'app_pegis_demandermodification')]
    public function index(PegiRepository $repository, Request $request, $id = null): Response
    {
        // Création du formulaire d'ajout (lié à une nouvelle instance)
        $pegi = new Pegi();
        $formCreation = $this->createForm(PegiType::class, $pegi);

        // Initialisation du formulaire de modification à null
        $formModificationView = null;

        // Si un ID est présent, on prépare le formulaire de modification
        if ($id !== null) {
            // Vérification du token CSRF pour la sécurité
            if ($this->isCsrfTokenValid('action-item' . $id, $request->get('_token'))) {
                $pegiModif = $repository->find($id);
                $formModificationView = $this->createForm(PegiType::class, $pegiModif)->createView();
            }
        }

        // Récupération de tous les PEGI depuis la bdd
        $lesPegis = $repository->findAll();

        // Affichage de la page avec les deux formulaires
        return $this->render('pegis/index.html.twig', [
            'formCreation' => $formCreation->createView(),
            'lesPegis' => $lesPegis,
            'formModification' => $formModificationView,
            'idPegiModif' => $id,
            'menuActif' => 'Gestion',
        ]);
    }

    #[Route('/pegis/ajouter', name: 'app_pegis_ajouter')]
    public function ajouter(Request $request, EntityManagerInterface $entityManager, PegiRepository $repository): Response
    {
        // Création d'une nouvelle instance de Pegi
        $pegi = new Pegi();

        // Création du formulaire lié à l'objet
        $form = $this->createForm(PegiType::class, $pegi);

        // Remplit l'objet à partir des données envoyées par le formulaire (POST)
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Si le formulaire est valide : enregistre l'objet en base
            $entityManager->persist($pegi);
            $entityManager->flush();

            // Message flash affiché après la redirection
            $this->addFlash('success', 'Le PEGI a été ajouté.');
            return $this->redirectToRoute('app_pegis');
        }

        // Si formulaire invalide, on réaffiche le formulaire avec les erreurs
        $lesPegis = $repository->findAll();

        return $this->render('pegis/index.html.twig', [
            'formCreation' => $form->createView(),
            'lesPegis' => $lesPegis,
            'formModification' => null,
            'idPegiModif' => null,
        ]);
    }

    #[Route('/pegis/modifier/{id<\d+>}', name: 'app_pegis_modifier')]
    public function modifier(Pegi $pegi, Request $request, EntityManagerInterface $entityManager, PegiRepository $repository): Response
    {
        // Création du formulaire de modification lié à l'entité Pegi récupérée
        $form = $this->createForm(PegiType::class, $pegi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Pas besoin de persist() ici car l'objet est déjà géré par Doctrine
            $entityManager->flush();
            $this->addFlash('success', 'Le PEGI a été modifié.');
            return $this->redirectToRoute('app_pegis');
        }

        // Si formulaire invalide, on recharge tout avec erreurs visibles
        $newPegi = new Pegi();
        $formCreation = $this->createForm(PegiType::class, $newPegi);
        $lesPegis = $repository->findAll();

        return $this->render('pegis/index.html.twig', [
            'formCreation' => $formCreation->createView(),
            'lesPegis' => $lesPegis,
            'formModification' => $form->createView(),
            'idPegiModif' => $pegi->getId(),
        ]);
    }

    #[Route('/pegis/supprimer/{id<\d+>}', name: 'app_pegis_supprimer')]
    public function supprimer(Pegi $pegi, Request $request, EntityManagerInterface $entityManager): Response
    {
        // Vérifie le token CSRF avant suppression
        if ($this->isCsrfTokenValid('action-item' . $pegi->getId(), $request->get('_token'))) {
            // Si des jeux sont associés à ce PEGI, on empêche la suppression
            if ($pegi->getJeuVideos()->count() > 0) {
                $this->addFlash('error', 'Ce PEGI est utilisé par des jeux et ne peut pas être supprimé.');
                return $this->redirectToRoute('app_pegis');
            }

            // Supprime le PEGI de la base
            $entityManager->remove($pegi);
            $entityManager->flush();

            $this->addFlash('success', 'Le PEGI a été supprimé.');
        }

        return $this->redirectToRoute('app_pegis');
    }
}
