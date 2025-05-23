<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Genre;
use App\Form\GenreType;
use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GenresController extends AbstractController
{
#[Route('/genres', name: 'app_genres')]
 #[Route('/genres/demandermodification/{id<\d+>}', name: 'app_genres_demandermodification')]
    public function index(GenreRepository $repository, Request $request, $id = null): Response
    {

        // créer l'objet et le formulaire de création
        $genre = new Genre();
        $formCreation = $this->createForm(GenreType::class, $genre);

        // si 2e route alors $id est renseigné et on crée le formulaire de modification
        $formModificationView = null;
        if ($id != null) {
            // sécurité supplémentaire, on vérifie le token
            if ($this->isCsrfTokenValid('action-item' . $id, $request->get('_token'))) {
                $genreModif = $repository->find($id); // le genre à modifier
                $formModificationView = $this->createForm(
                    GenreType::class,
                    $genreModif
                )->createView();
            }
        }


        // lire les genres
        $lesGenres = $repository->findAll();
        return $this->render('genres/index.html.twig', [
            'formCreation' => $formCreation->createView(),
            'lesGenres' => $lesGenres,
            'formModification' => $formModificationView,
            'idGenreModif' => $id,
            'menuActif' => 'Gestion',
        ]);
    }

#[Route('/genres/ajouter', name: 'app_genres_ajouter')]
    public function ajouter(
        Genre $genre = null,
        Request $request,
        EntityManagerInterface $entityManager,
        GenreRepository $repository
    ) {
        // $genre objet de la classe Genre, il contiendra les valeurs saisies dans les champs après soumission du formulaire.
        // $request objet avec les informations de la requête HTTP (GET, POST,...)
        // $entityManager pour la persistance des données
        // création d'un formulaire de type GenreType
        $genre = new Genre();
        $form = $this->createForm(GenreType::class, $genre);

        // handleRequest met à jour le formulaire
        // si le formulaire a été soumis, handleRequest renseigne les propriétés
        // avec les données saisies par l'utilisateur et retournées par la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // c'est le cas du retour du formulaire
            // l'objet $genre a été automatiquement "hydraté" par Doctrine
            // dire à Doctrine que l'objet sera (éventuellement) persisté
            $entityManager->persist($genre);
            // exécuter les requêtes (indiquées avec persist) ici il s'agit de l'ordre INSERT qui sera exécuté
            $entityManager->flush();
            // ajouter un message flash de succès pour informer l'utilisateur
            $this->addFlash(
                'success',
                'Le genre ' . $genre->getLibelle() . ' a été ajouté.'
            );

            // rediriger vers l'affichage des genres qui comprend le formulairepour l"ajout d'une nouvelle genres
            return $this->redirectToRoute('app_genres');
        } else {
            // affichage de la liste des genres avec le formulaire de création et ses erreurs
            // lire les genres
            $lesGenres = $repository->findAll();

            // rendre la vue
            return $this->render('genres/index.html.twig', [
                'formCreation' => $form->createView(),
                'lesGenres' => $lesGenres,
                'formModification' => null,
                'idGenreModif' => null,
            ]);
        }
    }

#[Route('/genres/modifier/{id<\d+>}', name: 'app_genres_modifier')]
    //public function modifier(Genre $genre = null, $id = null, Request $request, EntityManagerInterface $entityManager, GenreRepository $repository)
    public function modifier(
        Genre $genre = null,
        Request $request,
        EntityManagerInterface $entityManager,
        GenreRepository $repository
    ) {
        // Symfony 4 est capable de retrouver le genre à l'aide de DoctrineORM directement en utilisant l'id passé dans la route
        $form = $this->createForm(GenreType::class, $genre);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // va effectuer la requête d'UPDATE en base de données
            // pas besoin de "persister" l'entité car l'objet a déjà été retrouvé à partir de Doctrine ORM.
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Le genre ' . $genre->getLibelle() . ' a été modifié.'
            );
            // rediriger vers l'affichage des genres de jeux qui comprend le formulaire pour l"ajout d'une nouvelle genre
            return $this->redirectToRoute('app_genres');
        } else {
            // affichage de la liste des genres de jeux avec le formulaire de modification et ses erreurs
            // créer l'objet et le formulaire de création
            $genre = new Genre();
            $formCreation = $this->createForm(GenreType::class, $genre);
            // lire les genres
            $lesGenres = $repository->findAll();
            // rendre la vue
            return $this->render('genres/index.html.twig', [
                'formCreation' => $formCreation->createView(),
                'lesGenres' => $lesGenres,
                'formModification' => $form->createView(),
                'idGenreModif' => $genre->getId(),
            ]);
        }
    }

#[Route('/genres/supprimer/{id<\d+>}', name: 'app_genres_supprimer')]
    public function supprimer(Genre $genre = null, Request $request, EntityManagerInterface $entityManager
    ) {
        // vérifier le token
        if ($this->isCsrfTokenValid('action-item' . $genre->getId(), $request->get('_token'))) {
            if ($genre->getJeuVideos()->count() > 0) {
                $this->addFlash(
                    'error',
                    'Il existe des jeux du genre ' . $genre->getLibelle() . ', il ne peut pas être supprimé.'
                );
                return $this->redirectToRoute('app_genres');
            }
            // supprimer le genre
            $entityManager->remove($genre);
            $entityManager->flush();
            $this->addFlash(
                'success',
                'Le genre ' . $genre->getLibelle() . ' a été supprimé.'
            );
        }
        return $this->redirectToRoute('app_genres');
    }
}
