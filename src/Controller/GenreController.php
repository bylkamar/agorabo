<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\GenreRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class GenreController extends AbstractController
{

    #[Route('/genres12', name: 'app_genre_vue')]
    public function index(Request $request, GenreRepository $repository, SessionInterface $session): Response
    {
        return $this->render('lesGenres.html.twig', [
            'membres' => $repository->findAll(),
            'menuActif' => 'Gestion'
        ]);

        // $lesJeux = $repository->findAll();
    }
}
