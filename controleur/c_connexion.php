<?php
if (!isset($_POST['cmdAction'])) {
    $action = 'demanderConnexion';
} else {
    // par défaut
    $action = $_POST['cmdAction'];
}
switch ($action) {
    case 'demanderConnexion': {
            // require './vue/v_connexion.php';
            echo $twig->render('connexion.html.twig');
            break;
        }

    case 'validerConnexion': {
            // vérifier si l'utilisateur existe avec ce mot de passe
            $utilisateur = $db->getUnMembre($_POST["txtLogin"], $_POST["hdMdp"]);
            // si l'utilisateur n'existe pas
            // positionner le message d'erreur $erreur
            if ($utilisateur == null) {
                $erreur = "Identifiant ou mot de passe incorrecte";
                echo $twig->render('connexion.html.twig', array('erreur' => $erreur));
                // require './vue/v_connexion.php';
            } else {
                // créer trois variables de session pour id utilisateur, nom et prénom
                $_SESSION['idUtilisateur'] = $utilisateur->idMembre;
                $_SESSION['nomUtilisateur'] = $utilisateur->nomMembre;
                $_SESSION['prenomUtilisateur'] = $utilisateur->prenomMembre;
                // rediriger vers la page d'accueil
                header('Location: index.php');
                exit;
            }
        }
        break;
}
// }
