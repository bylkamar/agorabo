<?php

namespace App\Controller;

use App\Entity\Marque;
use App\Form\MarqueType;
use App\Repository\MarqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MarquesController extends AbstractController
{
    // Route principale pour afficher les marques et gérer les formulaires
    #[Route('/marques', name: 'app_marques')]
    #[Route('/marques/demandermodification/{id<\d+>}', name: 'app_marques_demandermodification')]
    public function index(MarqueRepository $repository, Request $request, $id = null): Response
    {
        // Formulaire de création d'une nouvelle marque
        $marque = new Marque();
        $formCreation = $this->createForm(MarqueType::class, $marque);

        // Formulaire de modification (affiché si un id est fourni)
        $formModificationView = null;
        if ($id != null) {
            // Sécurité CSRF avant modification
            if ($this->isCsrfTokenValid('action-item' . $id, $request->get('_token'))) {
                $marqueModif = $repository->find($id); // Recherche de la marque
                $formModificationView = $this->createForm(MarqueType::class, $marqueModif)->createView();
            }
        }

        // Récupère toutes les marques pour l'affichage
        $lesMarques = $repository->findAll();

        // Rend la vue avec les formulaires et la liste
        return $this->render('marques/index.html.twig', [
            'formCreation' => $formCreation->createView(),
            'lesMarques' => $lesMarques,
            'formModification' => $formModificationView,
            'idMarqueModif' => $id,
            'menuActif' => 'Gestion',
        ]);
    }

    // Route pour ajouter une nouvelle marque
    #[Route('/marques/ajouter', name: 'app_marques_ajouter')]
    public function ajouter(
        Marque $marque = null,
        Request $request,
        EntityManagerInterface $entityManager,
        MarqueRepository $repository
    ) {
        // Crée une nouvelle instance et le formulaire associé
        $marque = new Marque();
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        // Vérifie si le formulaire est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde la marque en base
            $entityManager->persist($marque);
            $entityManager->flush();

            // Message de succès
            $this->addFlash(
                'success',
                'La marque ' . $marque->getNom() . ' a été ajoutée.'
            );

            // Redirection vers la liste des marques
            return $this->redirectToRoute('app_marques');
        } else {
            // Si erreur, recharge la vue avec les erreurs
            $lesMarques = $repository->findAll();
            return $this->render('marques/index.html.twig', [
                'formCreation' => $form->createView(),
                'lesMarques' => $lesMarques,
                'formModification' => null,
                'idMarqueModif' => null,
            ]);
        }
    }

    // Route pour modifier une marque existante
    #[Route('/marques/modifier/{id<\d+>}', name: 'app_marques_modifier')]
    public function modifier(
        Marque $marque = null,
        Request $request,
        EntityManagerInterface $entityManager,
        MarqueRepository $repository
    ) {
        // Formulaire de modification à partir de la marque fournie
        $form = $this->createForm(MarqueType::class, $marque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Sauvegarde des modifications
            $entityManager->flush();

            // Message de confirmation
            $this->addFlash(
                'success',
                'La marque ' . $marque->getNom() . ' a été modifiée.'
            );

            // Redirection vers la liste
            return $this->redirectToRoute('app_marques');
        } else {
            // Rechargement avec les erreurs
            $marqueNew = new Marque();
            $formCreation = $this->createForm(MarqueType::class, $marqueNew);
            $lesMarques = $repository->findAll();

            return $this->render('marques/index.html.twig', [
                'formCreation' => $formCreation->createView(),
                'lesMarques' => $lesMarques,
                'formModification' => $form->createView(),
                'idMarqueModif' => $marque->getId(),
            ]);
        }
    }

    // Route pour supprimer une marque
    #[Route('/marques/supprimer/{id<\d+>}', name: 'app_marques_supprimer')]
    public function supprimer(
        Marque $marque = null,
        Request $request,
        EntityManagerInterface $entityManager
    ) {
        // Vérifie la validité du token CSRF
        if ($this->isCsrfTokenValid('action-item' . $marque->getId(), $request->get('_token'))) {
            // Vérifie s'il existe des jeux liés à cette marque
            if ($marque->getJeuVideos()->count() > 0) {
                $this->addFlash(
                    'error',
                    'Il existe des jeux associés à la marque ' . $marque->getNom() . ', elle ne peut pas être supprimée.'
                );
                return $this->redirectToRoute('app_marques');
            }

            // Supprime la marque de la base
            $entityManager->remove($marque);
            $entityManager->flush();

            // Message de confirmation
            $this->addFlash(
                'success',
                'La marque ' . $marque->getNom() . ' a été supprimée.'
            );
        }

        // Redirection vers la liste
        return $this->redirectToRoute('app_marques');
    }
}
