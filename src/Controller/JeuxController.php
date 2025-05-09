<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\JeuVideoRepository;

class JeuxController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeux')]
    public function index(JeuVideoRepository $repository): Response
    {
        $lesJeux = $repository->findAll();
        return $this->render('jeux/index.html.twig', [
            'lesJeux' => $lesJeux,
            'menuActif' => 'Jeux',
        ]);
    }
}
