<?php
// src/Controller/pegiController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

require_once 'modele/class.PdoJeux.inc.php';

use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\RedirectController;
use PdoJeux;

use function PHPSTORM_META\type;

class PegiController extends AbstractController
{
    /**
     * fonction pour afficher la liste des Pegi
     * @param $db
     * @param $idPegiModif positionné si demande de modification
     * @param $idPegiNotif positionné si mise à jour dans la vue
     * @param $notification pour notifier la mise à jour dans la vue
     */
    private function afficherPegi(
        PdoJeux $db,
        int $idPegiModif,
        int $idPegiNotif,
        string $notification
    ) {
        $tbPegi = $db->getLesPegisComplet();
        return $this->render('lesPegi.html.twig', array(
            'menuActif' => 'Jeux',
            'tbPegis' => $tbPegi,
            'idPegiModif' => $idPegiModif,
            'idPegiNotif' => $idPegiNotif,
            'notification' => $notification
        ));
    }
    #[Route('/pegi', name: 'pegis_afficher')]
    public function index(SessionInterface $session)
    {
        if ($this->getUser()) {
            $db = PdoJeux::getPdoJeux();
            return $this->afficherPegi($db, -1, -1, 'rien');
        } else {
            return $this->render('connexion.html.twig');
        }
    }
    #[Route('/pegi/ajouter', name: 'pegis_ajouter')]
    public function ajouter(SessionInterface $session, Request $request)
    {
        $db = PdoJeux::getPdoJeux();
        if (!empty($request->request->get('txtDescPegi'))) {
            $idPegiNotif = $db->ajouterPegi(
                $request->request->get('txtAgePegi'),
                $request->request->get('txtDescPegi')
            );
            $notification = 'Ajouté';
        }
        return $this->afficherPegi($db, -1, $idPegiNotif, $notification);
    }
    #[Route('/pegi/demandermodifier', name: 'pegis_demandermodifier')]
    public function demanderModifier(SessionInterface $session, Request $request)
    {
        $db = PdoJeux::getPdoJeux();
        return $this->afficherPegi(
            $db,
            $request->request->get('txtIdPegi'),
            -1,
            'rien'
        );
    }
    #[Route('/pegi/validermodifier', name: 'pegis_validermodifier')]
    public function validerModifier(SessionInterface $session, Request $request)
    {
        $db = PdoJeux::getPdoJeux();
        $db->modifierPegi($request->request->get('txtIdPegi'), $request->request->get('txtAgePegi'), $request->request->get('txtDescPegi'));
        return $this->afficherPegi(
            $db,
            -1,
            $request->request->get('txtIdPegi'),
            'Modifié'
        );
    }
    #[Route('/pegi/supprimer', name: 'pegis_supprimer')]
    public function supprimer(SessionInterface $session, Request $request)
    {
        $db = PdoJeux::getPdoJeux();
        $db->supprimerPegi($request->request->get('txtIdPegi'));
        $this->addFlash(
            'success',
            'Le pegi a été supprimé'
        );
        return $this->afficherPegi($db, -1, -1, 'rien');
    }
}
