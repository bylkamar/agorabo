<?php

namespace App\Controller;

use App\Entity\CatTournois;
use App\Form\CatTournoisType;
use App\Repository\CatTournoisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatTournoisController extends AbstractController
{
    #[Route('/cat/tournois', name: 'app_cat_tournois')]
    #[Route('/cat/tournois/demandermodification/{id<\d+>}', name: 'app_cat_tournois_demandermodification')]
    public function index(CatTournoisRepository $repository, Request $request, $id = null): Response
    {
        // créer l'objet et le formulaire de création
        $categorie = new CatTournois();
        $formCreation = $this->createForm(CatTournoisType::class, $categorie);
        // Si deuxième route executé
        // si 2e route alors $id est renseigné et on crée le formulaire de modification
        $formModificationView = null;
        if ($id != null) {
            // sécurité supplémentaire, on vérifie le token
            if ($this->isCsrfTokenValid('action-item' . $id, $request->get('_token'))) {
                $categorieModif = $repository->find($id); // la catégorie à modifier
                $formModificationView = $this->createForm(
                    CatTournoisType::class,
                    $categorieModif
                )->createView();
            }
        }


        // lire les catégories
        $lesCatTournois = $repository->findAll();
        return $this->render('cat_tournois/index.html.twig', [
            'formCreation' => $formCreation->createView(),
            'lesCatTournois' => $lesCatTournois,
            'formModification' => $formModificationView,
            'idCatTournoisModif' => $id
        ]);
    }

    #[Route('/cat/tournois/ajouter', name: 'app_cat_tournois_ajouter')]
    public function ajouter(
        CatTournois $categorie = null,
        Request $request,
        EntityManagerInterface $entityManager,
        CatTournoisRepository $repository
    ) {
        // $categorie objet de la classe CatTournois, il contiendra les valeurs
        // saisies dans les champs après soumission du formulaire.
        // $request objet avec les informations de la requête HTTP (GET, POST,
        // ...)
        // $entityManager pour la persistance des données
        // création d'un formulaire de type CatTournoisType
        $categorie = new CatTournois();
        $form = $this->createForm(CatTournoisType::class, $categorie);
        // handleRequest met à jour le formulaire
        // si le formulaire a été soumis, handleRequest renseigne les propriétés
        // avec les données saisies par l'utilisateur et retournées par la
        // soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // c'est le cas du retour du formulaire
            // l'objet $categorie a été automatiquement "hydraté" par
            // Doctrine
            // dire à Doctrine que l'objet sera (éventuellement) persisté
            $entityManager->persist($categorie);
            // exécuter les requêtes (indiquées avec persist) ici il s'agit de
            // l'ordre INSERT qui sera exécuté
            $entityManager->flush();
            // ajouter un message flash de succès pour informer l'utilisateur
            $this->addFlash(
                'success',
                'La catégorie de tounois ' . $categorie->getLibelle() . ' a été ajoutée.'
            );
            // rediriger vers l'affichage des catégories qui comprend le formulaire
            // pour l"ajout d'une nouvelle catégorie
            return $this->redirectToRoute('app_cat_tournois');
        } else {
            // affichage de la liste des catégories avec le formulaire de création
            // et ses erreurs
            // lire les catégories
            $lesCatTournois = $repository->findAll();
            // rendre la vue
            return $this->render('cat_tournois/index.html.twig', [
                'formCreation' => $form->createView(),
                'lesCategories' => $lesCatTournois,
                'formModification' => null,
                'idCategorieModif' => null,
            ]);
        }
    }

    #[Route('/cat/tournois/modifier/{id<\d+>}', name: 'app_cat_tournois_modifier')]
    public function modifier(CatTournois $categorie = null, Request $request, EntityManagerInterface $entityManager, CatTournoisRepository $repository)
    {
        // Symfony 4 est capable de retrouver la catégorie à l'aide de Doctrine
        // ORM directement en utilisant l'id passé dans la route
        $form = $this->createForm(CatTournoisType::class, $categorie);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // va effectuer la requête d'UPDATE en base de données
            // pas besoin de "persister" l'entité car l'objet a déjà été retrouvé
            // à partir de Doctrine ORM.
            $entityManager->flush();
            $this->addFlash(
                'success',
                'La catégorie de tournois ' . $categorie->getLibelle() . ' a été modifiée.'
            );
            // rediriger vers l'affichage des catégories de tournois qui comprend
            // le formulaire pour l"ajout d'une nouvelle catégorie
            return $this->redirectToRoute('app_cat_tournois');
        } else {
            // affichage de la liste des catégories de tournois avec le formulaire
            // de modification et ses erreurs
            // créer l'objet et le formulaire de création
            $categorie = new CatTournois();
            $formCreation = $this->createForm(CatTournoisType::class, $categorie);
            // lire les catégories
            $lesCatTournois = $repository->findAll();
            // rendre la vue
            return $this->render('categorie/index.html.twig', [
                'formCreation' => $formCreation->createView(),
                'lesCatTournois' => $lesCatTournois,
                'formModification' => $form->createView(),
                'idCategorieModif' => $categorie->getId(),
            ]);
        }
    }

    // SUpprimer
    #[Route('/ca/tournois/supprimer/{id<\d+>}', name: 'app_cat_tournois_supprimer')]
    public function supprimer(
        CatTournois $categorie = null,
        Request $request,
        EntityManagerInterface $entityManager
    ) {
        // vérifier le token
        if ($this->isCsrfTokenValid('action-item' . $categorie->getId(), $request->get('_token'))) {
            if ($categorie->getTournois()->count() > 0) {
                $this->addFlash(
                    'error',
                    'Il existe des tournois dans la catégorie ' . $categorie->getLibelle()
                        . ', elle ne peut pas être supprimée.'
                );
                return $this->redirectToRoute('app_cat_tournois');
            }
            // supprimer la catégorie
            $entityManager->remove($categorie);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'La catégorie de tournois ' . $categorie->getLibelle() . ' a été supprimée.'
            );
            return $this->redirectToRoute('app_cat_tournois');
        }
    }
}
