<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Tournoi;
use App\Entity\CatTournois;

class TournoiFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tbDataTournois = [
            [
                'cattournoi' => 'retrogaming',
                'tournois' => [
                    [
                        'libelle' => 'Retrogame 2024',
                        'date' => new \DateTime("2024-08-14 10:00:00"),
                        'date_creation' => new \DateTime("2024-05-01 22:31:10"),
                        'categorie_id' => 1,
                        'nb_participants' => 64
                    ],
                    [
                        'libelle' => 'Retrogame 2023',
                        'date' => new \DateTime("2023-06-30 10:00:00"),
                        'date_creation' => new \DateTime("2023-04-10 12:42:10"),
                        'categorie_id' => 1,
                        'nb_participants' => 34
                    ],
                ]
            ],
            [
                'cattournoi' => 'e-sport',
                'tournois' => [
                    ['libelle' => 'Tournois e-sport 2024', 'date' => new
                        \DateTime("2024-10-14 10:00:00"), 'date_creation' => new \DateTime("2024-05-0122:52:10"), 'categorie_id' => 2, 'nb_participants' => 64],
                    ['libelle' => 'Tournois e-sport 2023', 'date' => new
                        \DateTime("2023-08-22 10:00:00"), 'date_creation' => new \DateTime("2023-05-0112:32:10"), 'categorie_id' => 2, 'nb_participants' => 32],
                    ['libelle' => 'Tournois e-sport 2022', 'date' => new
                        \DateTime("2022-07-30 10:00:00"), 'date_creation' => new \DateTime("2022-05-1214:22:10"), 'categorie_id' => 2, 'nb_participants' => 32],
                ]
            ],
        ];
        for ($i = 0; $i < count($tbDataTournois); ++$i) {
            // créer une catégorie de tournois
            $categorie = new CatTournois();
            $categorie->setLibelle($tbDataTournois[$i]['cattournoi']);
            $manager->persist($categorie);
            // créer les tournois de la catégorie
            foreach ($tbDataTournois[$i]['tournois'] as $unTournoi) {
                $tournoi = new Tournoi();
                $tournoi->setLibelle($unTournoi['libelle']);
                $tournoi->setDate($unTournoi['date']);
                $tournoi->setDateCreation($unTournoi['date_creation']);
                $tournoi->setNBParticipants($unTournoi['nb_participants']);
                // mettre en relation le tournoi avec la catégorie
                $tournoi->setCategorie($categorie);
                $manager->persist($tournoi);
            }
        }
        // exécuter les mises à jour de la base de données
        $manager->flush();
    }
}
