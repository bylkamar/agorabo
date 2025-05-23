<?php

namespace App\Controller;

use App\Entity\Plateforme;
use App\Form\PlateformeType;
use App\Repository\PlateformeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PlateformesController extends AbstractController
{
    // Route principale pour afficher les plateformes et les formulaires de création et de modification
#[Route('/plateformes', name: 'app_plateformes')]
 #[Route('/plateformes/demandermodification/{id<\d+>}', name: 'app_plateformes_demandermodification')]
    public function index(PlateformeRepository $repository, Request $request, $id = null): Response
    {
        // Création du formulaire pour ajouter une nouvelle plateforme
        $plateforme = new Plateforme();
        $formCreation = $this->createForm(PlateformeType::class, $plateforme);

        // Si un id est fourni, on prépare un formulaire de modification pour la plateforme correspondante
        $formModificationView = null;
        if ($id != null) {
            // Sécurité : vérifie le token CSRF
            if ($this->isCsrfTokenValid('action-item' . $id, $request->get('_token'))) {
                $plateformeModif = $repository->find($id); // Recherche de la plateforme à modifier
                $formModificationView = $this->createForm(PlateformeType::class, $plateformeModif)->createView();
            }
        }

        // Récupère toutes les plateformes pour les afficher
        $lesPlateformes = $repository->findAll();

        // Affiche la vue avec le formulaire d'ajout, la liste et potentiellement le formulaire de modification
        return $this->render('plateformes/index.html.twig', [
            'formCreation' => $formCreation->createView(),
            'lesPlateformes' => $lesPlateformes,
            'formModification' => $formModificationView,
            'idPlateformeModif' => $id,
            'menuActif' => 'Gestion',
        ]);
    }

    // Route pour ajouter une nouvelle plateforme
#[Route('/plateformes/ajouter', name: 'app_plateformes_ajouter')]
    public function ajouter( Plateforme $plateforme = null, Request $request, EntityManagerInterface $entityManager,PlateformeRepository $repository) {
        // Création d'un nouveau formulaire lié à une nouvelle instance de Plateforme
        $plateforme = new Plateforme();
        $form = $this->createForm(PlateformeType::class, $plateforme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Enregistrement de la nouvelle plateforme en base
            $entityManager->persist($plateforme);
            $entityManager->flush();

            // Message flash pour confirmer l'ajout
            $this->addFlash(
                'success',
                'La plateforme ' . $plateforme->getLibelle() . ' a été ajoutée.'
            );

            // Redirection vers la liste des plateformes
            return $this->redirectToRoute('app_plateformes');
        } else {
            // Si formulaire invalide, on réaffiche la liste avec les erreurs
            $lesPlateformes = $repository->findAll();
            return $this->render('plateformes/index.html.twig', [
                'formCreation' => $form->createView(),
                'lesPlateformes' => $lesPlateformes,
                'formModification' => null,
                'idPlateformeModif' => null,
            ]);
        }
    }

    // Route pour modifier une plateforme existante
#[Route('/plateformes/modifier/{id<\d+>}', name: 'app_plateformes_modifier')]
    public function modifier(Plateforme $plateforme = null,Request $request,EntityManagerInterface $entityManager,PlateformeRepository $repository ) {
        // Création du formulaire de modification à partir de l'objet déjà existant
        $form = $this->createForm(PlateformeType::class, $plateforme);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Mise à jour des données en base
            $entityManager->flush();

            // Message de confirmation
            $this->addFlash(
                'success',
                'La plateforme ' . $plateforme->getLibelle() . ' a été modifiée.'
            );

            // Redirection vers la liste
            return $this->redirectToRoute('app_plateformes');
        } else {
            // Si formulaire non valide, afficher les erreurs et formulaire de création
            $plateformeNew = new Plateforme();
            $formCreation = $this->createForm(PlateformeType::class, $plateformeNew);
            $lesPlateformes = $repository->findAll();

            return $this->render('plateformes/index.html.twig', [
                'formCreation' => $formCreation->createView(),
                'lesPlateformes' => $lesPlateformes,
                'formModification' => $form->createView(),
                'idPlateformeModif' => $plateforme->getId(),
            ]);
        }
    }

    // Route pour supprimer une plateforme
#[Route('/plateformes/supprimer/{id<\d+>}', name: 'app_plateformes_supprimer')]
    public function supprimer(Plateforme $plateforme = null, Request $request,EntityManagerInterface $entityManager
    ) {
        // Vérifie le token CSRF pour sécuriser la suppression
        if ($this->isCsrfTokenValid('action-item' . $plateforme->getId(), $request->get('_token'))) {
            // Vérifie si des jeux vidéos sont liés à cette plateforme
            if ($plateforme->getJeuVideos()->count() > 0) {
                $this->addFlash(
                    'error',
                    'Il existe des jeux associés à la plateforme ' . $plateforme->getLibelle() . ', elle ne peut pas être supprimée.'
                );
                return $this->redirectToRoute('app_plateformes');
            }

            // Supprime la plateforme
            $entityManager->remove($plateforme);
            $entityManager->flush();

            // Message de confirmation
            $this->addFlash(
                'success',
                'La plateforme ' . $plateforme->getLibelle() . ' a été supprimée.'
            );
        }

        // Redirection vers la liste
        return $this->redirectToRoute('app_plateformes');
    }
}
